<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TipoDocumentoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for tipo_documento
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'TipoDocumento', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codTipoDocumento";

        $tipo_documento = TipoDocumento::find($parameters);
        if (count($tipo_documento) == 0) {
            $this->flash->notice("The search did not find any tipo_documento");

            $this->dispatcher->forward([
                "controller" => "tipo_documento",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $tipo_documento,
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
     * Edits a tipo_documento
     *
     * @param string $codTipoDocumento
     */
    public function editAction($codTipoDocumento)
    {
        if (!$this->request->isPost()) {

            $tipo_documento = TipoDocumento::findFirstBycodTipoDocumento($codTipoDocumento);
            if (!$tipo_documento) {
                $this->flash->error("tipo_documento was not found");

                $this->dispatcher->forward([
                    'controller' => "tipo_documento",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codTipoDocumento = $tipo_documento->codTipoDocumento;

            $this->tag->setDefault("codTipoDocumento", $tipo_documento->codTipoDocumento);
            $this->tag->setDefault("descripcion", $tipo_documento->descripcion);
            $this->tag->setDefault("estadoRegistro", $tipo_documento->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $tipo_documento->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $tipo_documento->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $tipo_documento->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $tipo_documento->fechaModificacion);
            
        }
    }

    /**
     * Creates a new tipo_documento
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $tipo_documento = new TipoDocumento();
        $tipo_documento->Descripcion = $this->request->getPost("descripcion");
        $tipo_documento->Estadoregistro = $this->request->getPost("estadoRegistro");
        $tipo_documento->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $tipo_documento->Fechainsercion = $this->request->getPost("fechaInsercion");
        $tipo_documento->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $tipo_documento->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$tipo_documento->save()) {
            foreach ($tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("tipo_documento was created successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_documento",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a tipo_documento edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $codTipoDocumento = $this->request->getPost("codTipoDocumento");
        $tipo_documento = TipoDocumento::findFirstBycodTipoDocumento($codTipoDocumento);

        if (!$tipo_documento) {
            $this->flash->error("tipo_documento does not exist " . $codTipoDocumento);

            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $tipo_documento->Descripcion = $this->request->getPost("descripcion");
        $tipo_documento->Estadoregistro = $this->request->getPost("estadoRegistro");
        $tipo_documento->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $tipo_documento->Fechainsercion = $this->request->getPost("fechaInsercion");
        $tipo_documento->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $tipo_documento->Fechamodificacion = $this->request->getPost("fechaModificacion");
        

        if (!$tipo_documento->save()) {

            foreach ($tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'edit',
                'params' => [$tipo_documento->codTipoDocumento]
            ]);

            return;
        }

        $this->flash->success("tipo_documento was updated successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_documento",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a tipo_documento
     *
     * @param string $codTipoDocumento
     */
    public function deleteAction($codTipoDocumento)
    {
        $tipo_documento = TipoDocumento::findFirstBycodTipoDocumento($codTipoDocumento);
        if (!$tipo_documento) {
            $this->flash->error("tipo_documento was not found");

            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        if (!$tipo_documento->delete()) {

            foreach ($tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "tipo_documento",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("tipo_documento was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "tipo_documento",
            'action' => "index"
        ]);
    }

}
