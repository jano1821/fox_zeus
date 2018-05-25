<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\Identical;

class EmpresaSistemaNewForm extends Form {

    public function initialize() {
        
        $codEmpresa = new Hidden('codEmpresa');
        $this->add($codEmpresa);
        
        $nombreSistema = new Text('nombreSistema',
                             array('placeholder' => 'Sistema', 'class' => 'form-control', 'disabled'=>'true'));
        $this->add($nombreSistema);
        $codSistema = new Hidden('codSistema');
        $this->add($codSistema);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Grabar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}
