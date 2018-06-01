<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\PresenceOf;
class PersonaIndexForm extends Form {

    public function initialize() {

        $nombreEmpresa = new Text('nombreEmpresa',
                                  array('placeholder' => ' Nombre de Empresa', 'class' => 'form-control'));
        $nombreEmpresa->addValidator(new PresenceOf(array('message' => 'Se Requiere Nombre de Empresa')));
        $this->add($nombreEmpresa);
        $codEmpresa = new Hidden('codEmpresa');
        $this->add($codEmpresa);

        $nombrePersona = new Text('nombrePersona',
                                  array('placeholder' => 'Nombre de Persona', 'class' => 'form-control'));
        $this->add($nombrePersona);

        $apePat = new Text('apePat',
                           array('placeholder' => 'Apellido Paterno', 'class' => 'form-control'));
        $this->add($apePat);

        $apeMat = new Text('apeMat',
                           array('placeholder' => 'Apellido Materno', 'class' => 'form-control'));
        $this->add($apeMat);

        $sexo = new Select('sexo',
                           array('' => 'Seleccione Sexo...', 'M' => 'Masculino', 'F' => 'Femenino'));
        $this->add($sexo);

        $edad = new Text('edad',
                         array('placeholder' => 'Edad', 'class' => 'form-control'));
        $this->add($edad);

        $numeroDocumento = new Text('numeroDocumento',
                                    array('placeholder' => 'N° de Documento', 'class' => 'form-control'));
        $this->add($numeroDocumento);

        $razonSocial = new Text('razonSocial',
                                array('placeholder' => 'Razon Social', 'class' => 'form-control'));
        $this->add($razonSocial);

        $estadoRegistro = new Select('estadoRegistro',
                                     array('' => 'Seleccione Estado...', 'S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);

        $tipoPersona = new Select('tipoPersona',
                                  array('' => 'Seleccione Tipo de Persona...', 'N' => 'Natural', 'J' => 'Jurídica'));
        $this->add($tipoPersona);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}