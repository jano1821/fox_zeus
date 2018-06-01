<?php

use LoginForm as FormLogin,
    Phalcon\Session as Session;
class IndexController extends ControllerBase {

    public function onConstruct() {
        
    }

    private function _registerSession($usuario) {
        $parametrosGenerales = parent::obtenerParametros('TIME_OUT_SESSION');

        $this->session->set('Usuario',
                            array('codUsuario' => $usuario->codUsuario,
                        'nombreUsuario' => $usuario->nombreUsuario,
                        'codEmpresa' => $usuario->codEmpresa,
                        'codPersona' => $usuario->codPersona,
                        'nombresPersona' => $usuario->nombresPersona,
                        'nombreEmpresa' => $usuario->nombreEmpresa,
                        'tiempoSesion' => $parametrosGenerales,
                        'ultimoAcceso' => date("Y-n-j H:i:s"),
                        'indicadorUsuarioAdministrador' => $usuario->indicadorUsuarioAdministrador));
    }

    public function indexAction() {
        $form = new FormLogin();

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) == false) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $idenEmpresa = $this->request->getPost('idenEmpresa');

                $usuario = $this->modelsManager->createBuilder()
                                        ->columns("us.codUsuario," .
                                                                "us.codEmpresa," .
                                                                "pe.nombrePersona," .
                                                                "em.nombreEmpresa," .
                                                                "us.nombreUsuario," .
                                                                "us.passwordUsuario," .
                                                                "us.cantidadIntentos," .
                                                                "us.indicadorUsuarioAdministrador ")
                                        ->addFrom('Usuario',
                                                  'us')
                                        ->innerJoin('Empresa',
                                                    'em.codEmpresa = us.codEmpresa',
                                                    'em')
                                        ->innerJoin('Empleado',
                                                    'pu.codPersona = us.codPersona',
                                                    'pu')
                                        ->innerJoin('Persona',
                                                    'pu.codPersona = pe.codPersona',
                                                    'pe')
                                        ->andWhere('us.nombreUsuario = :nombreUsuario: AND ' .
                                                                'em.identificadorEmpresa = :identificadorEmpresa: AND ' .
                                                                'us.estadoRegistro = :estadoRegistro: ',
                                                   [
                                                        'nombreUsuario' => $username,
                                                        'identificadorEmpresa' => $idenEmpresa,
                                                        'estadoRegistro' => "S",
                                                                ]
                                        )
                                        ->getQuery()
                                        ->execute();

                if (count($usuario) == 1) {
                    if ($this->security->checkHash($password,
                                                   $usuario[0]->passwordUsuario)) {
                        $this->_registerSession($usuario[0]);

                        return $this->response->redirect('menu');
                    }else {
                        $this->flash->error("Usuario o Password Incorrecto");
                    }
                }else {
                    $this->flash->error("Usuario o Password Incorrecto");
                }
            }
        }

        $this->view->form = new FormLogin();
    }

    public function logoutAction() {
        $this->session->destroy();
        $this->response->redirect('index');
    }
}