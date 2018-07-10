<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\PresenceOf,                     
    Phalcon\Validation\Validator\Identical;
class CategoriaNewForm extends Form {

    public function initialize() {

        $descripcion = new Text('descripcion',
                                array('placeholder' => ' Descripcion', 'class' => 'form-control'));
        $descripcion->addValidator(new PresenceOf(array('message' => 'Se Requiere Descripcion')));
        $this->add($descripcion);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}