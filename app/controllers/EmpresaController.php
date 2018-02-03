<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use EmpresaIndexForm as empresaIndexForm;
use EmpresaNewForm as empresaNewForm;
use EmpresaEditForm as empresaEditForm;
class EmpresaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        $this->view->form = new empresaIndexForm();
    }

    /**
     * Searches for empresa
     */
    public function searchAction() {
        parent::validarSession();

        $nombreEmpresa = $this->request->getPost("nombreEmpresa");
        $razonSocial = $this->request->getPost("razonSocial");
        $limiteUsuarios = $this->request->getPost("limiteUsuarios");
        $identificadorEmpresa = $this->request->getPost("identificadorEmpresa");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $empresa = $this->modelsManager->createBuilder()
                                ->columns("em.codEmpresa," .
                                                        "em.nombreEmpresa," .
                                                        "em.razonSocial," .
                                                        "em.limiteUsuarios," .
                                                        "em.identificadorEmpresa, " .
                                                        "if(em.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Empresa',
                                          'em')
                                ->andWhere('em.nombreEmpresa like :nombreEmpresa: AND ' .
                                                        'em.razonSocial like :razonSocial: AND ' .
                                                        'em.limiteUsuarios like :limiteUsuarios: AND ' .
                                                        'em.identificadorEmpresa like :identificadorEmpresa: AND ' .
                                                        'em.estadoRegistro like :estado: ',
                                           [
                                                'nombreEmpresa' => "%" . $nombreEmpresa . "%",
                                                'razonSocial' => "%" . $razonSocial . "%",
                                                'limiteUsuarios' => "%" . $limiteUsuarios . "%",
                                                'identificadorEmpresa' => "%" . $identificadorEmpresa . "%",
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('em.nombreEmpresa')
                                ->getQuery()
                                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($empresa) / 10) + 1) {
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
            $pagina = floor(count($empresa) / 10) + 1;
        }

        if (count($empresa) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "sistema",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $empresa,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        parent::validarSession();

        $this->view->form = new empresaNewForm();
    }

    /**
     * Edits a empresa
     *
     * @param string $codEmpresa
     */
    public function editAction($codEmpresa) {
        parent::validarSession();

        if (!$this->request->isPost()) {

            $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);
            if (!$empresa) {
                $this->flash->error("Empresa no Encontrada");

                $this->dispatcher->forward([
                                'controller' => "empresa",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codEmpresa = $empresa->codEmpresa;

            $this->tag->setDefault("codEmpresa",
                                   $empresa->codEmpresa);
            $this->tag->setDefault("nombreEmpresa",
                                   $empresa->nombreEmpresa);
            $this->tag->setDefault("razonSocial",
                                   $empresa->razonSocial);
            $this->tag->setDefault("limiteUsuarios",
                                   $empresa->limiteUsuarios);
            $this->tag->setDefault("identificadorEmpresa",
                                   $empresa->identificadorEmpresa);
            $this->tag->setDefault("estadoRegistro",
                                   $empresa->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion",
                                   $empresa->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion",
                                   $empresa->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion",
                                   $empresa->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion",
                                   $empresa->fechaModificacion);

            $this->view->form = new empresaEditForm();
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $empresa = new Empresa();
        $empresa->Nombreempresa = $this->request->getPost("nombreEmpresa");
        $empresa->Razonsocial = $this->request->getPost("razonSocial");
        $empresa->Limiteusuarios = $this->request->getPost("limiteUsuarios");
        $empresa->Identificadorempresa = $this->request->getPost("identificadorEmpresa");
        $empresa->Estadoregistro = 'S';
        $empresa->Usuarioinsercion = $username;
        $empresa->Fechainsercion = strftime("%Y-%m-%d",
                                            time());

        if (!$empresa->save()) {
            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Empresa Registrada Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "empresa",
                        'action' => 'index'
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'index'
            ]);

            return;
        }

        $codEmpresa = $this->request->getPost("codEmpresa");
        $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);

        if (!$empresa) {
            $this->flash->error("Empresa no Encontrada " . $codEmpresa);

            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'index'
            ]);

            return;
        }
        $form = new empresaEditForm();
        if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'Edit'
            ]);

            return;
        }else {
            if ($this->session->has("Usuario")) {
                $usuario = $this->session->get("Usuario");
                $username = $usuario['nombreUsuario'];
            }else {
                $this->session->destroy();
                $this->response->redirect('index');
            }

            $empresa->Nombreempresa = $this->request->getPost("nombreEmpresa");
            $empresa->Razonsocial = $this->request->getPost("razonSocial");
            $empresa->Limiteusuarios = $this->request->getPost("limiteUsuarios");
            $empresa->Identificadorempresa = $this->request->getPost("identificadorEmpresa");
            $empresa->Estadoregistro = $this->request->getPost("estadoRegistro");
            $empresa->Usuariomodificacion = $username;
            $empresa->Fechamodificacion = $this->request->getPost("fechaModificacion");


            if (!$empresa->save()) {

                foreach ($empresa->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                                'controller' => "empresa",
                                'action' => 'edit',
                                'params' => [$empresa->codEmpresa]
                ]);

                return;
            }

            $this->flash->success("Empresa Actualizada Satisfactoriamente");

            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'index'
            ]);
        }
    }

    /**
     * Deletes a empresa
     *
     * @param string $codEmpresa
     */
    public function deleteAction($codEmpresa) {
        $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);
        if (!$empresa) {
            $this->flash->error("empresa was not found");

            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$empresa->delete()) {

            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "empresa",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("empresa was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "empresa",
                        'action' => "index"
        ]);
    }
    
    public function resetAction() {
        parent::validarSession();

        $this->view->form = new empresaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "empresa",
                        'action' => 'index'
        ]);

        return;
    }
}