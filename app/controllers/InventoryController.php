<?php

//use Phalcon\Paginator\Adapter\Model as Paginator;

class InventoryController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();
    }
}