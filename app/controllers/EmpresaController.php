<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class EmpresaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for empresa
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Empresa', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codEmpresa";

        $empresa = Empresa::find($parameters);
        if (count($empresa) == 0) {
            $this->flash->notice("The search did not find any empresa");

            $this->dispatcher->forward([
                "controller" => "empresa",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $empresa,
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
     * Edits a empresa
     *
     * @param string $codEmpresa
     */
    public function editAction($codEmpresa)
    {
        if (!$this->request->isPost()) {

            $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);
            if (!$empresa) {
                $this->flash->error("empresa was not found");

                $this->dispatcher->forward([
                    'controller' => "empresa",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codEmpresa = $empresa->codEmpresa;

            $this->tag->setDefault("codEmpresa", $empresa->codEmpresa);
            $this->tag->setDefault("nombreEmpresa", $empresa->nombreEmpresa);
            $this->tag->setDefault("razonSocial", $empresa->razonSocial);
            $this->tag->setDefault("limiteUsuarios", $empresa->limiteUsuarios);
            $this->tag->setDefault("identificadorEmpresa", $empresa->identificadorEmpresa);
            $this->tag->setDefault("estadoRegistro", $empresa->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $empresa->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $empresa->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $empresa->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $empresa->fechaModificacion);
            
        }
    }

    /**
     * Creates a new empresa
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'index'
            ]);

            return;
        }

        $empresa = new Empresa();
        $empresa->Nombreempresa = $this->request->getPost("nombreEmpresa");
        $empresa->Razonsocial = $this->request->getPost("razonSocial");
        $empresa->Limiteusuarios = $this->request->getPost("limiteUsuarios");
        $empresa->Identificadorempresa = $this->request->getPost("identificadorEmpresa");
        $empresa->Estadoregistro = $this->request->getPost("estadoRegistro");
        $empresa->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $empresa->Fechainsercion = $this->request->getPost("fechaInsercion");
        $empresa->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $empresa->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$empresa->save()) {
            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("empresa was created successfully");

        $this->dispatcher->forward([
            'controller' => "empresa",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a empresa edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'index'
            ]);

            return;
        }

        $codEmpresa = $this->request->getPost("codEmpresa");
        $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);

        if (!$empresa) {
            $this->flash->error("empresa does not exist " . $codEmpresa);

            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'index'
            ]);

            return;
        }

        $empresa->Nombreempresa = $this->request->getPost("nombreEmpresa");
        $empresa->Razonsocial = $this->request->getPost("razonSocial");
        $empresa->Limiteusuarios = $this->request->getPost("limiteUsuarios");
        $empresa->Identificadorempresa = $this->request->getPost("identificadorEmpresa");
        $empresa->Estadoregistro = $this->request->getPost("estadoRegistro");
        $empresa->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $empresa->Fechainsercion = $this->request->getPost("fechaInsercion");
        $empresa->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $empresa->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$empresa->save()) {

            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'edit',
                'params' => [$empresa->codEmpresa]
            ]);

            return;
        }

        $this->flash->success("empresa was updated successfully");

        $this->dispatcher->forward([
            'controller' => "empresa",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a empresa
     *
     * @param string $codEmpresa
     */
    public function deleteAction($codEmpresa)
    {
        $empresa = Empresa::findFirstBycodEmpresa($codEmpresa);
        if (!$empresa) {
            $this->flash->error("empresa was not found");

            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'index'
            ]);

            return;
        }

        if (!$empresa->delete()) {

            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "empresa",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("empresa was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "empresa",
            'action' => "index"
        ]);
    }

}
