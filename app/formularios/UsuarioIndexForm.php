<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;
class UsuarioIndexForm extends Form {

    public function initialize() {
        $nombreEmpresa = new Text('nombreEmpresa',
                                  array('placeholder' => 'Empresa', 'class' => 'form-control'));
        $nombreEmpresa->addValidator(new PresenceOf(array('message' => 'Se Requiere Empresa')));
        $this->add($nombreEmpresa);
        $codEmpresa = new Hidden('codEmpresa');
        $this->add($codEmpresa);

        $nombreUsuario = new Text('nombreUsuario',
                                  array('placeholder' => 'Nombre Usuario', 'class' => 'form-control'));
        $this->add($nombreUsuario);

        $cantidadIntentos = new Text('cantidadIntentos',
                                     array('placeholder' => 'Intentos', 'class' => 'form-control'));
        $this->add($cantidadIntentos);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}