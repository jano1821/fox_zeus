<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\PresenceOf; 

class PersonaNewForm extends Form {

    public function initialize() {
        
        $nombrePersona = new Text('nombrePersona',
                             array('placeholder' => 'Nombre de Persona', 'class' => 'form-control'));
        $nombrePersona->addValidator(new PresenceOf(array('message' => 'Se Requiere Nombre')));
        $this->add($nombrePersona);
        
        $apePat = new Text('apePat',
                             array('placeholder' => 'Apellido Paterno', 'class' => 'form-control'));
        $apePat->addValidator(new PresenceOf(array('message' => 'Se Requiere Apellido Paterno')));
        $this->add($apePat);
        
        $apeMat = new Text('apeMat',
                             array('placeholder' => 'Apellido Materno', 'class' => 'form-control'));
        $apeMat->addValidator(new PresenceOf(array('message' => 'Se Requiere Apellido Materno')));
        $this->add($apeMat);
        
        $sexo = new Select('sexo',
                                 array(''=>'Seleccione Sexo...','M' => 'Masculino', 'F' => 'Femenino'));
        $this->add($sexo);
        
        $edad = new Text('edad',
                             array('placeholder' => 'Edad', 'class' => 'form-control'));
        $this->add($edad);
        
        $numeroDocumento = new Text('numeroDocumento',
                             array('placeholder' => 'N° de Documento', 'class' => 'form-control'));
        $numeroDocumento->addValidator(new PresenceOf(array('message' => 'Se Requiere Numero de Documento')));
        $this->add($numeroDocumento);
        
        $razonSocial = new Text('razonSocial',
                             array('placeholder' => 'Razon Social', 'class' => 'form-control'));
        $this->add($razonSocial);
        
        $tipoPersona = new Select('tipoPersona',
                                 array(''=>'Seleccione Tipo de Persona...','N' => 'Natural', 'J' => 'Jurídica'));
        $this->add($tipoPersona);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar','class' => 'col-sm-6 btn btn-primary'));
        $this->add($submit);
    }
}