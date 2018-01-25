<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Password,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class UsuarioEditForm extends Form {

    public function initialize() {
        
        $nombreUsuario = new Text('nombreUsuario',
                             array('placeholder' => 'Usuario', 'class' => 'form-control'));
        $nombreUsuario->addValidator(new PresenceOf(array('message' => 'Se Requiere Usuario')));
        $this->add($nombreUsuario);
        
        $cantidadIntentos = new Text('cantidadIntentos',
                             array('placeholder' => 'Cantidad de Intentos', 'class' => 'form-control'));
        $cantidadIntentos->addValidator(new PresenceOf(array('message' => 'Se Requiere Cantidad de Intentos')));
        $this->add($cantidadIntentos);

        $password = new Password('passwordUsuario',
                                 array('placeholder' => 'Password', 'class' => 'form-control'));
        //añadimos la validación como campo requerido al password
        $password->addValidator(new PresenceOf(array('message' => 'El password es requerido')));
        //hacemos que se pueda llamar a nuestro campo password
        $this->add($password);

        $estadoRegistro = new Select('estadoRegistro',
                                 array('S' => 'Vigente', 'N' => 'No vigente'));
        $estadoRegistro->addValidator(new PresenceOf(array('message' => 'Se Requiere Estado')));
        $this->add($estadoRegistro);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}

