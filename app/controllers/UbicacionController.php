<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UbicacionController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for ubicacion
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Ubicacion', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codUbicacion";

        $ubicacion = Ubicacion::find($parameters);
        if (count($ubicacion) == 0) {
            $this->flash->notice("The search did not find any ubicacion");

            $this->dispatcher->forward([
                "controller" => "ubicacion",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $ubicacion,
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
     * Edits a ubicacion
     *
     * @param string $codUbicacion
     */
    public function editAction($codUbicacion)
    {
        if (!$this->request->isPost()) {

            $ubicacion = Ubicacion::findFirstBycodUbicacion($codUbicacion);
            if (!$ubicacion) {
                $this->flash->error("ubicacion was not found");

                $this->dispatcher->forward([
                    'controller' => "ubicacion",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codUbicacion = $ubicacion->codUbicacion;

            $this->tag->setDefault("codUbicacion", $ubicacion->codUbicacion);
            $this->tag->setDefault("codSecion", $ubicacion->codSecion);
            $this->tag->setDefault("codZona", $ubicacion->codZona);
            $this->tag->setDefault("codSector", $ubicacion->codSector);
            $this->tag->setDefault("codAlmacen", $ubicacion->codAlmacen);
            $this->tag->setDefault("codEmpresa", $ubicacion->codEmpresa);
            $this->tag->setDefault("codProducto", $ubicacion->codProducto);
            $this->tag->setDefault("codAgencia", $ubicacion->codAgencia);
            
        }
    }

    /**
     * Creates a new ubicacion
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'index'
            ]);

            return;
        }

        $ubicacion = new Ubicacion();
        $ubicacion->Codsecion = $this->request->getPost("codSecion");
        $ubicacion->Codzona = $this->request->getPost("codZona");
        $ubicacion->Codsector = $this->request->getPost("codSector");
        $ubicacion->Codalmacen = $this->request->getPost("codAlmacen");
        $ubicacion->Codempresa = $this->request->getPost("codEmpresa");
        $ubicacion->Codproducto = $this->request->getPost("codProducto");
        $ubicacion->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$ubicacion->save()) {
            foreach ($ubicacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("ubicacion was created successfully");

        $this->dispatcher->forward([
            'controller' => "ubicacion",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a ubicacion edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'index'
            ]);

            return;
        }

        $codUbicacion = $this->request->getPost("codUbicacion");
        $ubicacion = Ubicacion::findFirstBycodUbicacion($codUbicacion);

        if (!$ubicacion) {
            $this->flash->error("ubicacion does not exist " . $codUbicacion);

            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'index'
            ]);

            return;
        }

        $ubicacion->Codsecion = $this->request->getPost("codSecion");
        $ubicacion->Codzona = $this->request->getPost("codZona");
        $ubicacion->Codsector = $this->request->getPost("codSector");
        $ubicacion->Codalmacen = $this->request->getPost("codAlmacen");
        $ubicacion->Codempresa = $this->request->getPost("codEmpresa");
        $ubicacion->Codproducto = $this->request->getPost("codProducto");
        $ubicacion->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$ubicacion->save()) {

            foreach ($ubicacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'edit',
                'params' => [$ubicacion->codUbicacion]
            ]);

            return;
        }

        $this->flash->success("ubicacion was updated successfully");

        $this->dispatcher->forward([
            'controller' => "ubicacion",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a ubicacion
     *
     * @param string $codUbicacion
     */
    public function deleteAction($codUbicacion)
    {
        $ubicacion = Ubicacion::findFirstBycodUbicacion($codUbicacion);
        if (!$ubicacion) {
            $this->flash->error("ubicacion was not found");

            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'index'
            ]);

            return;
        }

        if (!$ubicacion->delete()) {

            foreach ($ubicacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ubicacion",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("ubicacion was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "ubicacion",
            'action' => "index"
        ]);
    }

}
