<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use SistemaIndexForm as sistemaIndexForm;
use SistemaNewForm as sistemaNewForm;
use SistemaEditForm as sistemaEditForm;
class SistemaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        $this->view->form = new sistemaIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $etiquetaSistema = $this->request->getPost("etiquetaSistema");
        $urlSistema = $this->request->getPost("urlSistema");
        $urlIcono = $this->request->getPost("urlIcono");
        $indicadorAdministrador = $this->request->getPost("indicadorAdministrador");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $sistema = $this->modelsManager->createBuilder()
                                ->columns("si.codSistema," .
                                                        "si.etiquetaSistema," .
                                                        "si.url as urlSistema," .
                                                        "si.urlIcono," .
                                                        "if(si.indicadorAdministrador='S','Administrador','No Administrador') as indicadorAdministrador, ".
                                                        "if(si.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Sistema',
                                          'si')
                                ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                                        'si.url like :urlSistema: AND ' .
                                                        'si.urlIcono like :urlIcono: AND ' .
                                                        'si.indicadorAdministrador like :indicadorAdministrador: AND ' .
                                                        'si.estadoRegistro like :estado: ',
                                           [
                                                'etiquetaSistema' => "%" . $etiquetaSistema . "%",
                                                'urlSistema' => "%" . $urlSistema . "%",
                                                'urlIcono' => "%" . $urlIcono . "%",
                                                'indicadorAdministrador' => "%".$indicadorAdministrador."%",
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
            if ($pagina < floor(count($sistema) / 10) + 1) {
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
            $pagina = floor(count($sistema) / 10) + 1;
        }

        if (count($sistema) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "sistema",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $sistema,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        parent::validarSession();

        $this->view->form = new sistemaNewForm();
    }

    public function editAction($codSistema) {
        parent::validarSession();

        if (!$this->request->isPost()) {

            $sistema = Sistema::findFirstBycodSistema($codSistema);
            if (!$sistema) {
                $this->flash->error("Sistema no Encontrado");

                $this->dispatcher->forward([
                                'controller' => "sistema",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codSistema = $sistema->codSistema;

            $this->tag->setDefault("codSistema",
                                   $sistema->codSistema);
            $this->tag->setDefault("etiquetaSistema",
                                   $sistema->etiquetaSistema);
            $this->tag->setDefault("urlSistema",
                                   $sistema->url);
            $this->tag->setDefault("urlIcono",
                                   $sistema->urlIcono);
            $this->tag->setDefault("indicadorAdministrador",
                                   $sistema->indicadorAdministrador);
            $this->tag->setDefault("estadoRegistro",
                                   $sistema->estadoRegistro);

            $this->view->form = new sistemaEditForm();
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "sistema",
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

        $sistema = new Sistema();
        $sistema->Etiquetasistema = $this->request->getPost("etiquetaSistema");
        $sistema->Url = $this->request->getPost("urlSistema");
        $sistema->Urlicono = $this->request->getPost("urlIcono");
        $sistema->Indicadoradministrador = $this->request->getPost("indicadorAdministrador");
        $sistema->Estadoregistro = 'S';
        $sistema->Fechainsercion = strftime("%Y-%m-%d",
                                            time());
        $sistema->Usuarioinsercion = $username;


        if (!$sistema->save()) {
            foreach ($sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Sistema Registrado Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "sistema",
                        'action' => 'index'
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $codSistema = $this->request->getPost("codSistema");
        $sistema = Sistema::findFirstBycodSistema($codSistema);

        if (!$sistema) {
            $this->flash->error("Sistema no Encontrado " . $codSistema);

            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $form = new sistemaEditForm();
        if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                            'controller' => "sistema",
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

            $sistema->Etiquetasistema = $this->request->getPost("etiquetaSistema");
            $sistema->Url = $this->request->getPost("urlSistema");
            $sistema->Urlicono = $this->request->getPost("urlIcono");
            $sistema->Indicadoradministrador = $this->request->getPost("indicadorAdministrador");
            $sistema->Estadoregistro = $this->request->getPost("estadoRegistro");
            $sistema->Fechamodificacion = strftime("%Y-%m-%d",
                                                   time());
            $sistema->Usuariomodificacion = $username;


            if (!$sistema->save()) {

                foreach ($sistema->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                                'controller' => "sistema",
                                'action' => 'edit',
                                'params' => [$sistema->codSistema]
                ]);

                return;
            }

            $this->flash->success("Sistema Actualizado Satisfactoriamente");

            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'index'
            ]);
        }
    }

    public function deleteAction($codSistema) {
        $sistema = Sistema::findFirstBycodSistema($codSistema);
        if (!$sistema) {
            $this->flash->error("sistema was not found");

            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$sistema->delete()) {

            foreach ($sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "sistema",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("sistema was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "sistema",
                        'action' => "index"
        ]);
    }

    public function resetAction() {
        parent::validarSession();

        $this->view->form = new sistemaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "sistema",
                        'action' => 'index'
        ]);

        return;
    }
}