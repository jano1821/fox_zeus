<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use AgenciaIndexForm as agenciaIndexForm;
use AgenciaNewForm as agenciaNewForm;
use AgenciaEditForm as agenciaEditForm;
class AgenciaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        $this->view->form = new agenciaIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $nombreAgencia = $this->request->getPost("descripcion");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $codEmpresa = $usuario['codEmpresa'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $agencia = $this->modelsManager->createBuilder()
                                ->columns("ag.codAgencia," .
                                                        "ag.descripcion," .
                                                        "em.nombreEmpresa," .
                                                        "if(ag.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Agencia',
                                          'ag')
                                ->innerJoin('Empresa',
                                            'em.codEmpresa = ag.codEmpresa',
                                            'em')
                                ->andWhere('ag.descripcion like :descripcion: AND ' .
                                                        'ag.codEmpresa = :codEmpresa: AND ' .
                                                        'ag.estadoRegistro like :estado: ',
                                           [
                                                'descripcion' => "%" . $nombreAgencia . "%",
                                                'codEmpresa' => $codEmpresa,
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('ag.descripcion')
                                ->getQuery()
                                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($agencia) / 10) + 1) {
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
            $pagina = floor(count($agencia) / 10) + 1;
        }

        if (count($agencia) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "agencia",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $agencia,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        parent::validarSession();

        $this->view->form = new agenciaNewForm();
    }

    public function editAction($codAgencia) {
        parent::validarSession();

        if (!$this->request->isPost()) {

            $agencia = Agencia::findFirstBycodAgencia($codAgencia);
            if (!$agencia) {
                $this->flash->error("Agencia No Encontrada");

                $this->dispatcher->forward([
                                'controller' => "agencia",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codAgencia = $agencia->codAgencia;

            $this->tag->setDefault("codAgencia",
                                   $agencia->codAgencia);
            $this->tag->setDefault("descripcion",
                                   $agencia->descripcion);
            $this->tag->setDefault("estadoRegistro",
                                   $agencia->estadoRegistro);
            $this->view->form = new agenciaEditForm();
        }
    }

    /**
     * Creates a new agencia
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $agencia = new Agencia();
        $agencia->Descripcion = $this->request->getPost("descripcion");
        $agencia->Estadoregistro = "S";
        $agencia->Usuarioinsercion = $username;
        $agencia->Fechainsercion = strftime("%Y-%m-%d",
                                            time());
        $agencia->Codempresa = $codEmpresa;


        if (!$agencia->save()) {
            foreach ($agencia->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Agencia Registrada Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "agencia",
                        'action' => 'index'
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'index'
            ]);

            return;
        }

        $codAgencia = $this->request->getPost("codAgencia");
        $agencia = Agencia::findFirstBycodAgencia($codAgencia);

        if (!$agencia) {
            $this->flash->error("Agencia No Existe " . $codAgencia);

            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'index'
            ]);

            return;
        }

        $form = new agenciaEditForm();
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
            $agencia->Descripcion = $this->request->getPost("descripcion");
            $agencia->Estadoregistro = $this->request->getPost("estadoRegistro");
            $agencia->Usuariomodificacion = $username;
            $agencia->Fechamodificacion = strftime("%Y-%m-%d",
                                                   time());

            if (!$agencia->save()) {

                foreach ($agencia->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                                'controller' => "agencia",
                                'action' => 'edit',
                                'params' => [$agencia->codAgencia]
                ]);

                return;
            }

            $this->flash->success("Agencia Actualizada Satisfactoriamente");

            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'index'
            ]);
        }
    }

    public function deleteAction($codAgencia) {
        $agencia = Agencia::findFirstBycodAgencia($codAgencia);
        if (!$agencia) {
            $this->flash->error("agencia was not found");

            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$agencia->delete()) {

            foreach ($agencia->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "agencia",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("agencia was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "agencia",
                        'action' => "index"
        ]);
    }

    public function resetAction() {
        parent::validarSession();

        $this->view->form = new agenciaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "agencia",
                        'action' => 'index'
        ]);

        return;
    }
}