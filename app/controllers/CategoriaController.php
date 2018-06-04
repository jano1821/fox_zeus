<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class CategoriaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for categoria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Categoria', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codCategoria";

        $categoria = Categoria::find($parameters);
        if (count($categoria) == 0) {
            $this->flash->notice("The search did not find any categoria");

            $this->dispatcher->forward([
                "controller" => "categoria",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $categoria,
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
     * Edits a categoria
     *
     * @param string $codCategoria
     */
    public function editAction($codCategoria)
    {
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

            $this->tag->setDefault("codCategoria", $categoria->codCategoria);
            $this->tag->setDefault("descripcion", $categoria->descripcion);
            $this->tag->setDefault("estadoRegistro", $categoria->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $categoria->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $categoria->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $categoria->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $categoria->fechaModificacion);
            $this->tag->setDefault("indicadorExclusivo", $categoria->indicadorExclusivo);
            $this->tag->setDefault("codEmpresa", $categoria->codEmpresa);
            $this->tag->setDefault("codAgencia", $categoria->codAgencia);
            
        }
    }

    /**
     * Creates a new categoria
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "categoria",
                'action' => 'index'
            ]);

            return;
        }

        $categoria = new Categoria();
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
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("categoria was created successfully");

        $this->dispatcher->forward([
            'controller' => "categoria",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a categoria edited
     *
     */
    public function saveAction()
    {

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
    public function deleteAction($codCategoria)
    {
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
