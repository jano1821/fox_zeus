<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class EmpresaIndexForm extends Form {

    public function initialize() {
        
        $nombreEmpresa = new Text('nombreEmpresa',
                             array('placeholder' => ' Nombre de Empresa', 'class' => 'form-control'));
        $this->add($nombreEmpresa);
        
        $razonSocial = new Text('razonSocial',
                             array('placeholder' => 'Razón Social', 'class' => 'form-control'));
        $this->add($razonSocial);
        
        $limiteUsuarios = new Text('limiteUsuarios',
                             array('placeholder' => 'Límite de Usuarios', 'class' => 'form-control'));
        $this->add($limiteUsuarios);
        
        $identificadorEmpresa = new Text('identificadorEmpresa',
                             array('placeholder' => 'Identificador de Empresa', 'class' => 'form-control'));
        $this->add($identificadorEmpresa);

        $estadoRegistro = new Select('estadoRegistro',
                                 array(''=>'Seleccione Estado...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}