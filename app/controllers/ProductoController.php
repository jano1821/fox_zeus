<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
class ProductoController extends ControllerBase {

    public function onConstruct() {
        parent::validarSession();
        parent::validarAdministradores();
        $usuario = $this->session->get("Usuario");
        parent::validaAccesoSistema(parent::obtenerParametros("SISTEMA_INVENTARIO"),
                                                              $usuario['codUsuario']);
    }

    public function indexAction($codSistema) {
        $codUsuario = '';
        $codEmpresa = '';
        $nombresPersona = '';
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
            $codUsuario = $usuario['codUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->nombreUsuario = $nombresPersona;
        $this->view->titulo = "Sistema de Inventario";
        $this->view->menuPrincipal = parent::obtenerSubmenuSession('P');
        $this->view->menuSecundario = parent::obtenerSubmenuSession('S');
        $this->view->form = new ProductoIndexForm();
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di,
                                         'Producto',
                                         $_POST);
            $this->persistent->parameters = $query->getParams();
        }else {
            $numberPage = $this->request->getQuery("page",
                                                   "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codProducto";

        $producto = Producto::find($parameters);
        if (count($producto) == 0) {
            $this->flash->notice("Producto No Encontrado");

            $this->dispatcher->forward([
                            "controller" => "producto",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $producto,
                        'limit' => 10,
                        'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    //Nuevo Producto
    public function newAction() {
        parent::validarSession();

        $this->view->form = new ProductoNewForm();
    }

    /**
     * Edits a producto
     *
     * @param string $codProducto
     */
    public function editAction($codProducto) {
        if (!$this->request->isPost()) {

            $producto = Producto::findFirstBycodProducto($codProducto);
            if (!$producto) {
                $this->flash->error("producto was not found");

                $this->dispatcher->forward([
                                'controller' => "producto",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codProducto = $producto->codProducto;

            $this->tag->setDefault("codProducto",
                                   $producto->codProducto);
            $this->tag->setDefault("descripcion",
                                   $producto->descripcion);
            $this->tag->setDefault("imagen",
                                   $producto->imagen);
            $this->tag->setDefault("fechaBaja",
                                   $producto->fechaBaja);
            $this->tag->setDefault("motivoBaja",
                                   $producto->motivoBaja);
            $this->tag->setDefault("estadoRegistro",
                                   $producto->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion",
                                   $producto->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion",
                                   $producto->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion",
                                   $producto->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion",
                                   $producto->fechaModificacion);
            $this->tag->setDefault("codCategoria",
                                   $producto->codCategoria);
            $this->tag->setDefault("codMarca",
                                   $producto->codMarca);
            $this->tag->setDefault("codModelo",
                                   $producto->codModelo);
            $this->tag->setDefault("codEmpresa",
                                   $producto->codEmpresa);
            $this->tag->setDefault("descripcionCorta",
                                   $producto->descripcionCorta);
            $this->tag->setDefault("fechaVencimiento",
                                   $producto->fechaVencimiento);
            $this->tag->setDefault("fechaAlta",
                                   $producto->fechaAlta);
            $this->tag->setDefault("codAgencia",
                                   $producto->codAgencia);
        }
    }

    /**
     * Creates a new producto
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'index'
            ]);

            return;
        }

        $producto = new Producto();
        $producto->Descripcion = $this->request->getPost("descripcion");
        $producto->Imagen = $this->request->getPost("imagen");
        $producto->Fechabaja = $this->request->getPost("fechaBaja");
        $producto->Motivobaja = $this->request->getPost("motivoBaja");
        $producto->Estadoregistro = $this->request->getPost("estadoRegistro");
        $producto->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $producto->Fechainsercion = $this->request->getPost("fechaInsercion");
        $producto->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $producto->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $producto->Codcategoria = $this->request->getPost("codCategoria");
        $producto->Codmarca = $this->request->getPost("codMarca");
        $producto->Codmodelo = $this->request->getPost("codModelo");
        $producto->Codempresa = $this->request->getPost("codEmpresa");
        $producto->Descripcioncorta = $this->request->getPost("descripcionCorta");
        $producto->Fechavencimiento = $this->request->getPost("fechaVencimiento");
        $producto->Fechaalta = $this->request->getPost("fechaAlta");
        $producto->Codagencia = $this->request->getPost("codAgencia");


        if (!$producto->save()) {
            foreach ($producto->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("producto was created successfully");

        $this->dispatcher->forward([
                        'controller' => "producto",
                        'action' => 'index'
        ]);
    }

    /**
     * Saves a producto edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'index'
            ]);

            return;
        }

        $codProducto = $this->request->getPost("codProducto");
        $producto = Producto::findFirstBycodProducto($codProducto);

        if (!$producto) {
            $this->flash->error("producto does not exist " . $codProducto);

            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'index'
            ]);

            return;
        }

        $producto->Descripcion = $this->request->getPost("descripcion");
        $producto->Imagen = $this->request->getPost("imagen");
        $producto->Fechabaja = $this->request->getPost("fechaBaja");
        $producto->Motivobaja = $this->request->getPost("motivoBaja");
        $producto->Estadoregistro = $this->request->getPost("estadoRegistro");
        $producto->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $producto->Fechainsercion = $this->request->getPost("fechaInsercion");
        $producto->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $producto->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $producto->Codcategoria = $this->request->getPost("codCategoria");
        $producto->Codmarca = $this->request->getPost("codMarca");
        $producto->Codmodelo = $this->request->getPost("codModelo");
        $producto->Codempresa = $this->request->getPost("codEmpresa");
        $producto->Descripcioncorta = $this->request->getPost("descripcionCorta");
        $producto->Fechavencimiento = $this->request->getPost("fechaVencimiento");
        $producto->Fechaalta = $this->request->getPost("fechaAlta");
        $producto->Codagencia = $this->request->getPost("codAgencia");


        if (!$producto->save()) {

            foreach ($producto->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'edit',
                            'params' => [$producto->codProducto]
            ]);

            return;
        }

        $this->flash->success("producto was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "producto",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a producto
     *
     * @param string $codProducto
     */
    public function deleteAction($codProducto) {
        $producto = Producto::findFirstBycodProducto($codProducto);
        if (!$producto) {
            $this->flash->error("producto was not found");

            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$producto->delete()) {

            foreach ($producto->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "producto",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("producto was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "producto",
                        'action' => "index"
        ]);
    }
}