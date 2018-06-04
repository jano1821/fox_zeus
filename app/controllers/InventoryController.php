<?php

//use Phalcon\Paginator\Adapter\Model as Paginator;

class InventoryController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();
        
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
        } else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $this->view->nombreUsuario = $nombresPersona;
        $this->view->principal = "inventory/principal";
    }
    
    public function principalAction() {
        parent::validarSession();
        
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            //$nombresPersona = $usuario['nombresPersona'];
        } else {
            $this->session->destroy();
            $this->response->redirect('index');
        }
        
        $this->view->nombreUsuario = "Hola";
    }
}