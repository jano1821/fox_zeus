<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
class EmpresaSistemaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction($codEmpresa) {
        parent::validarSession();

        $empresaController = new EmpresaController();
        $empresa = $empresaController->findById($codEmpresa);

        $this->tag->setDefault("codEmpresa",
                               $codEmpresa);
        $this->view->setVar("codigoEmpresa",
                            $codEmpresa);
        $this->view->setVar("nombreEmpresa",
                            strtoupper($empresa->nombreEmpresa));
        $this->view->form = new EmpresaSistemaIndexForm();
    }

    /**
     * Searches for empresa_sistema
     */
    public function searchAction() {
        parent::validarSession();

        $codSistema = $this->request->getPost("codSistema");
        $codEmpresa = $this->request->getPost("codEmpresa");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");



        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }
        $empresaSistema = $this->modelsManager->createBuilder()
                                ->columns("es.codSistema," .
                                          "es.codEmpresa," .
                                          "UPPER(si.etiquetaSistema) etiquetaSistema," .
                                          "UPPER(em.nombreEmpresa) nombreEmpresa, " .
                                          "if(es.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('EmpresaSistema',
                                          'es')
                                ->innerJoin('Empresa',
                                            'es.codEmpresa = em.codEmpresa',
                                            'em')
                                ->innerJoin('Sistema',
                                            'si.codSistema = es.codSistema',
                                            'si')
                                ->andWhere('es.codSistema like :codSistema: AND ' .
                                           'es.codEmpresa like :codEmpresa: AND ' .
                                           'es.estadoRegistro like :estado: ',
                                           [
                                                'codSistema' => "%" . $codSistema . "%",
                                                'codEmpresa' => "%" . $codEmpresa . "%",
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('si.etiquetaSistema')
                                ->getQuery()
                                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($empresaSistema) / 10) + 1) {
                $pagina = $pagina + 1;
            }else {
                $this->flash->notice("No hay Registros Posteriores");
            }
        }else if ($avance == -1) {
            if ($pagina > 1) {
                $pagina = $pagina - 1;
            }else {
                $this->flash->notice("No hay Registros Anteriores");
            }
        }else if ($avance == 2) {
            $pagina = floor(count($empresaSistema) / 10) + 1;
        }

        if (count($empresaSistema) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "empresa_sistema",
                            "action" => "index",
                            "params" => [$codEmpresa]
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $empresaSistema,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->tag->setDefault("codEmpresa",
                                   $codEmpresa);
        $this->view->setVar("codigoEmpresa",strtoupper($codEmpresa));
        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction($codEmpresa) {
        parent::validarSession();

        $empresaController = new EmpresaController();
        $empresa=$empresaController->findById($codEmpresa);
        
        $this->tag->setDefault("codEmpresa",
                                   $codEmpresa);
        $this->view->setVar("codigoEmpresa",$codEmpresa);
        $this->view->setVar("nombreEmpresa",strtoupper($empresa->nombreEmpresa));
        
        $this->view->form = new EmpresaSistemaNewForm();
    }

    /**
     * Edits a empresa_sistema
     *
     * @param string $codEmpresa
     */
    public function editAction($codEmpresa) {
        if (!$this->request->isPost()) {

            $empresa_sistema = EmpresaSistema::findFirstBycodEmpresa($codEmpresa);
            if (!$empresa_sistema) {
                $this->flash->error("empresa_sistema was not found");

                $this->dispatcher->forward([
                                'controller' => "empresa_sistema",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codEmpresa = $empresa_sistema->codEmpresa;

            $this->tag->setDefault("codEmpresa",
                                   $empresa_sistema->codEmpresa);
            $this->tag->setDefault("codSistema",
                                   $empresa_sistema->codSistema);
            $this->tag->setDefault("estadoRegistro",
                                   $empresa_sistema->estadoRegistro);
        }
    }

    /**
     * Creates a new empresa_sistema
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'index',
                            'params' => [$this->request->getPost("codEmpresa")]
            ]);

            return;
        }

        $empresa_sistema = new EmpresaSistema();
        $empresa_sistema->Codempresa = $this->request->getPost("codEmpresa");
        $empresa_sistema->Codsistema = $this->request->getPost("codSistema");
        $empresa_sistema->Estadoregistro = "S";


        if (!$empresa_sistema->save()) {
            foreach ($empresa_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'new',
                            'params' => [$this->request->getPost("codEmpresa")]
            ]);

            return;
        }

        $this->flash->success("Vinculo Empresa Sistema Registrado Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "empresa_sistema",
                        'action' => 'index',
                        'params' => [$this->request->getPost("codEmpresa")]
        ]);
    }

    /**
     * Saves a empresa_sistema edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $codEmpresa = $this->request->getPost("codEmpresa");
        $empresa_sistema = EmpresaSistema::findFirstBycodEmpresa($codEmpresa);

        if (!$empresa_sistema) {
            $this->flash->error("empresa_sistema does not exist " . $codEmpresa);

            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $empresa_sistema->Codempresa = $this->request->getPost("codEmpresa");
        $empresa_sistema->Codsistema = $this->request->getPost("codSistema");
        $empresa_sistema->Estadoregistro = $this->request->getPost("estadoRegistro");


        if (!$empresa_sistema->save()) {

            foreach ($empresa_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'edit',
                            'params' => [$empresa_sistema->codEmpresa]
            ]);

            return;
        }

        $this->flash->success("empresa_sistema was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "empresa_sistema",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a empresa_sistema
     *
     * @param string $codEmpresa
     */
    public function deleteAction($codEmpresa) {
        $empresa_sistema = EmpresaSistema::findFirstBycodEmpresa($codEmpresa);
        if (!$empresa_sistema) {
            $this->flash->error("empresa_sistema was not found");

            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$empresa_sistema->delete()) {

            foreach ($empresa_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "empresa_sistema",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("empresa_sistema was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "empresa_sistema",
                        'action' => "index"
        ]);
    }
}