<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class EmpleadoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for empleado
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Empleado', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codPersona";

        $empleado = Empleado::find($parameters);
        if (count($empleado) == 0) {
            $this->flash->notice("The search did not find any empleado");

            $this->dispatcher->forward([
                "controller" => "empleado",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $empleado,
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
     * Edits a empleado
     *
     * @param string $codPersona
     */
    public function editAction($codPersona)
    {
        if (!$this->request->isPost()) {

            $empleado = Empleado::findFirstBycodPersona($codPersona);
            if (!$empleado) {
                $this->flash->error("empleado was not found");

                $this->dispatcher->forward([
                    'controller' => "empleado",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codPersona = $empleado->codPersona;

            $this->tag->setDefault("codPersona", $empleado->codPersona);
            $this->tag->setDefault("codTipoEmpleado", $empleado->codTipoEmpleado);
            $this->tag->setDefault("codEmpresa", $empleado->codEmpresa);
            $this->tag->setDefault("codAgencia", $empleado->codAgencia);
            
        }
    }

    /**
     * Creates a new empleado
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'index'
            ]);

            return;
        }

        $empleado = new Empleado();
        $empleado->Codpersona = $this->request->getPost("codPersona");
        $empleado->Codtipoempleado = $this->request->getPost("codTipoEmpleado");
        $empleado->Codempresa = $this->request->getPost("codEmpresa");
        $empleado->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$empleado->save()) {
            foreach ($empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("empleado was created successfully");

        $this->dispatcher->forward([
            'controller' => "empleado",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a empleado edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'index'
            ]);

            return;
        }

        $codPersona = $this->request->getPost("codPersona");
        $empleado = Empleado::findFirstBycodPersona($codPersona);

        if (!$empleado) {
            $this->flash->error("empleado does not exist " . $codPersona);

            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'index'
            ]);

            return;
        }

        $empleado->Codpersona = $this->request->getPost("codPersona");
        $empleado->Codtipoempleado = $this->request->getPost("codTipoEmpleado");
        $empleado->Codempresa = $this->request->getPost("codEmpresa");
        $empleado->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$empleado->save()) {

            foreach ($empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'edit',
                'params' => [$empleado->codPersona]
            ]);

            return;
        }

        $this->flash->success("empleado was updated successfully");

        $this->dispatcher->forward([
            'controller' => "empleado",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a empleado
     *
     * @param string $codPersona
     */
    public function deleteAction($codPersona)
    {
        $empleado = Empleado::findFirstBycodPersona($codPersona);
        if (!$empleado) {
            $this->flash->error("empleado was not found");

            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'index'
            ]);

            return;
        }

        if (!$empleado->delete()) {

            foreach ($empleado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empleado",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("empleado was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "empleado",
            'action' => "index"
        ]);
    }

}
