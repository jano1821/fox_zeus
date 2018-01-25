<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MenuUsuarioController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for menu_usuario
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'MenuUsuario', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codMenu";

        $menu_usuario = MenuUsuario::find($parameters);
        if (count($menu_usuario) == 0) {
            $this->flash->notice("The search did not find any menu_usuario");

            $this->dispatcher->forward([
                "controller" => "menu_usuario",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $menu_usuario,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a menu_usuario
     *
     * @param string $codMenu
     */
    public function editAction($codMenu)
    {
        if (!$this->request->isPost()) {

            $menu_usuario = MenuUsuario::findFirstBycodMenu($codMenu);
            if (!$menu_usuario) {
                $this->flash->error("menu_usuario was not found");

                $this->dispatcher->forward([
                    'controller' => "menu_usuario",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codMenu = $menu_usuario->codMenu;

            $this->tag->setDefault("codMenu", $menu_usuario->codMenu);
            $this->tag->setDefault("codUsuario", $menu_usuario->codUsuario);
            $this->tag->setDefault("estadoRegistro", $menu_usuario->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $menu_usuario->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $menu_usuario->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $menu_usuario->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $menu_usuario->fechaModificacion);
            
        }
    }

    /**
     * Creates a new menu_usuario
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index'
            ]);

            return;
        }

        $menu_usuario = new MenuUsuario();
        $menu_usuario->Codmenu = $this->request->getPost("codMenu");
        $menu_usuario->Codusuario = $this->request->getPost("codUsuario");
        $menu_usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $menu_usuario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $menu_usuario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $menu_usuario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $menu_usuario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$menu_usuario->save()) {
            foreach ($menu_usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("menu_usuario was created successfully");

        $this->dispatcher->forward([
            'controller' => "menu_usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a menu_usuario edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index'
            ]);

            return;
        }

        $codMenu = $this->request->getPost("codMenu");
        $menu_usuario = MenuUsuario::findFirstBycodMenu($codMenu);

        if (!$menu_usuario) {
            $this->flash->error("menu_usuario does not exist " . $codMenu);

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'index'
            ]);

            return;
        }

        $menu_usuario->Codmenu = $this->request->getPost("codMenu");
        $menu_usuario->Codusuario = $this->request->getPost("codUsuario");
        $menu_usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $menu_usuario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $menu_usuario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $menu_usuario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $menu_usuario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$menu_usuario->save()) {

            foreach ($menu_usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "menu_usuario",
                'action' => 'edit',
                'params' => [$menu_usuario->codMenu]
            ]);

            return;
        }

        $this->flash->success("menu_usuario was updated successfully");

        $this->dispatcher->forward([
            'controller' => "menu_usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a menu_usuario
     *
     * @param string $codMenu
     */
    public function deleteAction($codMenu)
    {
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
