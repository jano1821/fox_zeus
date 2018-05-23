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
        
        $nombrePersona = new Text('nombrePersona',
                             array('placeholder' => 'Persona', 'class' => 'form-control'));
        $nombrePersona->addValidator(new PresenceOf(array('message' => 'Se Requiere Persona')));
        $this->add($nombrePersona);
        $codPersona = new Hidden('codPersona');
        $this->add($codPersona);
        
        $nombreEmpresa = new Text('nombreEmpresa',
                             array('placeholder' => 'Empresa', 'class' => 'form-control'));
        $nombreEmpresa->addValidator(new PresenceOf(array('message' => 'Se Requiere Empresa')));
        $this->add($nombreEmpresa);
        $codEmpresa = new Hidden('codEmpresa');
        $this->add($codEmpresa);
        
        $nombreAgencia = new Text('nombreAgencia',
                             array('placeholder' => 'Agencia', 'class' => 'form-control'));
        $nombreAgencia->addValidator(new PresenceOf(array('message' => 'Se Requiere Agencia')));
        $this->add($nombreAgencia);
        $codAgencia = new Hidden('codAgencia');
        $this->add($codAgencia);
        
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

