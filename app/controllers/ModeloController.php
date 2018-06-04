<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ModeloController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for modelo
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Modelo', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codModelo";

        $modelo = Modelo::find($parameters);
        if (count($modelo) == 0) {
            $this->flash->notice("The search did not find any modelo");

            $this->dispatcher->forward([
                "controller" => "modelo",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $modelo,
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
     * Edits a modelo
     *
     * @param string $codModelo
     */
    public function editAction($codModelo)
    {
        if (!$this->request->isPost()) {

            $modelo = Modelo::findFirstBycodModelo($codModelo);
            if (!$modelo) {
                $this->flash->error("modelo was not found");

                $this->dispatcher->forward([
                    'controller' => "modelo",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codModelo = $modelo->codModelo;

            $this->tag->setDefault("codModelo", $modelo->codModelo);
            $this->tag->setDefault("descripcion", $modelo->descripcion);
            $this->tag->setDefault("estadoRegistro", $modelo->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $modelo->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $modelo->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $modelo->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $modelo->fechaModificacion);
            $this->tag->setDefault("indicadorExclusivo", $modelo->indicadorExclusivo);
            $this->tag->setDefault("codEmpresa", $modelo->codEmpresa);
            $this->tag->setDefault("codAgencia", $modelo->codAgencia);
            
        }
    }

    /**
     * Creates a new modelo
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'index'
            ]);

            return;
        }

        $modelo = new Modelo();
        $modelo->Descripcion = $this->request->getPost("descripcion");
        $modelo->Estadoregistro = $this->request->getPost("estadoRegistro");
        $modelo->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $modelo->Fechainsercion = $this->request->getPost("fechaInsercion");
        $modelo->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $modelo->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $modelo->Indicadorexclusivo = $this->request->getPost("indicadorExclusivo");
        $modelo->Codempresa = $this->request->getPost("codEmpresa");
        $modelo->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$modelo->save()) {
            foreach ($modelo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("modelo was created successfully");

        $this->dispatcher->forward([
            'controller' => "modelo",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a modelo edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'index'
            ]);

            return;
        }

        $codModelo = $this->request->getPost("codModelo");
        $modelo = Modelo::findFirstBycodModelo($codModelo);

        if (!$modelo) {
            $this->flash->error("modelo does not exist " . $codModelo);

            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'index'
            ]);

            return;
        }

        $modelo->Descripcion = $this->request->getPost("descripcion");
        $modelo->Estadoregistro = $this->request->getPost("estadoRegistro");
        $modelo->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $modelo->Fechainsercion = $this->request->getPost("fechaInsercion");
        $modelo->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $modelo->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $modelo->Indicadorexclusivo = $this->request->getPost("indicadorExclusivo");
        $modelo->Codempresa = $this->request->getPost("codEmpresa");
        $modelo->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$modelo->save()) {

            foreach ($modelo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'edit',
                'params' => [$modelo->codModelo]
            ]);

            return;
        }

        $this->flash->success("modelo was updated successfully");

        $this->dispatcher->forward([
            'controller' => "modelo",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a modelo
     *
     * @param string $codModelo
     */
    public function deleteAction($codModelo)
    {
        $modelo = Modelo::findFirstBycodModelo($codModelo);
        if (!$modelo) {
            $this->flash->error("modelo was not found");

            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'index'
            ]);

            return;
        }

        if (!$modelo->delete()) {

            foreach ($modelo->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "modelo",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("modelo was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "modelo",
            'action' => "index"
        ]);
    }

}
