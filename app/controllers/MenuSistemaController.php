<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use MenuSistemaIndexForm as menuSistemaIndexForm;
use MenuSistemaNewForm as menuSistemaNewForm;
use MenuSistemaEditForm as menuSistemaEditForm;
class MenuSistemaController extends ControllerBase {

    public function onConstruct() {
        parent::validarSession();
        parent::validarAdministradores();
        $usuario = $this->session->get("Usuario");
        parent::validaAccesoSistema(parent::obtenerParametros("SISTEMA_ASISTENCIA"),
                                                              $usuario['codUsuario']);
    }

    public function indexAction($codUsuario) {
        $usuarioController = new UsuarioController();
        $usuario=$usuarioController->findById($codUsuario);
        
        $this->tag->setDefault("codUsuario",
                                   $codUsuario);
        $this->view->setVar("codigoUsuario",$codUsuario);
        $this->view->setVar("usuario",strtoupper($usuario->nombreUsuario));
        $this->view->form = new menuSistemaIndexForm();
    }

    public function searchAction() {
        $codMenu = $this->request->getPost("codMenu");
        $codSistema = $this->request->getPost("codSistema");
        $codUsuario = $this->request->getPost("codUsuario");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");



        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }
        $menu_sistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu," .
                                          "ms.codSistema," .
                                          "ms.codUsuario," .
                                          "si.etiquetaSistema," .
                                          "us.nombreUsuario, " .
                                          "me.descripcion, " .
                                          "if(ms.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('MenuSistema',
                                          'ms')
                                ->innerJoin('Menu',
                                            'me.codMenu = ms.codMenu',
                                            'me')
                                ->innerJoin('Sistema',
                                            'si.codSistema = ms.codSistema',
                                            'si')
                                ->innerJoin('Usuario',
                                            'us.codUsuario = ms.codUsuario',
                                            'us')
                                ->andWhere('ms.codMenu like :codMenu: AND ' .
                                                        'ms.codSistema like :codSistema: AND ' .
                                                        'ms.codUsuario like :codUsuario: AND ' .
                                                        'ms.estadoRegistro like :estado: ',
                                           [
                                                'codMenu' => "%" . $codMenu . "%",
                                                'codSistema' => "%" . $codSistema . "%",
                                                'codUsuario' => "%" . $codUsuario . "%",
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('me.descripcion')
                                ->getQuery()
                                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($menu_sistema) / 10) + 1) {
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
            $pagina = floor(count($menu_sistema) / 10) + 1;
        }

        if (count($menu_sistema) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "menu_sistema",
                            "action" => "index",
                            "params" => [$codUsuario]
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $menu_sistema,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->tag->setDefault("codUsuario",
                                   $codUsuario);
        $this->view->setVar("codigoUsuario",strtoupper($codUsuario));
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction($codUsuario) {
        $usuarioController = new UsuarioController();
        $usuario=$usuarioController->findById($codUsuario);
        
        $this->tag->setDefault("codUsuario",
                                   $codUsuario);
        $this->view->setVar("codigoUsuario",$codUsuario);
        $this->view->setVar("usuario",strtoupper($usuario->nombreUsuario));
        
        $this->view->form = new menuSistemaNewForm();
    }

    public function editAction($codMenu,$codSistema,$codUsuario) {
        if (!$this->request->isPost()) {

            $menu_sistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu," .
                                          "ms.codSistema," .
                                          "ms.codUsuario," .
                                          "si.etiquetaSistema," .
                                          "us.nombreUsuario, " .
                                          "me.descripcion,".
                                          "ms.estadoRegistro ")
                                ->addFrom('MenuSistema',
                                          'ms')
                                ->innerJoin('Menu',
                                            'me.codMenu = ms.codMenu',
                                            'me')
                                ->innerJoin('Sistema',
                                            'si.codSistema = ms.codSistema',
                                            'si')
                                ->innerJoin('Usuario',
                                            'us.codUsuario = ms.codUsuario',
                                            'us')
                                ->andWhere('ms.codMenu = :codMenu: AND ' .
                                                        'ms.codSistema = :codSistema: AND ' .
                                                        'ms.codUsuario = :codUsuario: ' ,
                                           [
                                                'codMenu' => "".$codMenu."",
                                                'codSistema' => "".$codSistema."",
                                                'codUsuario' => "".$codUsuario."",
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
            
            if (!$menu_sistema) {
                $this->flash->error("Menu Sistema No Encontrado");

                $this->dispatcher->forward([
                                'controller' => "menu_sistema",
                                'action' => 'index'
                ]);

                return;
            }
            foreach($menu_sistema as $resp){

            $this->tag->setDefault("codMenu",
                                   $resp->codMenu);
            $this->tag->setDefault("nombreMenu",
                                   $resp->descripcion);
            $this->tag->setDefault("codSistema",
                                   $resp->codSistema);
            $this->tag->setDefault("nombreSistema",
                                   $resp->etiquetaSistema);
            $this->tag->setDefault("codUsuario",
                                   $resp->codUsuario);
            $this->tag->setDefault("nombreUsuario",
                                   $resp->nombreUsuario);
            $this->tag->setDefault("estadoRegistro",
                                   $resp->estadoRegistro);
            
            $this->view->form = new menuSistemaEditForm();
            }
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
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

        $menu_sistema = new MenuSistema();
        $menu_sistema->Codmenu = $this->request->getPost("codMenu");
        $menu_sistema->Codsistema = $this->request->getPost("codSistema");
        $menu_sistema->Codusuario = $this->request->getPost("codUsuario");
        $menu_sistema->Estadoregistro = "S";
        $menu_sistema->Usuarioinsercion = $username;
        $menu_sistema->Fechainsercion = strftime("%Y-%m-%d",
                                                 time());

        if (!$menu_sistema->save()) {
            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'new',
                            'params' => [$this->request->getPost("codUsuario")]
            ]);

            return;
        }

        $this->flash->success("Menu Sistema Registrado Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index',
                        'params' => [$this->request->getPost("codUsuario")]
        ]);
    }

    /**
     * Saves a menu_sistema edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $codMenu = $this->request->getPost("codMenu");
        $menu_sistema = MenuSistema::findFirstBycodMenu($codMenu);

        if (!$menu_sistema) {
            $this->flash->error("menu_sistema does not exist " . $codMenu);

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $menu_sistema->Codmenu = $this->request->getPost("codMenu");
        $menu_sistema->Codsistema = $this->request->getPost("codSistema");
        $menu_sistema->Codusuario = $this->request->getPost("codUsuario");
        $menu_sistema->Estadoregistro = $this->request->getPost("estadoRegistro");
        $menu_sistema->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $menu_sistema->Fechainsercion = $this->request->getPost("fechaInsercion");
        $menu_sistema->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $menu_sistema->Fechamodificacion = $this->request->getPost("fechaModificacion");


        if (!$menu_sistema->save()) {

            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'edit',
                            'params' => [$menu_sistema->codMenu]
            ]);

            return;
        }

        $this->flash->success("menu_sistema was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a menu_sistema
     *
     * @param string $codMenu
     */
    public function deleteAction($codMenu) {
        $menu_sistema = MenuSistema::findFirstBycodMenu($codMenu);
        if (!$menu_sistema) {
            $this->flash->error("menu_sistema was not found");

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$menu_sistema->delete()) {

            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("menu_sistema was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => "index"
        ]);
    }

    public function resetAction() {
        parent::validarSession();

        $this->view->form = new menuSistemaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index'
        ]);

        return;
    }
}