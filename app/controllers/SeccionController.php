<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class SeccionController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for seccion
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Seccion', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codSecion";

        $seccion = Seccion::find($parameters);
        if (count($seccion) == 0) {
            $this->flash->notice("The search did not find any seccion");

            $this->dispatcher->forward([
                "controller" => "seccion",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $seccion,
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
     * Edits a seccion
     *
     * @param string $codSecion
     */
    public function editAction($codSecion)
    {
        if (!$this->request->isPost()) {

            $seccion = Seccion::findFirstBycodSecion($codSecion);
            if (!$seccion) {
                $this->flash->error("seccion was not found");

                $this->dispatcher->forward([
                    'controller' => "seccion",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codSecion = $seccion->codSecion;

            $this->tag->setDefault("codSecion", $seccion->codSecion);
            $this->tag->setDefault("descripcion", $seccion->descripcion);
            $this->tag->setDefault("estadoRegistro", $seccion->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $seccion->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $seccion->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $seccion->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $seccion->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $seccion->codEmpresa);
            $this->tag->setDefault("codAgencia", $seccion->codAgencia);
            
        }
    }

    /**
     * Creates a new seccion
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'index'
            ]);

            return;
        }

        $seccion = new Seccion();
        $seccion->Descripcion = $this->request->getPost("descripcion");
        $seccion->Estadoregistro = $this->request->getPost("estadoRegistro");
        $seccion->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $seccion->Fechainsercion = $this->request->getPost("fechaInsercion");
        $seccion->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $seccion->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $seccion->Codempresa = $this->request->getPost("codEmpresa");
        $seccion->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$seccion->save()) {
            foreach ($seccion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("seccion was created successfully");

        $this->dispatcher->forward([
            'controller' => "seccion",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a seccion edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'index'
            ]);

            return;
        }

        $codSecion = $this->request->getPost("codSecion");
        $seccion = Seccion::findFirstBycodSecion($codSecion);

        if (!$seccion) {
            $this->flash->error("seccion does not exist " . $codSecion);

            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'index'
            ]);

            return;
        }

        $seccion->Descripcion = $this->request->getPost("descripcion");
        $seccion->Estadoregistro = $this->request->getPost("estadoRegistro");
        $seccion->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $seccion->Fechainsercion = $this->request->getPost("fechaInsercion");
        $seccion->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $seccion->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $seccion->Codempresa = $this->request->getPost("codEmpresa");
        $seccion->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$seccion->save()) {

            foreach ($seccion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'edit',
                'params' => [$seccion->codSecion]
            ]);

            return;
        }

        $this->flash->success("seccion was updated successfully");

        $this->dispatcher->forward([
            'controller' => "seccion",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a seccion
     *
     * @param string $codSecion
     */
    public function deleteAction($codSecion)
    {
        $seccion = Seccion::findFirstBycodSecion($codSecion);
        if (!$seccion) {
            $this->flash->error("seccion was not found");

            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'index'
            ]);

            return;
        }

        if (!$seccion->delete()) {

            foreach ($seccion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "seccion",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("seccion was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "seccion",
            'action' => "index"
        ]);
    }

}
