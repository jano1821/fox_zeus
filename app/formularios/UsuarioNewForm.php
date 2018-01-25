<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Password,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;

class UsuarioNewForm extends Form {

    public function initialize() {
        
        $nombreUsuario = new Text('nombreUsuario',
                             array('placeholder' => 'Usuario', 'class' => 'form-control'));
        $nombreUsuario->addValidator(new PresenceOf(array('message' => 'Se Requiere Usuario')));
        $this->add($nombreUsuario);
        
        $password = new Password('passwordUsuario',
                                 array('placeholder' => 'Password', 'class' => 'form-control'));
        $password->addValidator(new PresenceOf(array('message' => 'El password es requerido')));
        $this->add($password);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}

