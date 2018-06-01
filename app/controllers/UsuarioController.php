<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
class UsuarioController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $parameters['order'] = "nombreEmpresa ASC";
        $empresa = Empresa::find($parameters);

        $this->view->superAdmin = $indicadorUsuarioAdministrador;

        $this->view->empresa = $empresa;
        $this->view->form = new usuarioIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $codEmpresa = $this->request->getPost("codEmpresa");
        $nombreUsuario = $this->request->getPost("nombreUsuario");
        $cantidadIntentos = $this->request->getPost("cantidadIntentos");
        $indicadorAdministrador = $this->request->getPost("indicadorUsuarioAdministrador");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $usuario = $this->modelsManager->createBuilder()
                                ->columns("em.nombreEmpresa," .
                                                        "us.nombreUsuario," .
                                                        "us.codUsuario," .
                                                        "us.codEmpresa," .
                                                        "us.cantidadIntentos," .
                                                        "if(us.indicadorUsuarioAdministrador<>'S',if(us.indicadorUsuarioAdministrador='Z','Super Administrador', 'No Administrador'),'Administrador') as indicadorUsuarioAdministrador," .
                                                        "if(us.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Usuario',
                                          'us')
                                ->innerJoin('Empresa',
                                            'us.codEmpresa = em.codEmpresa',
                                            'em')
                                ->andWhere('us.codEmpresa like :codEmpresa: AND ' .
                                                        'us.nombreUsuario like :nombreUsuario: AND ' .
                                                        'us.cantidadIntentos like :cantidadIntentos: AND ' .
                                                        'us.indicadorUsuarioAdministrador like :indicadorUsuarioAdministrador: AND ' .
                                                        'us.estadoRegistro like :estado: ',
                                           [
                                                'codEmpresa' => "%" . $codEmpresa . "%",
                                                'nombreUsuario' => "%" . $nombreUsuario . "%",
                                                'cantidadIntentos' => "%" . $cantidadIntentos . "%",
                                                'indicadorUsuarioAdministrador' => "%" . $indicadorAdministrador . "%",
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('us.nombreUsuario')
                                ->getQuery()
                                ->execute();


        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($usuario) / 10) + 1) {
                $pagina = $pagina + 1;
            }else {
                $this->flash->notice("No hay Registros Posteriores");
            }
        }else if ($avance == -1) {
            if ($pagina > 1) {
                $pagina = $pagina - 1;
            }else {
                $this->flash->notice("No hay Registros Anteriores");
            }
        }else if ($avance == 2) {
            $pagina = floor(count($usuario) / 10) + 1;
        }

        if (count($usuario) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "usuario",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $usuario,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    //Nuevo Usuario
    public function newAction() {
        parent::validarSession();

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->superAdmin = $indicadorUsuarioAdministrador;
        $this->view->form = new usuarioNewForm();
    }

    public function editAction($codUsuario) {
        parent::validarSession();

        if (!$this->request->isPost()) {

            if ($this->session->has("Usuario")) {
                $usuario = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
            }else {
                $this->session->destroy();
                $this->response->redirect('index');
            }

            $parameters['order'] = "nombreEmpresa ASC";
            $empresa = Empresa::find($parameters);

            $usuario = Usuario::findFirstBycodUsuario($codUsuario);
            if (!$usuario) {
                $this->flash->error("Usuario no Encontrado");

                $this->dispatcher->forward([
                                'controller' => "usuario",
                                'action' => 'index'
                ]);

                return;
            }

            $this->view->codUsuario = $usuario->codUsuario;

            $this->tag->setDefault("codUsuario",
                                   $usuario->codUsuario);
            $this->tag->setDefault("codEmpresa",
                                   $usuario->codEmpresa);
            $this->tag->setDefault("nombreUsuario",
                                   $usuario->nombreUsuario);
            $this->tag->setDefault("passwordUsuario",
                                   $usuario->passwordUsuario);
            $this->tag->setDefault("cantidadIntentos",
                                   $usuario->cantidadIntentos);
            $this->tag->setDefault("indicadorUsuarioAdministrador",
                                   $usuario->indicadorUsuarioAdministrador);
            $this->tag->setDefault("estadoRegistro",
                                   $usuario->estadoRegistro);
            $this->tag->setDefault("fechaInsercion",
                                   $usuario->fechaInsercion);
            $this->tag->setDefault("usuarioInsercion",
                                   $usuario->usuarioInsercion);
            $this->tag->setDefault("fechaModificacion",
                                   $usuario->fechaModificacion);
            $this->tag->setDefault("usuarioModificacion",
                                   $usuario->usuarioModificacion);

            $this->view->superAdmin = $indicadorUsuarioAdministrador;
            $this->view->empresa = $empresa;
            $this->view->form = new usuarioEditForm();
        }
    }

    //Nuevo Usuario
    public function createAction() {
        parent::validarSession();

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'index'
            ]);

            return;
        }

        $form = new usuarioNewForm();
        if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'new'
            ]);

            return;
        }else {
            $usuarioSesion = $this->session->get("Usuario");
            $username = $usuarioSesion['nombreUsuario'];
            $codEmpresaSession = $usuarioSesion['codEmpresa'];

            $empleado = Empleado::findFirstBycodPersona($this->request->getPost("codPersona"));
            if (!$empleado) {
                $this->flash->error("Persona no Vinculada Como Empleado");
                $this->dispatcher->forward([
                                'controller' => "usuario",
                                'action' => 'new'
                ]);

                return;
            }

            $empresa = Empresa::findBycodEmpresa($codEmpresaSession);
            if (!$empresa) {
                $this->flash->error("Empresa del Registrante No Definida");
                $this->dispatcher->forward([
                                'controller' => "usuario",
                                'action' => 'new'
                ]);

                return;
            }else {
                if ($this->session->has("Usuario")) {
                    $usuario = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
                }else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                if ($indicadorUsuarioAdministrador == "Z") {
                    $usuarioConteo = Usuario::findBycodEmpresa($this->request->getPost("codEmpresa"));
                    $empresa = Empresa::findBycodEmpresa($this->request->getPost("codEmpresa"));
                }else {
                    $usuarioConteo = Usuario::findBycodEmpresa($codEmpresaSession);
                    $empresa = Empresa::findBycodEmpresa($codEmpresaSession);
                }

                foreach ($empresa as $item) {
                    if ($item->limiteUsuarios <= count($usuarioConteo)) {
                        $this->flash->error("Se excedió la cantidad de Usuarios Posibles a Registrar");
                        $this->dispatcher->forward([
                                        'controller' => "usuario",
                                        'action' => 'new'
                        ]);

                        return;
                    }
                }
            }

            $parametrosGenerales = parent::obtenerParametros('LLAVE_HASH');
            $password = password_hash($this->request->getPost("passwordUsuario"),
                                                              PASSWORD_BCRYPT,
                                                              array("cost" => 12, "salt" => $parametrosGenerales));

            $usuario = new Usuario();
            $usuario->Codusuario = $this->request->getPost("codUsuario");
            if ($indicadorUsuarioAdministrador == "Z") {
                $usuario->Codempresa = $this->request->getPost("codEmpresa");
            }else {
                $usuario->Codempresa = $codEmpresaSession;
            }
            $usuario->Codpersona = $this->request->getPost("codPersona");
            $usuario->Codagencia = $this->request->getPost("codAgencia");
            $usuario->Nombreusuario = $this->request->getPost("nombreUsuario");
            $usuario->Passwordusuario = $password;
            $usuario->Cantidadintentos = '0';
            $usuario->Indicadorusuarioadministrador = $this->request->getPost("indicadorUsuarioAdministrador");
            $usuario->Estadoregistro = 'S';
            $usuario->Fechainsercion = strftime("%Y-%m-%d",
                                                time());
            $usuario->Usuarioinsercion = $username;

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

            $this->flash->success("Usuario Registrado Correctamente");

            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'index'
            ]);
        }
    }

    /**
     * Saves a usuario edited
     *
     */
    public function saveAction() {
        parent::validarSession();

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
            $this->flash->error("El Usuario no Existe" . $codUsuario);

            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'index'
            ]);

            return;
        }

        $form = new usuarioEditForm();
        if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'Edit'
            ]);

            return;
        }else {
            if ($this->session->has("Usuario")) {
                $usuarioSesion = $this->session->get("Usuario");
                $username = $usuarioSesion['nombreUsuario'];
                $password = "";
                $parametrosGenerales = parent::obtenerParametros('LLAVE_HASH');
                if (!$this->request->getPost("passwordUsuario") == $usuario->Passwordusuario) {
                    $password = password_hash($this->request->getPost("passwordUsuario"),
                                                                      PASSWORD_BCRYPT,
                                                                      array("cost" => 12, "salt" => $parametrosGenerales));
                }else {
                    $password = $usuario->Passwordusuario;
                }

                $usuario->Codusuario = $this->request->getPost("codUsuario");
                $usuario->Codempresa = $this->request->getPost("codEmpresa");
                $usuario->Nombreusuario = $this->request->getPost("nombreUsuario");
                $usuario->Passwordusuario = $password;
                $usuario->Cantidadintentos = $this->request->getPost("cantidadIntentos");
                $usuario->Indicadorusuarioadministrador = $this->request->getPost("indicadorUsuarioAdministrador");
                $usuario->Estadoregistro = $this->request->getPost("estadoRegistro");
                $usuario->Fechamodificacion = strftime("%Y-%m-%d",
                                                       time());
                $usuario->Usuariomodificacion = $this->request->getPost($username);
            }else {
                $this->session->destroy();
                $this->response->redirect('index');
            }

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

            $this->flash->success("Usuario Actualizado Correctamente");

            $this->dispatcher->forward([
                            'controller' => "usuario",
                            'action' => 'index'
            ]);
        }
    }

    /**
     * Deletes a usuario
     *
     * @param string $codUsuario
     */
    public function deleteAction($codUsuario) {
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

    public function resetAction() {
        parent::validarSession();

        $form = new personaUsuarioIndexForm();
        $this->view->form = $form;

        $this->dispatcher->forward([
                        'controller' => "usuario",
                        'action' => 'index'
        ]);

        return;
    }

    public function findById($codUsuario) {
        $usuario = $this->modelsManager->createBuilder()
                                ->columns("em.nombreEmpresa," .
                                                        "us.nombreUsuario," .
                                                        "us.codUsuario," .
                                                        "us.codEmpresa," .
                                                        "us.cantidadIntentos," .
                                                        "if(us.indicadorUsuarioAdministrador<>'S',if(us.indicadorUsuarioAdministrador='Z','Super Administrador', 'No Administrador'),'Administrador') as indicadorUsuarioAdministrador," .
                                                        "if(us.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Usuario',
                                          'us')
                                ->innerJoin('Empresa',
                                            'us.codEmpresa = em.codEmpresa',
                                            'em')
                                ->andWhere('us.codUsuario = :codUsuario: AND ' .
                                                        'us.estadoRegistro = :estado: ',
                                           [
                                                'codUsuario' => $codUsuario,
                                                'estado' => "S",
                                                        ]
                                )
                                ->getQuery()
                                ->execute();

        if (count($usuario) <= 0) {
            $usuario = array(array("", "", "", "", "", "", ""));
        }
        return $usuario[0];
    }
}