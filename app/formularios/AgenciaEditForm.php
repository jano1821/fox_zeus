<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\PresenceOf,  
    Phalcon\Validation\Validator\Identical;

class AgenciaEditForm extends Form {

    public function initialize() {
        
        $nombreAgencia = new Text('descripcion',
                             array('placeholder' => ' Nombre de Agencia', 'class' => 'form-control'));
        $nombreAgencia->addValidator(new PresenceOf(array('message' => 'Se Requiere Nombre de Empresa')));
        $this->add($nombreAgencia);
        
        $estadoRegistro = new Select('estadoRegistro',
                                 array(''=>'Seleccione Estado...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}