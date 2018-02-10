<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class TipoPersonaForm extends Form {

    public function initialize() {
        
        $empleado = new Select('empleado',
                                 array(''=>'Seleccione ...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($empleado);
        
        $cliente = new Select('cliente',
                                 array(''=>'Seleccione ...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($cliente);
        
        $proveedor = new Select('proveedor',
                                 array(''=>'Seleccione ...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($proveedor);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Grabar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}

