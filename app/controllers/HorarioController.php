<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
class HorarioController extends ControllerBase {

    public function onConstruct() {
        parent::validarSession();
        parent::validarAdministradores();
        $usuario = $this->session->get("Usuario");
        parent::validaAccesoSistema(parent::obtenerParametros("SISTEMA_ASISTENCIA"),
                                                              $usuario['codUsuario']);
    }

    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for horario
     */
    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di,
                                         'Horario',
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
        $parameters["order"] = "codHorario";

        $horario = Horario::find($parameters);
        if (count($horario) == 0) {
            $this->flash->notice("The search did not find any horario");

            $this->dispatcher->forward([
                            "controller" => "horario",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $horario,
                        'limit' => 10,
                        'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        
    }

    /**
     * Edits a horario
     *
     * @param string $codHorario
     */
    public function editAction($codHorario) {
        if (!$this->request->isPost()) {

            $horario = Horario::findFirstBycodHorario($codHorario);
            if (!$horario) {
                $this->flash->error("horario was not found");

                $this->dispatcher->forward([
                                'controller' => "horario",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codHorario = $horario->codHorario;

            $this->tag->setDefault("codHorario",
                                   $horario->codHorario);
            $this->tag->setDefault("horaIngreso",
                                   $horario->horaIngreso);
            $this->tag->setDefault("horaSalida",
                                   $horario->horaSalida);
            $this->tag->setDefault("horaDescanso",
                                   $horario->horaDescanso);
            $this->tag->setDefault("horaRetorno",
                                   $horario->horaRetorno);
            $this->tag->setDefault("estadoRegistro",
                                   $horario->estadoRegistro);
            $this->tag->setDefault("usuarioInsercion",
                                   $horario->usuarioInsercion);
            $this->tag->setDefault("fechaInsercion",
                                   $horario->fechaInsercion);
            $this->tag->setDefault("usuarioModificacion",
                                   $horario->usuarioModificacion);
            $this->tag->setDefault("fechaModificacion",
                                   $horario->fechaModificacion);
            $this->tag->setDefault("codPersona",
                                   $horario->codPersona);
            $this->tag->setDefault("horaIngresoSabatino",
                                   $horario->horaIngresoSabatino);
            $this->tag->setDefault("horaSalidaSabatino",
                                   $horario->horaSalidaSabatino);
        }
    }

    /**
     * Creates a new horario
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'index'
            ]);

            return;
        }

        $horario = new Horario();
        $horario->Horaingreso = $this->request->getPost("horaIngreso");
        $horario->Horasalida = $this->request->getPost("horaSalida");
        $horario->Horadescanso = $this->request->getPost("horaDescanso");
        $horario->Horaretorno = $this->request->getPost("horaRetorno");
        $horario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $horario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $horario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $horario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $horario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $horario->Codpersona = $this->request->getPost("codPersona");
        $horario->Horaingresosabatino = $this->request->getPost("horaIngresoSabatino");
        $horario->Horasalidasabatino = $this->request->getPost("horaSalidaSabatino");


        if (!$horario->save()) {
            foreach ($horario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("horario was created successfully");

        $this->dispatcher->forward([
                        'controller' => "horario",
                        'action' => 'index'
        ]);
    }

    /**
     * Saves a horario edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'index'
            ]);

            return;
        }

        $codHorario = $this->request->getPost("codHorario");
        $horario = Horario::findFirstBycodHorario($codHorario);

        if (!$horario) {
            $this->flash->error("horario does not exist " . $codHorario);

            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'index'
            ]);

            return;
        }

        $horario->Horaingreso = $this->request->getPost("horaIngreso");
        $horario->Horasalida = $this->request->getPost("horaSalida");
        $horario->Horadescanso = $this->request->getPost("horaDescanso");
        $horario->Horaretorno = $this->request->getPost("horaRetorno");
        $horario->Estadoregistro = $this->request->getPost("estadoRegistro");
        $horario->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $horario->Fechainsercion = $this->request->getPost("fechaInsercion");
        $horario->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $horario->Fechamodificacion = $this->request->getPost("fechaModificacion");
        $horario->Codpersona = $this->request->getPost("codPersona");
        $horario->Horaingresosabatino = $this->request->getPost("horaIngresoSabatino");
        $horario->Horasalidasabatino = $this->request->getPost("horaSalidaSabatino");


        if (!$horario->save()) {

            foreach ($horario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'edit',
                            'params' => [$horario->codHorario]
            ]);

            return;
        }

        $this->flash->success("horario was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "horario",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a horario
     *
     * @param string $codHorario
     */
    public function deleteAction($codHorario) {
        $horario = Horario::findFirstBycodHorario($codHorario);
        if (!$horario) {
            $this->flash->error("horario was not found");

            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$horario->delete()) {

            foreach ($horario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "horario",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("horario was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "horario",
                        'action' => "index"
        ]);
    }
}