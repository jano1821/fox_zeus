<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
class CategoriaController extends ControllerBase {

    public function indexAction() {
        parent::validarSession();
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->nombreUsuario = $nombresPersona;
        $this->view->form = new CategoriaIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $descripcionCategoria = $this->request->getPost("descripcion");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $codEmpresa = $usuario['codEmpresa'];
            $nombresPersona = $usuario['nombresPersona'];
        } else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $categoria = $this->modelsManager->createBuilder()
                ->columns("ag.codCategoria," .
                        "ag.descripcion," .
                        "if(ag.estadoRegistro='S','Vigente','No Vigente') as estado")
                ->addFrom('Categoria', 'ag')
                ->andWhere('ag.descripcion like :descripcion: AND ' .
                        'ag.codEmpresa = :codEmpresa: AND ' .
                        'ag.estadoRegistro like :estado: ', [
                    'descripcion' => "%" . $descripcionCategoria . "%",
                    'codEmpresa' => $codEmpresa,
                    'estado' => "%" . $estado . "%",
                        ]
                )
                ->orderBy('ag.descripcion')
                ->getQuery()
                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        } else if ($avance == 1) {
            if ($pagina < floor(count($categoria) / 10) + 1) {
                $pagina = $pagina + 1;
            } else {
                $this->flash->notice("No hay Registros Posteriores");
            }
        } else if ($avance == -1) {
            if ($pagina > 1) {
                $pagina = $pagina - 1;
            } else {
                $this->flash->notice("No hay Registros Anteriores");
            }
        } else if ($avance == 2) {
            $pagina = floor(count($categoria) / 10) + 1;
        }

        if (count($categoria) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                "controller" => "agencia",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $categoria,
            'limit' => 10,
            'page' => $pagina
        ]);

        $this->view->nombreUsuario = $nombresPersona;
        $this->tag->setDefault("pagina", $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        parent::validarSession();
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->nombreUsuario = $nombresPersona;
        $this->view->form = new CategoriaNewForm();
    }

    /**
     * Edits a categoria
     *
     * @param string $codCategoria
     */
    public function editAction($codCategoria) {
        if (!$this->request->isPost()) {

            $categoria = Categoria::findFirstBycodCategoria($codCategoria);
            if (!$categoria) {
                $this->flash->error("categoria was not found");

                $this->dispatcher->forward([
                                'controller' => "categoria",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codCategoria = $categoria->codCategoria;

            $this->tag->setDefault("codCategoria",
                                   $categoria->codCategoria);
            $this->tag->setDefault("descripcion",
                                   $categoria->descripcion);
            $this->tag->setDefault("estadoRegistro",
                                   $categoria->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion",
                                   $categoria->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion",
                                   $categoria->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion",
                                   $categoria->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion",
                                   $categoria->fechaModificacion);
            $this->tag->setDefault("indicadorExclusivo",
                                   $categoria->indicadorExclusivo);
            $this->tag->setDefault("codEmpresa",
                                   $categoria->codEmpresa);
            $this->tag->setDefault("codAgencia",
                                   $categoria->codAgencia);
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $categoria = new Categoria();
        $categoria->Descripcion = $this->request->getPost("descripcion");
        $categoria->Estadoregistro = "S";
        $categoria->Indicadorexclusivo = "S";
        $categoria->Usuarioinsercion = $username;
        $categoria->Fechainsercion = strftime("%Y-%m-%d",
                                              time());
        $categoria->Codempresa = $codEmpresa;

        if (!$categoria->save()) {
            $form = new CategoriaNewForm();
            if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                                'controller' => "categoria",
                                'action' => 'new'
                ]);
            }

            return;
        }

        $this->flash->success("Categoria Registrada Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "categoria",
                        'action' => 'index'
        ]);
    }

    /**
     * Saves a categoria edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'index'
            ]);

            return;
        }

        $codCategoria = $this->request->getPost("codCategoria");
        $categoria = Categoria::findFirstBycodCategoria($codCategoria);

        if (!$categoria) {
            $this->flash->error("categoria does not exist " . $codCategoria);

            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'index'
            ]);

            return;
        }

        $categoria->Descripcion = $this->request->getPost("descripcion");
        $categoria->Estadoregistro = $this->request->getPost("estadoRegistro");
        $categoria->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $categoria->Fechainsercion = $this->request->getPost("fechaInsercion");
        $categoria->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $categoria->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $categoria->Indicadorexclusivo = $this->request->getPost("indicadorExclusivo");
        $categoria->Codempresa = $this->request->getPost("codEmpresa");
        $categoria->Codagencia = $this->request->getPost("codAgencia");


        if (!$categoria->save()) {

            foreach ($categoria->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'edit',
                            'params' => [$categoria->codCategoria]
            ]);

            return;
        }

        $this->flash->success("categoria was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "categoria",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a categoria
     *
     * @param string $codCategoria
     */
    public function deleteAction($codCategoria) {
        $categoria = Categoria::findFirstBycodCategoria($codCategoria);
        if (!$categoria) {
            $this->flash->error("categoria was not found");

            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$categoria->delete()) {

            foreach ($categoria->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "categoria",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("categoria was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "categoria",
                        'action' => "index"
        ]);
    }
}