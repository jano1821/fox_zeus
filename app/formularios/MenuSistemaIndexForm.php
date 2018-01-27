<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class MenuSistemaIndexForm extends Form {

    public function initialize() {
        
        $nombreMenu = new Text('nombreMenu',
                             array('placeholder' => 'Menu', 'class' => 'form-control', 'disabled'=>'true'));
        $this->add($nombreMenu);
        $codMenu = new Hidden('codMenu');
        $this->add($codMenu);
        
        
        $nombreSistema = new Text('nombreSistema',
                             array('placeholder' => 'Sistema', 'class' => 'form-control', 'disabled'=>'true'));
        $this->add($nombreSistema);
        $codSistema = new Hidden('codSistema');
        $this->add($codSistema);
        
        $nombreUsuario = new Text('nombreUsuario',
                             array('placeholder' => 'Usuario', 'class' => 'form-control', 'disabled'=>'true'));
        $this->add($nombreUsuario);
        $codUsuario = new Hidden('codUsuario');
        $this->add($codUsuario);

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