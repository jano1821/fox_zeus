<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UsuarioController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for usuario
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Usuario', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codUsuario";

        $usuario = Usuario::find($parameters);
        if (count($usuario) == 0) {
            $this->flash->notice("The search did not find any usuario");

            $this->dispatcher->forward([
                "controller" => "usuario",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $usuario,
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
     * Edits a usuario
     *
     * @param string $codUsuario
     */
    public function editAction($codUsuario)
    {
        if (!$this->request->isPost()) {

            $usuario = Usuario::findFirstBycodUsuario($codUsuario);
            if (!$usuario) {
                $this->flash->error("usuario was not found");

                $this->dispatcher->forward([
                    'controller' => "usuario",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codUsuario = $usuario->codUsuario;

            $this->tag->setDefault("codUsuario", $usuario->codUsuario);
            $this->tag->setDefault("nombreUsuario", $usuario->nombreUsuario);
            $this->tag->setDefault("passwordUsuario", $usuario->passwordUsuario);
            $this->tag->setDefault("cantidadIntentos", $usuario->cantidadIntentos);
            $this->tag->setDefault("indicadorUsuarioAdministrador", $usuario->indicadorUsuarioAdministrador);
            $this->tag->setDefault("estadoRegistro", $usuario->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $usuario->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $usuario->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $usuario->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $usuario->fechaModificacion);
            $this->tag->setDefault("codPersona", $usuario->codPersona);
            $this->tag->setDefault("codEmpresa", $usuario->codEmpresa);
            $this->tag->setDefault("codAgencia", $usuario->codAgencia);
            
        }
    }

    /**
     * Creates a new usuario
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        $usuario = new Usuario();
        $usuario->Nombreusuario = $this->request->getPost("nombreUsuario");
        $usuario->Passwordusuario = $this->request->getPost("passwordUsuario");
        $usuario->Cantidadintentos = $this->request->getPost("cantidadIntentos");
        $usuario->Indicadorusuarioadministrador = $this->request->getPost("indicadorUsuarioAdministrador");
        $usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $usuario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $usuario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $usuario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $usuario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $usuario->Codpersona = $this->request->getPost("codPersona");
        $usuario->Codempresa = $this->request->getPost("codEmpresa");
        $usuario->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$usuario->save()) {
            foreach ($usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("usuario was created successfully");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a usuario edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        $codUsuario = $this->request->getPost("codUsuario");
        $usuario = Usuario::findFirstBycodUsuario($codUsuario);

        if (!$usuario) {
            $this->flash->error("usuario does not exist " . $codUsuario);

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        $usuario->Nombreusuario = $this->request->getPost("nombreUsuario");
        $usuario->Passwordusuario = $this->request->getPost("passwordUsuario");
        $usuario->Cantidadintentos = $this->request->getPost("cantidadIntentos");
        $usuario->Indicadorusuarioadministrador = $this->request->getPost("indicadorUsuarioAdministrador");
        $usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $usuario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $usuario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $usuario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $usuario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $usuario->Codpersona = $this->request->getPost("codPersona");
        $usuario->Codempresa = $this->request->getPost("codEmpresa");
        $usuario->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$usuario->save()) {

            foreach ($usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'edit',
                'params' => [$usuario->codUsuario]
            ]);

            return;
        }

        $this->flash->success("usuario was updated successfully");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a usuario
     *
     * @param string $codUsuario
     */
    public function deleteAction($codUsuario)
    {
        $usuario = Usuario::findFirstBycodUsuario($codUsuario);
        if (!$usuario) {
            $this->flash->error("usuario was not found");

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        if (!$usuario->delete()) {

            foreach ($usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("usuario was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => "index"
        ]);
    }

}
