<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MenuSistemaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for menu_sistema
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'MenuSistema', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codMenu";

        $menu_sistema = MenuSistema::find($parameters);
        if (count($menu_sistema) == 0) {
            $this->flash->notice("The search did not find any menu_sistema");

            $this->dispatcher->forward([
                "controller" => "menu_sistema",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $menu_sistema,
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
     * Edits a menu_sistema
     *
     * @param string $codMenu
     */
    public function editAction($codMenu)
    {
        if (!$this->request->isPost()) {

            $menu_sistema = MenuSistema::findFirstBycodMenu($codMenu);
            if (!$menu_sistema) {
                $this->flash->error("menu_sistema was not found");

                $this->dispatcher->forward([
                    'controller' => "menu_sistema",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codMenu = $menu_sistema->codMenu;

            $this->tag->setDefault("codMenu", $menu_sistema->codMenu);
            $this->tag->setDefault("codSistema", $menu_sistema->codSistema);
            $this->tag->setDefault("codUsuario", $menu_sistema->codUsuario);
            $this->tag->setDefault("estadoRegistro", $menu_sistema->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $menu_sistema->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $menu_sistema->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $menu_sistema->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $menu_sistema->fechaModificacion);
            
        }
    }

    /**
     * Creates a new menu_sistema
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "menu_sistema",
                'action' => 'index'
            ]);

            return;
        }

        $menu_sistema = new MenuSistema();
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
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("menu_sistema was created successfully");

        $this->dispatcher->forward([
            'controller' => "menu_sistema",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a menu_sistema edited
     *
     */
    public function saveAction()
    {

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
    public function deleteAction($codMenu)
    {
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

}
