<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PersonaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for persona
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Persona', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codPersona";

        $persona = Persona::find($parameters);
        if (count($persona) == 0) {
            $this->flash->notice("The search did not find any persona");

            $this->dispatcher->forward([
                "controller" => "persona",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $persona,
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
     * Edits a persona
     *
     * @param string $codPersona
     */
    public function editAction($codPersona)
    {
        if (!$this->request->isPost()) {

            $persona = Persona::findFirstBycodPersona($codPersona);
            if (!$persona) {
                $this->flash->error("persona was not found");

                $this->dispatcher->forward([
                    'controller' => "persona",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codPersona = $persona->codPersona;

            $this->tag->setDefault("codPersona", $persona->codPersona);
            $this->tag->setDefault("nombrePersona", $persona->nombrePersona);
            $this->tag->setDefault("apePat", $persona->apePat);
            $this->tag->setDefault("apeMat", $persona->apeMat);
            $this->tag->setDefault("sexo", $persona->sexo);
            $this->tag->setDefault("edad", $persona->edad);
            $this->tag->setDefault("numeroDocumento", $persona->numeroDocumento);
            $this->tag->setDefault("razonSocial", $persona->razonSocial);
            $this->tag->setDefault("estadoRegistro", $persona->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $persona->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $persona->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $persona->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $persona->fechaModificacion);
            $this->tag->setDefault("codTipoDocumento", $persona->codTipoDocumento);
            $this->tag->setDefault("tipoPersona", $persona->tipoPersona);
            $this->tag->setDefault("codEmpresa", $persona->codEmpresa);
            
        }
    }

    /**
     * Creates a new persona
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'index'
            ]);

            return;
        }

        $persona = new Persona();
        $persona->Nombrepersona = $this->request->getPost("nombrePersona");
        $persona->Apepat = $this->request->getPost("apePat");
        $persona->Apemat = $this->request->getPost("apeMat");
        $persona->Sexo = $this->request->getPost("sexo");
        $persona->Edad = $this->request->getPost("edad");
        $persona->Numerodocumento = $this->request->getPost("numeroDocumento");
        $persona->Razonsocial = $this->request->getPost("razonSocial");
        $persona->Estadoregistro = $this->request->getPost("estadoRegistro");
        $persona->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $persona->Fechainsercion = $this->request->getPost("fechaInsercion");
        $persona->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $persona->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $persona->Codtipodocumento = $this->request->getPost("codTipoDocumento");
        $persona->Tipopersona = $this->request->getPost("tipoPersona");
        $persona->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$persona->save()) {
            foreach ($persona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("persona was created successfully");

        $this->dispatcher->forward([
            'controller' => "persona",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a persona edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'index'
            ]);

            return;
        }

        $codPersona = $this->request->getPost("codPersona");
        $persona = Persona::findFirstBycodPersona($codPersona);

        if (!$persona) {
            $this->flash->error("persona does not exist " . $codPersona);

            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'index'
            ]);

            return;
        }

        $persona->Nombrepersona = $this->request->getPost("nombrePersona");
        $persona->Apepat = $this->request->getPost("apePat");
        $persona->Apemat = $this->request->getPost("apeMat");
        $persona->Sexo = $this->request->getPost("sexo");
        $persona->Edad = $this->request->getPost("edad");
        $persona->Numerodocumento = $this->request->getPost("numeroDocumento");
        $persona->Razonsocial = $this->request->getPost("razonSocial");
        $persona->Estadoregistro = $this->request->getPost("estadoRegistro");
        $persona->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $persona->Fechainsercion = $this->request->getPost("fechaInsercion");
        $persona->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $persona->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $persona->Codtipodocumento = $this->request->getPost("codTipoDocumento");
        $persona->Tipopersona = $this->request->getPost("tipoPersona");
        $persona->Codempresa = $this->request->getPost("codEmpresa");
        

        if (!$persona->save()) {

            foreach ($persona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'edit',
                'params' => [$persona->codPersona]
            ]);

            return;
        }

        $this->flash->success("persona was updated successfully");

        $this->dispatcher->forward([
            'controller' => "persona",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a persona
     *
     * @param string $codPersona
     */
    public function deleteAction($codPersona)
    {
        $persona = Persona::findFirstBycodPersona($codPersona);
        if (!$persona) {
            $this->flash->error("persona was not found");

            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'index'
            ]);

            return;
        }

        if (!$persona->delete()) {

            foreach ($persona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "persona",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("persona was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "persona",
            'action' => "index"
        ]);
    }

}
