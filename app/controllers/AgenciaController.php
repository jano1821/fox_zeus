<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AgenciaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for agencia
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Agencia', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codAgencia";

        $agencia = Agencia::find($parameters);
        if (count($agencia) == 0) {
            $this->flash->notice("The search did not find any agencia");

            $this->dispatcher->forward([
                "controller" => "agencia",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $agencia,
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
     * Edits a agencia
     *
     * @param string $codAgencia
     */
    public function editAction($codAgencia)
    {
        if (!$this->request->isPost()) {

            $agencia = Agencia::findFirstBycodAgencia($codAgencia);
            if (!$agencia) {
                $this->flash->error("agencia was not found");

                $this->dispatcher->forward([
                    'controller' => "agencia",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codAgencia = $agencia->codAgencia;

            $this->tag->setDefault("codAgencia", $agencia->codAgencia);
            $this->tag->setDefault("descripcion", $agencia->descripcion);
            $this->tag->setDefault("estadoRegistro", $agencia->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $agencia->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $agencia->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $agencia->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $agencia->fechaModificacion);
            $this->tag->setDefault("codEmpresa", $agencia->codEmpresa);
            
        }
    }

    /**
     * Creates a new agencia
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'index'
            ]);

            return;
        }

        $agencia = new Agencia();
        $agencia->Descripcion = $this->request->getPost("descripcion");
        $agencia->Estadoregistro = $this->request->getPost("estadoRegistro");
        $agencia->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $agencia->Fechainsercion = $this->request->getPost("fechaInsercion");
        $agencia->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $agencia->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $agencia->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$agencia->save()) {
            foreach ($agencia->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("agencia was created successfully");

        $this->dispatcher->forward([
            'controller' => "agencia",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a agencia edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'index'
            ]);

            return;
        }

        $codAgencia = $this->request->getPost("codAgencia");
        $agencia = Agencia::findFirstBycodAgencia($codAgencia);

        if (!$agencia) {
            $this->flash->error("agencia does not exist " . $codAgencia);

            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'index'
            ]);

            return;
        }

        $agencia->Descripcion = $this->request->getPost("descripcion");
        $agencia->Estadoregistro = $this->request->getPost("estadoRegistro");
        $agencia->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $agencia->Fechainsercion = $this->request->getPost("fechaInsercion");
        $agencia->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $agencia->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $agencia->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$agencia->save()) {

            foreach ($agencia->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'edit',
                'params' => [$agencia->codAgencia]
            ]);

            return;
        }

        $this->flash->success("agencia was updated successfully");

        $this->dispatcher->forward([
            'controller' => "agencia",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a agencia
     *
     * @param string $codAgencia
     */
    public function deleteAction($codAgencia)
    {
        $agencia = Agencia::findFirstBycodAgencia($codAgencia);
        if (!$agencia) {
            $this->flash->error("agencia was not found");

            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'index'
            ]);

            return;
        }

        if (!$agencia->delete()) {

            foreach ($agencia->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "agencia",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("agencia was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "agencia",
            'action' => "index"
        ]);
    }

}
