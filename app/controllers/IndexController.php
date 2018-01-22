<?php

use LoginForm as FormLogin,
    Phalcon\Session as Session;
class IndexController extends ControllerBase {

    public function onConstruct() {
        
    }

    private function _registerSession($usuario) {
        /* $parametrosGenerales = parent::obtenerParametros('TIME_OUT_SESSION');

          $this->session->set('Usuario',
          array(  'codUsuario'    => $usuario->codUsuario,
          'nombreUsuario' => $usuario->nombreUsuario,
          'codEmpresa'    => $usuario->codEmpresa,
          'nombresPersona'=> $usuario->nombresPersona,
          'nombreEmpresa' => $usuario->nombreEmpresa,
          'tiempoSesion' => $parametrosGenerales,
          'ultimoAcceso' => date("Y-n-j H:i:s"),
          'indicadorUsuarioAdministrador' => $usuario->indicadorUsuarioAdministrador)); */
    }

    public function indexAction() {
        //$form = new FormLogin();
        
        $this->view->form = new FormLogin();
    }
}