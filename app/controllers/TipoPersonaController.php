<?php
//use Phalcon\Mvc\Model\Criteria;
//use Phalcon\Paginator\Adapter\Model as Paginator;
use TipoPersonaForm as tipoPersonaForm;
//use AgenciaNewForm as agenciaNewForm;
//use AgenciaEditForm as agenciaEditForm;
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
            } else {
                $codEmpresa = "%";
                $codUsuario = "";
            }
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }
        
        $resEmpleado = "";
        $resProveedor = "";
        $resCliente = "";
        
        $empleado = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Empleado',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                            'em.codEmpresa like :codEmpresa: ' ,
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
                                    ->andWhere( 'em.codPersona like :codPersona: AND ' .
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
            if (count($empleado)>0){
                $resEmpleado = "S";
            }else{
                $resEmpleado = "N";
            }
        }

        $cliente = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Cliente',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                            'em.codEmpresa like :codEmpresa: ' ,
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
                                    ->andWhere( 'em.codPersona like :codPersona: AND ' .
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
            if (count($cliente)>0){
                $resCliente = "S";
            }else{
                $resCliente = "N";
            }
        }
        
        $proveedor = $this->modelsManager->createBuilder()
                                ->columns("em.codPersona ")
                                ->addFrom('Proveedor',
                                          'em')
                                ->andWhere('em.codPersona like :codPersona: AND ' .
                                            'em.codEmpresa like :codEmpresa: ' ,
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
                                    ->andWhere( 'em.codPersona like :codPersona: AND ' .
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
            if (count($proveedor)>0){
                $resProveedor = "S";
            }else{
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
            $codEmpresa = $usuario['codEmpresa'];
            $username = $usuario['nombreUsuario'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }
        if(!empty($this->request->getPost("empleado")) && !is_null($this->request->getPost("empleado"))){
            $empleado = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, ".
                                              "em.fechaInsercion, ".
                                              "em.usuarioInsercion ")
                                    ->addFrom('Empleado',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                'em.codEmpresa like :codEmpresa: ' ,
                                               [
                                                    'codPersona' => "%" . $this->request->getPost("codPersona") . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regEmpleado = new Empleado();
            $regEmpleado->codPersona = $this->request->getPost("codPersona");
            $regEmpleado->codEmpresa = $codEmpresa;
            $regEmpleado->estadoRegistro = $this->request->getPost("empleado");


            if (count($empleado) == 0){
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
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }else{
                $regEmpleado->fechaInsercion = $empleado->Fechainsercion;
                $regEmpleado->usuarioInsercion = $empleado->Usuarioinsercion;
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
        if(!empty($this->request->getPost("cliente")) && !is_null($this->request->getPost("cliente"))){
            $cliente = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, ".
                                              "em.fechaInsercion, ".
                                              "em.usuarioInsercion ")
                                    ->addFrom('Cliente',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                'em.codEmpresa like :codEmpresa: ' ,
                                               [
                                                    'codPersona' => "%" . $this->request->getPost("codPersona") . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regCliente = new Cliente();
            $regCliente->codPersona = $this->request->getPost("codPersona");
            $regCliente->codEmpresa = $codEmpresa;
            $regCliente->estadoRegistro = $this->request->getPost("cliente");


            if (count($cliente) == 0){
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
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }else{
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
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }
        }
        if(!empty($this->request->getPost("proveedor")) && !is_null($this->request->getPost("proveedor"))){
            $proveedor = $this->modelsManager->createBuilder()
                                    ->columns("em.codPersona, ".
                                              "em.fechaInsercion, ".
                                              "em.usuarioInsercion ")
                                    ->addFrom('Proveedor',
                                              'em')
                                    ->andWhere('em.codPersona like :codPersona: AND ' .
                                                'em.codEmpresa like :codEmpresa: ' ,
                                               [
                                                    'codPersona' => "%" . $this->request->getPost("codPersona") . "%",
                                                    'codEmpresa' => $codEmpresa,
                                                            ]
                                    )
                                    ->getQuery()
                                    ->execute();

            $regProveedor = new Proveedor();
            $regProveedor->codPersona = $this->request->getPost("codPersona");
            $regProveedor->codEmpresa = $codEmpresa;
            $regProveedor->estadoRegistro = $this->request->getPost("proveedor");


            if (count($proveedor) == 0){
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
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }else{
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
                                    'params' => [$this->request->getPost("codPersona")]
                    ]);

                    return;
                }
            }
        }
        $this->flash->success("Tipo de Persona Registrada Satisfactoriamente");

            $this->dispatcher->forward([
                            'controller' => "tipo_persona",
                            'action' => 'index',
                            'params' => [$this->request->getPost("codPersona")]
            ]);
    }
}