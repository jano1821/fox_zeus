<?php

use Phalcon\Paginator\Adapter\Model as Paginator;

class MenuUsuarioController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction($codUsuario) {
        parent::validarSession();
        $usuarioController = new UsuarioController();

        $usuario = $usuarioController->findById($codUsuario);

        $this->tag->setDefault("codUsuario", $codUsuario);
        $this->view->setVar("codigoUsuario", $codUsuario);
        $this->view->setVar("usuario", strtoupper($usuario->nombreUsuario));

        $this->view->form = new MenuUsuarioIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $codMenu = $this->request->getPost("codMenu");
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
        $menu_usuario = $this->modelsManager->createBuilder()
                ->columns("ms.codMenu," .
                        "ms.codUsuario," .
                        "us.nombreUsuario, " .
                        "me.descripcion, " .
                        "if(ms.estadoRegistro='S','Vigente','No Vigente') as estado")
                ->addFrom('MenuUsuario', 'ms')
                ->innerJoin('Menu', 'me.codMenu = ms.codMenu', 'me')
                ->innerJoin('Usuario', 'us.codUsuario = ms.codUsuario', 'us')
                ->andWhere('ms.codMenu like :codMenu: AND ' .
                        'ms.codUsuario like :codUsuario: AND ' .
                        'ms.estadoRegistro like :estado: ', [
                    'codMenu' => "%" . $codMenu . "%",
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
        } else if ($avance == 1) {
            if ($pagina < floor(count($menu_usuario) / 10) + 1) {
                $pagina = $pagina + 1;
            } else {
                $this->flash->notice("No hay Registros Posteriores");
            }
        } else if ($avance == -1) {
            if ($pagina > 1) {
                $pagina = $pagina - 1;
            } else {
                $this->flash->notice("No hay Registros Anteriores");
            }
        } else if ($avance == 2) {
            $pagina = floor(count($menu_usuario) / 10) + 1;
        }

        if (count($menu_usuario) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                "controller" => "menu_usuario",
                "action" => "index",
                "params" => [$codUsuario]
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $menu_usuario,
            'limit' => 10,
            'page' => $pagina
        ]);

        $this->tag->setDefault("pagina", $pagina);
        $this->tag->setDefault("codUsuario", $codUsuario);
        $this->view->setVar("codigoUsuario", strtoupper($codUsuario));
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction($codUsuario) {
        parent::validarSession();

        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->findById($codUsuario);

        $this->tag->setDefault("codUsuario", $codUsuario);
        $this->view->setVar("codigoUsuario", $codUsuario);
        $this->view->setVar("usuario", strtoupper($usuario->nombreUsuario));

        $this->view->form = new MenuUsuarioNewForm();
    }

    public function editAction($codMenu, $codUsuario) {
        if (!$this->request->isPost()) {

            $menu_usuario = $this->modelsManager->createBuilder()
                    ->columns("mu.codMenu," .
                            "mu.codUsuario," .
                            "us.nombreUsuario, " .
                            "me.descripcion, " .
                            "mu.estadoRegistro ")
                    ->addFrom('MenuUsuario', 'mu')
                    ->innerJoin('Menu', 'me.codMenu = mu.codMenu', 'me')
                    ->innerJoin('Usuario', 'us.codUsuario = mu.codUsuario', 'us')
                    ->andWhere('mu.codMenu like :codMenu: AND ' .
                            'mu.codUsuario like :codUsuario: ', [
                        'codMenu' => "%" . $codMenu . "%",
                        'codUsuario' => "%" . $codUsuario . "%",
                            ]
                    )
                    ->getQuery()
                    ->execute();

            if (!$menu_usuario) {
                $this->flash->error("Menu Usuario no Encontrado");

                $this->dispatcher->forward([
                    'controller' => "menu_usuario",
                    'action' => 'index',
                    'params' => [$codUsuario]
                ]);

                return;
            }

            $this->view->codMenu = $codMenu;
            $this->view->codigoUsuario = $codUsuario;
            $this->view->usuario = $menu_usuario[0]->nombreUsuario;

            $this->tag->setDefault("codMenu", $menu_usuario[0]->codMenu);
            $this->tag->setDefault("codUsuario", $menu_usuario[0]->codUsuario);
            $this->tag->setDefault("nombreMenu", $menu_usuario[0]->descripcion);
            $this->tag->setDefault("estadoRegistro", $menu_usuario[0]->estadoRegistro);
        }
        $this->view->form = new MenuUsuarioEditForm();
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
        } else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $menu_usuario = new MenuUsuario();
        $menu_usuario->Codmenu = $this->request->getPost("codMenu");
        $menu_usuario->Codusuario = $this->request->getPost("codUsuario");
        $menu_usuario->Estadoregistro = "S";
        $menu_usuario->Usuarioinsercion = $username;
        $menu_usuario->Fechainsercion = strftime("%Y-%m-%d", time());

        if (!$menu_usuario->save()) {
            foreach ($menu_usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'new',
                'params' => [$this->request->getPost("codUsuario")]
            ]);

            return;
        }

        $this->flash->success("Menu Usuario se Registró Satisfactoriamente");

        $this->dispatcher->forward([
            'controller' => "menu_usuario",
            'action' => 'index',
            'params' => [$this->request->getPost("codUsuario")]
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index',
                'params' => [0]
            ]);

            return;
        }

        $codMenu = $this->request->getPost("codMenu");
        $codUsuario = $this->request->getPost("codUsuario");
        
        $menu_usuario = MenuUsuario::findFirst([
        "codMenu = $codMenu",
        "codUsuario = $codUsuario",
    ]);
        
        /*$menu_usuario = $this->modelsManager->createBuilder()
                ->columns("mu.codMenu," .
                        "mu.codUsuario," .
                        "mu.estadoRegistro ")
                ->addFrom('MenuUsuario', 'mu')
                ->andWhere('mu.codMenu = :codMenu: AND ' .
                        'mu.codUsuario = :codUsuario: ', [
                    'codMenu' => $codMenu,
                    'codUsuario' => $codUsuario,
                        ]
                )
                ->getQuery()
                ->execute();*/

        if (!$menu_usuario) {
            $this->flash->error("Menu Usuario no Encontrado");

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index',
                'params' => [$codUsuario]
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
        } else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $menu_usuario->Codmenu = $this->request->getPost("codMenu");
        $menu_usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $menu_usuario->Usuariomodificacion = $username;
        $menu_usuario->Fechamodificacion = strftime("%Y-%m-%d", time());

        if (!$menu_usuario->save()) {
            foreach ($menu_usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'edit',
                'params' => [$codUsuario]
            ]);

            return;
        }

        $this->flash->success("Menu Usuario Actualizado");

        $this->dispatcher->forward([
            'controller' => "menu_usuario",
            'action' => 'index',
            'params' => [$codUsuario]
        ]);
    }

    /**
     * Deletes a menu_usuario
     *
     * @param string $codMenu
     */
    public function deleteAction($codMenu) {
        $menu_usuario = MenuUsuario::findFirstBycodMenu($codMenu);
        if (!$menu_usuario) {
            $this->flash->error("menu_usuario was not found");

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index'
            ]);

            return;
        }

        if (!$menu_usuario->delete()) {

            foreach ($menu_usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("menu_usuario was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "menu_usuario",
            'action' => "index"
        ]);
    }

}
