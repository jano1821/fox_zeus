<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class MenuUsuarioEditForm extends Form {

    public function initialize() {
        
        $nombreMenu = new Text('nombreMenu',
                             array('placeholder' => 'Menu', 'class' => 'form-control', 'disabled'=>'true'));
        $this->add($nombreMenu);
        $codMenu = new Hidden('codMenu');
        $this->add($codMenu);
        
        $codUsuario = new Hidden('codUsuario');
        $this->add($codUsuario);
        
        $estadoRegistro = new Select('estadoRegistro',
                                 array(''=>'Seleccione Estado...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Grabar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}