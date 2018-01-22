<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;
class LoginForm extends Form {

    public function initialize() {
        //añadimos el campo usuario
        $username = new Text('username',
                             array('placeholder' => 'ID de Usuario', 'class' => 'form-control'));
        //añadimos la validación como campo requerido
        $username->addValidator(new PresenceOf(array('message' => 'El Usuario es Requerido')));
        //hacemos que se pueda llamar a nuestro campo usuario
        $this->add($username);
        
        //añadimos el campo identificador de empresa
        $idenEmpresa = new Text('idenEmpresa',
                             array('placeholder' => 'ID Empresa', 'class' => 'form-control'));
        //añadimos la validación como campo requerido
        $idenEmpresa->addValidator(new PresenceOf(array('message' => 'El Identificador de Empresa es Requerido')));
        //hacemos que se pueda llamar a nuestro campo usuario
        $this->add($idenEmpresa);

        //añadimos el campo password
        $password = new Password('password',
                                 array('placeholder' => 'Password', 'class' => 'form-control'));
        //añadimos la validación como campo requerido al password
        $password->addValidator(new PresenceOf(array('message' => 'El password es requerido')));
        //hacemos que se pueda llamar a nuestro campo password
        $this->add($password);

        //prevención de ataques csrf, genera un campo de este tipo
        $csrf = new Hidden('csrf');
        //añadimos la validación para prevenir csrf
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        //hacemos que se pueda llamar a nuestro campo csrf
        $this->add($csrf);

        $submit = new Submit('Acceder',
                             array('class' => 'btn btn-primary'));
        //añadimos un botón de tipo submit
        $this->add($submit);
    }
}