<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ZonaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for zona
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Zona', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codZona";

        $zona = Zona::find($parameters);
        if (count($zona) == 0) {
            $this->flash->notice("The search did not find any zona");

            $this->dispatcher->forward([
                "controller" => "zona",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $zona,
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
     * Edits a zona
     *
     * @param string $codZona
     */
    public function editAction($codZona)
    {
        if (!$this->request->isPost()) {

            $zona = Zona::findFirstBycodZona($codZona);
            if (!$zona) {
                $this->flash->error("zona was not found");

                $this->dispatcher->forward([
                    'controller' => "zona",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codZona = $zona->codZona;

            $this->tag->setDefault("codZona", $zona->codZona);
            $this->tag->setDefault("descripcion", $zona->descripcion);
            $this->tag->setDefault("estadoRegistro", $zona->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $zona->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $zona->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $zona->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $zona->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $zona->codEmpresa);
            $this->tag->setDefault("codAgencia", $zona->codAgencia);
            
        }
    }

    /**
     * Creates a new zona
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'index'
            ]);

            return;
        }

        $zona = new Zona();
        $zona->Descripcion = $this->request->getPost("descripcion");
        $zona->Estadoregistro = $this->request->getPost("estadoRegistro");
        $zona->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $zona->Fechainsercion = $this->request->getPost("fechaInsercion");
        $zona->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $zona->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $zona->Codempresa = $this->request->getPost("codEmpresa");
        $zona->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$zona->save()) {
            foreach ($zona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("zona was created successfully");

        $this->dispatcher->forward([
            'controller' => "zona",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a zona edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'index'
            ]);

            return;
        }

        $codZona = $this->request->getPost("codZona");
        $zona = Zona::findFirstBycodZona($codZona);

        if (!$zona) {
            $this->flash->error("zona does not exist " . $codZona);

            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'index'
            ]);

            return;
        }

        $zona->Descripcion = $this->request->getPost("descripcion");
        $zona->Estadoregistro = $this->request->getPost("estadoRegistro");
        $zona->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $zona->Fechainsercion = $this->request->getPost("fechaInsercion");
        $zona->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $zona->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $zona->Codempresa = $this->request->getPost("codEmpresa");
        $zona->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$zona->save()) {

            foreach ($zona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'edit',
                'params' => [$zona->codZona]
            ]);

            return;
        }

        $this->flash->success("zona was updated successfully");

        $this->dispatcher->forward([
            'controller' => "zona",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a zona
     *
     * @param string $codZona
     */
    public function deleteAction($codZona)
    {
        $zona = Zona::findFirstBycodZona($codZona);
        if (!$zona) {
            $this->flash->error("zona was not found");

            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'index'
            ]);

            return;
        }

        if (!$zona->delete()) {

            foreach ($zona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zona",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("zona was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "zona",
            'action' => "index"
        ]);
    }

}
