<?php

use TipoPersonaForm as tipoPersonaForm;
class TipoPersonaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction($codPersona) {
        parent::validarSession();

        if ($this->session->has("Usuario")) {
            $usuarioSesion = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
            if ($indicadorUsuarioAdministrador != 'Z') {
                $codEmpresa = $usuarioSesion['codEmpresa'];
                $codUsuario = $usuarioSesion['codUsuario'];
            }else {
                $codEmpresa = "%";
                $codUsuario = "";
            }
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $personaController = new PersonaController();
        $persona = $personaController->findById($codPersona);

        $resEmpleado = "";
        $resProveedor = "";
        $resCliente = "";

        $empleado = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Empleado',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                                        'em.codEmpresa like :codEmpresa: ',
                                           [
                                                'codPersona' => "%" . $codPersona . "%",
                                                'codEmpresa' => $codEmpresa,
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
        if (count($empleado) > 0) {
            $empleado = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona ")
                                    ->addFrom('Empleado',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                            'em.codEmpresa like :codEmpresa: AND ' .
                                                            'em.estadoRegistro like :estado: ',
                                               [
                                                    'codPersona' => "%" . $codPersona . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                    'estado' => "S",
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();
            if (count($empleado) > 0) {
                $resEmpleado = "S";
            }else {
                $resEmpleado = "N";
            }
        }

        $cliente = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Cliente',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                                        'em.codEmpresa like :codEmpresa: ',
                                           [
                                                'codPersona' => "%" . $codPersona . "%",
                                                'codEmpresa' => $codEmpresa,
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
        if (count($cliente) > 0) {
            $cliente = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona ")
                                    ->addFrom('Cliente',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                            'em.codEmpresa like :codEmpresa: AND ' .
                                                            'em.estadoRegistro like :estado: ',
                                               [
                                                    'codPersona' => "%" . $codPersona . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                    'estado' => "S",
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();
            if (count($cliente) > 0) {
                $resCliente = "S";
            }else {
                $resCliente = "N";
            }
        }

        $proveedor = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Proveedor',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                                        'em.codEmpresa like :codEmpresa: ',
                                           [
                                                'codPersona' => "%" . $codPersona . "%",
                                                'codEmpresa' => $codEmpresa,
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
        if (count($proveedor) > 0) {
            $proveedor = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona ")
                                    ->addFrom('Proveedor',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                            'em.codEmpresa like :codEmpresa: AND ' .
                                                            'em.estadoRegistro like :estado: ',
                                               [
                                                    'codPersona' => "%" . $codPersona . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                    'estado' => "S",
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();
            if (count($proveedor) > 0) {
                $resProveedor = "S";
            }else {
                $resProveedor = "N";
            }
        }

        $this->tag->setDefault("empleado",
                               $resEmpleado);
        $this->tag->setDefault("proveedor",
                               $resProveedor);
        $this->tag->setDefault("cliente",
                               $resCliente);
        $this->tag->setDefault("codPersona",
                               $codPersona);
        $this->view->setVar("nombrePersona",
                            $persona->nombrePersona . " " . $persona->apePat . " " . $persona->apeMat);
        $this->view->form = new tipoPersonaForm();
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "tipo_persona",
                            'action' => 'index',
                            'params' => [$this->request->getPost("codPersona")]
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
            $username = $usuario['nombreUsuario'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $codPersona = $this->request->getPost("codPersona");
        
        if ($indicadorUsuarioAdministrador != "Z") {
            $codEmpresa = $usuario['codEmpresa'];
        }else{
            $persona = Persona::findBycodPersona($codPersona);
            foreach ($persona as $key) {
                $codEmpresa = $key->codEmpresa;
            }
        }

        if (!empty($this->request->getPost("empleado")) && !is_null($this->request->getPost("empleado"))) {
            $empleado = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, " .
                                                            "em.fechaInsercion, " .
                                                            "em.usuarioInsercion ")
                                    ->addFrom('Empleado',
                                              'em')
                                    ->andWhere('em.codPersona = :codPersona: AND ' .
                                                            'em.codEmpresa = :codEmpresa: ',
                                               [
                                                    'codPersona' => $codPersona,
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regEmpleado = new Empleado();
            $regEmpleado->codPersona = $codPersona;
            $regEmpleado->codEmpresa = $codEmpresa;
            $regEmpleado->estadoRegistro = $this->request->getPost("empleado");


            if (count($empleado) == 0) {
                $regEmpleado->usuarioInsercion = $username;
                $regEmpleado->fechaInsercion = strftime("%Y-%m-%d",
                                                        time());
                if (!$regEmpleado->save()) {
                    foreach ($regEmpleado->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$codPersona]
                    ]);

                    return;
                }
            }else {
                $regEmpleado->fechaInsercion = $empleado[0]->fechaInsercion;
                $regEmpleado->usuarioInsercion = $empleado[0]->usuarioInsercion;
                $regEmpleado->fechaModificacion = $username;
                $regEmpleado->usuarioModificacion = strftime("%Y-%m-%d",
                                                             time());
                if (!$regEmpleado->save()) {
                    foreach ($regEmpleado->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }
        }
        if (!empty($this->request->getPost("cliente")) && !is_null($this->request->getPost("cliente"))) {
            $cliente = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, " .
                                                            "em.fechaInsercion, " .
                                                            "em.usuarioInsercion ")
                                    ->addFrom('Cliente',
                                              'em')
                                    ->andWhere('em.codPersona = :codPersona: AND ' .
                                                            'em.codEmpresa = :codEmpresa: ',
                                               [
                                                    'codPersona' => $codPersona,
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regCliente = new Cliente();
            $regCliente->codPersona = $codPersona;
            $regCliente->codEmpresa = $codEmpresa;
            $regCliente->estadoRegistro = $this->request->getPost("cliente");


            if (count($cliente) == 0) {
                $regCliente->usuarioInsercion = $username;
                $regCliente->fechaInsercion = strftime("%Y-%m-%d",
                                                       time());
                if (!$regCliente->save()) {
                    foreach ($regCliente->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$codPersona]
                    ]);

                    return;
                }
            }else {
                $regCliente->fechaInsercion = $cliente[0]->fechaInsercion;
                $regCliente->usuarioInsercion = $cliente[0]->usuarioInsercion;
                $regCliente->fechaModificacion = $username;
                $regCliente->usuarioModificacion = strftime("%Y-%m-%d",
                                                            time());
                if (!$regCliente->update()) {

                    foreach ($regCliente->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$codPersona]
                    ]);

                    return;
                }
            }
        }
        if (!empty($this->request->getPost("proveedor")) && !is_null($this->request->getPost("proveedor"))) {
            $proveedor = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, " .
                                                            "em.fechaInsercion, " .
                                                            "em.usuarioInsercion ")
                                    ->addFrom('Proveedor',
                                              'em')
                                    ->andWhere('em.codPersona = :codPersona: AND ' .
                                                            'em.codEmpresa = :codEmpresa: ',
                                               [
                                                    'codPersona' => $codPersona,
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regProveedor = new Proveedor();
            $regProveedor->codPersona = $codPersona;
            $regProveedor->codEmpresa = $codEmpresa;
            $regProveedor->estadoRegistro = $this->request->getPost("proveedor");


            if (count($proveedor) == 0) {
                $regProveedor->usuarioInsercion = $username;
                $regProveedor->fechaInsercion = strftime("%Y-%m-%d",
                                                         time());
                if (!$regProveedor->save()) {
                    foreach ($regProveedor->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$codPersona]
                    ]);

                    return;
                }
            }else {
                $regProveedor->fechaInsercion = $proveedor[0]->fechaInsercion;
                $regProveedor->usuarioInsercion = $proveedor[0]->usuarioInsercion;
                $regProveedor->fechaModificacion = $username;
                $regProveedor->usuarioModificacion = strftime("%Y-%m-%d",
                                                              time());
                if (!$regProveedor->update()) {

                    foreach ($regProveedor->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                                    'controller' => "tipo_persona",
                                    'action' => 'index',
                                    'params' => [$codPersona]
                    ]);

                    return;
                }
            }
        }
        $this->flash->success("Tipo de Persona Registrada Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "tipo_persona",
                        'action' => 'index',
                        'params' => [$codPersona]
        ]);
    }
}