<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ParametrosGeneralesController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for parametros_generales
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ParametrosGenerales', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codParametro";

        $parametros_generales = ParametrosGenerales::find($parameters);
        if (count($parametros_generales) == 0) {
            $this->flash->notice("The search did not find any parametros_generales");

            $this->dispatcher->forward([
                "controller" => "parametros_generales",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $parametros_generales,
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
     * Edits a parametros_generale
     *
     * @param string $codParametro
     */
    public function editAction($codParametro)
    {
        if (!$this->request->isPost()) {

            $parametros_generale = ParametrosGenerales::findFirstBycodParametro($codParametro);
            if (!$parametros_generale) {
                $this->flash->error("parametros_generale was not found");

                $this->dispatcher->forward([
                    'controller' => "parametros_generales",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codParametro = $parametros_generale->codParametro;

            $this->tag->setDefault("codParametro", $parametros_generale->codParametro);
            $this->tag->setDefault("identificadorParametro", $parametros_generale->identificadorParametro);
            $this->tag->setDefault("valorParametro", $parametros_generale->valorParametro);
            $this->tag->setDefault("estadoRegistro", $parametros_generale->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $parametros_generale->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $parametros_generale->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $parametros_generale->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $parametros_generale->fechaModificacion);
            $this->tag->setDefault("indicadorFijo", $parametros_generale->indicadorFijo);
            $this->tag->setDefault("codEmpresa", $parametros_generale->codEmpresa);
            
        }
    }

    /**
     * Creates a new parametros_generale
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'index'
            ]);

            return;
        }

        $parametros_generale = new ParametrosGenerales();
        $parametros_generale->Identificadorparametro = $this->request->getPost("identificadorParametro");
        $parametros_generale->Valorparametro = $this->request->getPost("valorParametro");
        $parametros_generale->Estadoregistro = $this->request->getPost("estadoRegistro");
        $parametros_generale->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $parametros_generale->Fechainsercion = $this->request->getPost("fechaInsercion");
        $parametros_generale->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $parametros_generale->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $parametros_generale->Indicadorfijo = $this->request->getPost("indicadorFijo");
        $parametros_generale->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$parametros_generale->save()) {
            foreach ($parametros_generale->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("parametros_generale was created successfully");

        $this->dispatcher->forward([
            'controller' => "parametros_generales",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a parametros_generale edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'index'
            ]);

            return;
        }

        $codParametro = $this->request->getPost("codParametro");
        $parametros_generale = ParametrosGenerales::findFirstBycodParametro($codParametro);

        if (!$parametros_generale) {
            $this->flash->error("parametros_generale does not exist " . $codParametro);

            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'index'
            ]);

            return;
        }

        $parametros_generale->Identificadorparametro = $this->request->getPost("identificadorParametro");
        $parametros_generale->Valorparametro = $this->request->getPost("valorParametro");
        $parametros_generale->Estadoregistro = $this->request->getPost("estadoRegistro");
        $parametros_generale->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $parametros_generale->Fechainsercion = $this->request->getPost("fechaInsercion");
        $parametros_generale->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $parametros_generale->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $parametros_generale->Indicadorfijo = $this->request->getPost("indicadorFijo");
        $parametros_generale->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$parametros_generale->save()) {

            foreach ($parametros_generale->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'edit',
                'params' => [$parametros_generale->codParametro]
            ]);

            return;
        }

        $this->flash->success("parametros_generale was updated successfully");

        $this->dispatcher->forward([
            'controller' => "parametros_generales",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a parametros_generale
     *
     * @param string $codParametro
     */
    public function deleteAction($codParametro)
    {
        $parametros_generale = ParametrosGenerales::findFirstBycodParametro($codParametro);
        if (!$parametros_generale) {
            $this->flash->error("parametros_generale was not found");

            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'index'
            ]);

            return;
        }

        if (!$parametros_generale->delete()) {

            foreach ($parametros_generale->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "parametros_generales",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("parametros_generale was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "parametros_generales",
            'action' => "index"
        ]);
    }

}
