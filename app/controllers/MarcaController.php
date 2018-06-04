<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MarcaController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for marca
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Marca', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "codMarca";

        $marca = Marca::find($parameters);
        if (count($marca) == 0) {
            $this->flash->notice("The search did not find any marca");

            $this->dispatcher->forward([
                "controller" => "marca",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $marca,
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
     * Edits a marca
     *
     * @param string $codMarca
     */
    public function editAction($codMarca)
    {
        if (!$this->request->isPost()) {

            $marca = Marca::findFirstBycodMarca($codMarca);
            if (!$marca) {
                $this->flash->error("marca was not found");

                $this->dispatcher->forward([
                    'controller' => "marca",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->codMarca = $marca->codMarca;

            $this->tag->setDefault("codMarca", $marca->codMarca);
            $this->tag->setDefault("descripcion", $marca->descripcion);
            $this->tag->setDefault("estadoRegistro", $marca->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion", $marca->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion", $marca->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion", $marca->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion", $marca->fechaModificacion);
            $this->tag->setDefault("indicadorExclusivo", $marca->indicadorExclusivo);
            $this->tag->setDefault("codEmpresa", $marca->codEmpresa);
            $this->tag->setDefault("codAgencia", $marca->codAgencia);
            
        }
    }

    /**
     * Creates a new marca
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'index'
            ]);

            return;
        }

        $marca = new Marca();
        $marca->Descripcion = $this->request->getPost("descripcion");
        $marca->Estadoregistro = $this->request->getPost("estadoRegistro");
        $marca->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $marca->Fechainsercion = $this->request->getPost("fechaInsercion");
        $marca->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $marca->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $marca->Indicadorexclusivo = $this->request->getPost("indicadorExclusivo");
        $marca->Codempresa = $this->request->getPost("codEmpresa");
        $marca->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$marca->save()) {
            foreach ($marca->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("marca was created successfully");

        $this->dispatcher->forward([
            'controller' => "marca",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a marca edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'index'
            ]);

            return;
        }

        $codMarca = $this->request->getPost("codMarca");
        $marca = Marca::findFirstBycodMarca($codMarca);

        if (!$marca) {
            $this->flash->error("marca does not exist " . $codMarca);

            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'index'
            ]);

            return;
        }

        $marca->Descripcion = $this->request->getPost("descripcion");
        $marca->Estadoregistro = $this->request->getPost("estadoRegistro");
        $marca->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $marca->Fechainsercion = $this->request->getPost("fechaInsercion");
        $marca->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $marca->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $marca->Indicadorexclusivo = $this->request->getPost("indicadorExclusivo");
        $marca->Codempresa = $this->request->getPost("codEmpresa");
        $marca->Codagencia = $this->request->getPost("codAgencia");
        

        if (!$marca->save()) {

            foreach ($marca->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'edit',
                'params' => [$marca->codMarca]
            ]);

            return;
        }

        $this->flash->success("marca was updated successfully");

        $this->dispatcher->forward([
            'controller' => "marca",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a marca
     *
     * @param string $codMarca
     */
    public function deleteAction($codMarca)
    {
        $marca = Marca::findFirstBycodMarca($codMarca);
        if (!$marca) {
            $this->flash->error("marca was not found");

            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'index'
            ]);

            return;
        }

        if (!$marca->delete()) {

            foreach ($marca->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "marca",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("marca was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "marca",
            'action' => "index"
        ]);
    }

}
