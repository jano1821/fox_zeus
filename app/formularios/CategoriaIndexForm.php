<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;
class CategoriaIndexForm extends Form {

    public function initialize() {

        $descripcion = new Text('descripcion',
                                array('placeholder' => ' Descripcion', 'class' => 'form-control'));
        $this->add($descripcion);

        $estadoRegistro = new Select('estadoRegistro',
                                     array('' => 'Seleccione Estado...', 'S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}