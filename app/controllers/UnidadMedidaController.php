<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UnidadMedidaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for unidad_medida
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'UnidadMedida', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codUnidad";

        $unidad_medida = UnidadMedida::find($parameters);
        if (count($unidad_medida) == 0) {
            $this->flash->notice("The search did not find any unidad_medida");

            $this->dispatcher->forward([
                "controller" => "unidad_medida",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $unidad_medida,
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
     * Edits a unidad_medida
     *
     * @param string $codUnidad
     */
    public function editAction($codUnidad)
    {
        if (!$this->request->isPost()) {

            $unidad_medida = UnidadMedida::findFirstBycodUnidad($codUnidad);
            if (!$unidad_medida) {
                $this->flash->error("unidad_medida was not found");

                $this->dispatcher->forward([
                    'controller' => "unidad_medida",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codUnidad = $unidad_medida->codUnidad;

            $this->tag->setDefault("codUnidad", $unidad_medida->codUnidad);
            $this->tag->setDefault("descripcion", $unidad_medida->descripcion);
            $this->tag->setDefault("estadoRegistro", $unidad_medida->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $unidad_medida->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $unidad_medida->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $unidad_medida->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $unidad_medida->fechaModificacion);
            
        }
    }

    /**
     * Creates a new unidad_medida
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'index'
            ]);

            return;
        }

        $unidad_medida = new UnidadMedida();
        $unidad_medida->Descripcion = $this->request->getPost("descripcion");
        $unidad_medida->Estadoregistro = $this->request->getPost("estadoRegistro");
        $unidad_medida->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $unidad_medida->Fechainsercion = $this->request->getPost("fechaInsercion");
        $unidad_medida->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $unidad_medida->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$unidad_medida->save()) {
            foreach ($unidad_medida->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("unidad_medida was created successfully");

        $this->dispatcher->forward([
            'controller' => "unidad_medida",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a unidad_medida edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'index'
            ]);

            return;
        }

        $codUnidad = $this->request->getPost("codUnidad");
        $unidad_medida = UnidadMedida::findFirstBycodUnidad($codUnidad);

        if (!$unidad_medida) {
            $this->flash->error("unidad_medida does not exist " . $codUnidad);

            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'index'
            ]);

            return;
        }

        $unidad_medida->Descripcion = $this->request->getPost("descripcion");
        $unidad_medida->Estadoregistro = $this->request->getPost("estadoRegistro");
        $unidad_medida->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $unidad_medida->Fechainsercion = $this->request->getPost("fechaInsercion");
        $unidad_medida->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $unidad_medida->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$unidad_medida->save()) {

            foreach ($unidad_medida->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'edit',
                'params' => [$unidad_medida->codUnidad]
            ]);

            return;
        }

        $this->flash->success("unidad_medida was updated successfully");

        $this->dispatcher->forward([
            'controller' => "unidad_medida",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a unidad_medida
     *
     * @param string $codUnidad
     */
    public function deleteAction($codUnidad)
    {
        $unidad_medida = UnidadMedida::findFirstBycodUnidad($codUnidad);
        if (!$unidad_medida) {
            $this->flash->error("unidad_medida was not found");

            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'index'
            ]);

            return;
        }

        if (!$unidad_medida->delete()) {

            foreach ($unidad_medida->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "unidad_medida",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("unidad_medida was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "unidad_medida",
            'action' => "index"
        ]);
    }

}
