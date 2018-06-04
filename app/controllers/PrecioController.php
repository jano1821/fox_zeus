<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PrecioController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for precio
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Precio', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codPrecio";

        $precio = Precio::find($parameters);
        if (count($precio) == 0) {
            $this->flash->notice("The search did not find any precio");

            $this->dispatcher->forward([
                "controller" => "precio",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $precio,
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
     * Edits a precio
     *
     * @param string $codPrecio
     */
    public function editAction($codPrecio)
    {
        if (!$this->request->isPost()) {

            $precio = Precio::findFirstBycodPrecio($codPrecio);
            if (!$precio) {
                $this->flash->error("precio was not found");

                $this->dispatcher->forward([
                    'controller' => "precio",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codPrecio = $precio->codPrecio;

            $this->tag->setDefault("codPrecio", $precio->codPrecio);
            $this->tag->setDefault("descripcion", $precio->descripcion);
            $this->tag->setDefault("monto", $precio->monto);
            $this->tag->setDefault("codEmpresa", $precio->codEmpresa);
            $this->tag->setDefault("estadoRegistro", $precio->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $precio->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $precio->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $precio->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $precio->fechaModificacion);
            $this->tag->setDefault("codAgencia", $precio->codAgencia);
            
        }
    }

    /**
     * Creates a new precio
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'index'
            ]);

            return;
        }

        $precio = new Precio();
        $precio->Descripcion = $this->request->getPost("descripcion");
        $precio->Monto = $this->request->getPost("monto");
        $precio->Codempresa = $this->request->getPost("codEmpresa");
        $precio->Estadoregistro = $this->request->getPost("estadoRegistro");
        $precio->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $precio->Fechainsercion = $this->request->getPost("fechaInsercion");
        $precio->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $precio->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $precio->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$precio->save()) {
            foreach ($precio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("precio was created successfully");

        $this->dispatcher->forward([
            'controller' => "precio",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a precio edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'index'
            ]);

            return;
        }

        $codPrecio = $this->request->getPost("codPrecio");
        $precio = Precio::findFirstBycodPrecio($codPrecio);

        if (!$precio) {
            $this->flash->error("precio does not exist " . $codPrecio);

            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'index'
            ]);

            return;
        }

        $precio->Descripcion = $this->request->getPost("descripcion");
        $precio->Monto = $this->request->getPost("monto");
        $precio->Codempresa = $this->request->getPost("codEmpresa");
        $precio->Estadoregistro = $this->request->getPost("estadoRegistro");
        $precio->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $precio->Fechainsercion = $this->request->getPost("fechaInsercion");
        $precio->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $precio->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $precio->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$precio->save()) {

            foreach ($precio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'edit',
                'params' => [$precio->codPrecio]
            ]);

            return;
        }

        $this->flash->success("precio was updated successfully");

        $this->dispatcher->forward([
            'controller' => "precio",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a precio
     *
     * @param string $codPrecio
     */
    public function deleteAction($codPrecio)
    {
        $precio = Precio::findFirstBycodPrecio($codPrecio);
        if (!$precio) {
            $this->flash->error("precio was not found");

            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'index'
            ]);

            return;
        }

        if (!$precio->delete()) {

            foreach ($precio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "precio",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("precio was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "precio",
            'action' => "index"
        ]);
    }

}
