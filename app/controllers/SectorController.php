<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class SectorController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for sector
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Sector', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codSector";

        $sector = Sector::find($parameters);
        if (count($sector) == 0) {
            $this->flash->notice("The search did not find any sector");

            $this->dispatcher->forward([
                "controller" => "sector",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $sector,
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
     * Edits a sector
     *
     * @param string $codSector
     */
    public function editAction($codSector)
    {
        if (!$this->request->isPost()) {

            $sector = Sector::findFirstBycodSector($codSector);
            if (!$sector) {
                $this->flash->error("sector was not found");

                $this->dispatcher->forward([
                    'controller' => "sector",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codSector = $sector->codSector;

            $this->tag->setDefault("codSector", $sector->codSector);
            $this->tag->setDefault("descripcion", $sector->descripcion);
            $this->tag->setDefault("estadoRegistro", $sector->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $sector->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $sector->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $sector->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $sector->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $sector->codEmpresa);
            $this->tag->setDefault("codAgencia", $sector->codAgencia);
            
        }
    }

    /**
     * Creates a new sector
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'index'
            ]);

            return;
        }

        $sector = new Sector();
        $sector->Descripcion = $this->request->getPost("descripcion");
        $sector->Estadoregistro = $this->request->getPost("estadoRegistro");
        $sector->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $sector->Fechainsercion = $this->request->getPost("fechaInsercion");
        $sector->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $sector->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $sector->Codempresa = $this->request->getPost("codEmpresa");
        $sector->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$sector->save()) {
            foreach ($sector->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("sector was created successfully");

        $this->dispatcher->forward([
            'controller' => "sector",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a sector edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'index'
            ]);

            return;
        }

        $codSector = $this->request->getPost("codSector");
        $sector = Sector::findFirstBycodSector($codSector);

        if (!$sector) {
            $this->flash->error("sector does not exist " . $codSector);

            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'index'
            ]);

            return;
        }

        $sector->Descripcion = $this->request->getPost("descripcion");
        $sector->Estadoregistro = $this->request->getPost("estadoRegistro");
        $sector->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $sector->Fechainsercion = $this->request->getPost("fechaInsercion");
        $sector->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $sector->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $sector->Codempresa = $this->request->getPost("codEmpresa");
        $sector->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$sector->save()) {

            foreach ($sector->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'edit',
                'params' => [$sector->codSector]
            ]);

            return;
        }

        $this->flash->success("sector was updated successfully");

        $this->dispatcher->forward([
            'controller' => "sector",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a sector
     *
     * @param string $codSector
     */
    public function deleteAction($codSector)
    {
        $sector = Sector::findFirstBycodSector($codSector);
        if (!$sector) {
            $this->flash->error("sector was not found");

            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'index'
            ]);

            return;
        }

        if (!$sector->delete()) {

            foreach ($sector->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sector",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("sector was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "sector",
            'action' => "index"
        ]);
    }

}
