<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TipoEmpleadoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for tipo_empleado
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'TipoEmpleado', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codTipoEmpleado";

        $tipo_empleado = TipoEmpleado::find($parameters);
        if (count($tipo_empleado) == 0) {
            $this->flash->notice("The search did not find any tipo_empleado");

            $this->dispatcher->forward([
                "controller" => "tipo_empleado",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $tipo_empleado,
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
     * Edits a tipo_empleado
     *
     * @param string $codTipoEmpleado
     */
    public function editAction($codTipoEmpleado)
    {
        if (!$this->request->isPost()) {

            $tipo_empleado = TipoEmpleado::findFirstBycodTipoEmpleado($codTipoEmpleado);
            if (!$tipo_empleado) {
                $this->flash->error("tipo_empleado was not found");

                $this->dispatcher->forward([
                    'controller' => "tipo_empleado",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codTipoEmpleado = $tipo_empleado->codTipoEmpleado;

            $this->tag->setDefault("codTipoEmpleado", $tipo_empleado->codTipoEmpleado);
            $this->tag->setDefault("descripcion", $tipo_empleado->descripcion);
            $this->tag->setDefault("estadoRegistro", $tipo_empleado->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $tipo_empleado->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $tipo_empleado->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $tipo_empleado->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $tipo_empleado->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $tipo_empleado->codEmpresa);
            
        }
    }

    /**
     * Creates a new tipo_empleado
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'index'
            ]);

            return;
        }

        $tipo_empleado = new TipoEmpleado();
        $tipo_empleado->Descripcion = $this->request->getPost("descripcion");
        $tipo_empleado->Estadoregistro = $this->request->getPost("estadoRegistro");
        $tipo_empleado->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $tipo_empleado->Fechainsercion = $this->request->getPost("fechaInsercion");
        $tipo_empleado->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $tipo_empleado->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $tipo_empleado->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$tipo_empleado->save()) {
            foreach ($tipo_empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("tipo_empleado was created successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_empleado",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a tipo_empleado edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'index'
            ]);

            return;
        }

        $codTipoEmpleado = $this->request->getPost("codTipoEmpleado");
        $tipo_empleado = TipoEmpleado::findFirstBycodTipoEmpleado($codTipoEmpleado);

        if (!$tipo_empleado) {
            $this->flash->error("tipo_empleado does not exist " . $codTipoEmpleado);

            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'index'
            ]);

            return;
        }

        $tipo_empleado->Descripcion = $this->request->getPost("descripcion");
        $tipo_empleado->Estadoregistro = $this->request->getPost("estadoRegistro");
        $tipo_empleado->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $tipo_empleado->Fechainsercion = $this->request->getPost("fechaInsercion");
        $tipo_empleado->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $tipo_empleado->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $tipo_empleado->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$tipo_empleado->save()) {

            foreach ($tipo_empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'edit',
                'params' => [$tipo_empleado->codTipoEmpleado]
            ]);

            return;
        }

        $this->flash->success("tipo_empleado was updated successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_empleado",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a tipo_empleado
     *
     * @param string $codTipoEmpleado
     */
    public function deleteAction($codTipoEmpleado)
    {
        $tipo_empleado = TipoEmpleado::findFirstBycodTipoEmpleado($codTipoEmpleado);
        if (!$tipo_empleado) {
            $this->flash->error("tipo_empleado was not found");

            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'index'
            ]);

            return;
        }

        if (!$tipo_empleado->delete()) {

            foreach ($tipo_empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_empleado",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("tipo_empleado was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_empleado",
            'action' => "index"
        ]);
    }

}
