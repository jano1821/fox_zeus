<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AlmacenController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for almacen
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Almacen', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codAlmacen";

        $almacen = Almacen::find($parameters);
        if (count($almacen) == 0) {
            $this->flash->notice("The search did not find any almacen");

            $this->dispatcher->forward([
                "controller" => "almacen",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $almacen,
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
     * Edits a almacen
     *
     * @param string $codAlmacen
     */
    public function editAction($codAlmacen)
    {
        if (!$this->request->isPost()) {

            $almacen = Almacen::findFirstBycodAlmacen($codAlmacen);
            if (!$almacen) {
                $this->flash->error("almacen was not found");

                $this->dispatcher->forward([
                    'controller' => "almacen",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codAlmacen = $almacen->codAlmacen;

            $this->tag->setDefault("codAlmacen", $almacen->codAlmacen);
            $this->tag->setDefault("descripcion", $almacen->descripcion);
            $this->tag->setDefault("estadoRegistro", $almacen->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $almacen->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $almacen->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $almacen->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $almacen->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $almacen->codEmpresa);
            $this->tag->setDefault("codAgencia", $almacen->codAgencia);
            
        }
    }

    /**
     * Creates a new almacen
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'index'
            ]);

            return;
        }

        $almacen = new Almacen();
        $almacen->Descripcion = $this->request->getPost("descripcion");
        $almacen->Estadoregistro = $this->request->getPost("estadoRegistro");
        $almacen->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $almacen->Fechainsercion = $this->request->getPost("fechaInsercion");
        $almacen->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $almacen->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $almacen->Codempresa = $this->request->getPost("codEmpresa");
        $almacen->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$almacen->save()) {
            foreach ($almacen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("almacen was created successfully");

        $this->dispatcher->forward([
            'controller' => "almacen",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a almacen edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'index'
            ]);

            return;
        }

        $codAlmacen = $this->request->getPost("codAlmacen");
        $almacen = Almacen::findFirstBycodAlmacen($codAlmacen);

        if (!$almacen) {
            $this->flash->error("almacen does not exist " . $codAlmacen);

            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'index'
            ]);

            return;
        }

        $almacen->Descripcion = $this->request->getPost("descripcion");
        $almacen->Estadoregistro = $this->request->getPost("estadoRegistro");
        $almacen->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $almacen->Fechainsercion = $this->request->getPost("fechaInsercion");
        $almacen->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $almacen->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $almacen->Codempresa = $this->request->getPost("codEmpresa");
        $almacen->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$almacen->save()) {

            foreach ($almacen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'edit',
                'params' => [$almacen->codAlmacen]
            ]);

            return;
        }

        $this->flash->success("almacen was updated successfully");

        $this->dispatcher->forward([
            'controller' => "almacen",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a almacen
     *
     * @param string $codAlmacen
     */
    public function deleteAction($codAlmacen)
    {
        $almacen = Almacen::findFirstBycodAlmacen($codAlmacen);
        if (!$almacen) {
            $this->flash->error("almacen was not found");

            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'index'
            ]);

            return;
        }

        if (!$almacen->delete()) {

            foreach ($almacen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "almacen",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("almacen was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "almacen",
            'action' => "index"
        ]);
    }

}
