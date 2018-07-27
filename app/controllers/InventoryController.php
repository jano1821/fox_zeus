<?php

class InventoryController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction($codSistema) {
        parent::validarSession();
        $codUsuario = '';
        $codEmpresa = '';
        $indicadorUsuarioAdministrador = '';
        $nombresPersona = '';
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
            $codUsuario = $usuario['codUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $menuInventarioPrincipal = parent::generarSubMenu($codSistema,
                                                          $codUsuario,
                                                          $codEmpresa,
                                                          'S');

        $menuInventarioSecundario = parent::generarSubMenu($codSistema,
                                                           $codUsuario,
                                                           $codEmpresa,
                                                           'N');
        if ($this->session->has("subMenuSistemas")) {
            $this->session->set('subMenuSistemas',
                                array('menuPrincipal' => $menuInventarioPrincipal, 'menuSecundario' => $menuInventarioSecundario));
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->nombreUsuario = $nombresPersona;
        $this->view->menuPrincipal = $menuInventarioPrincipal;
        $this->view->menuSecundario = $menuInventarioSecundario;
        $this->view->titulo = "Sistema de Inventario";
        $this->view->indicadorUsuarioAdministrador = $indicadorUsuarioAdministrador;
    }
}