<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical;

class SistemaIndexForm extends Form {

    public function initialize() {
        
        $etiquetaSistema = new Text('etiquetaSistema',
                             array('placeholder' => 'Etiqueta de Sistema', 'class' => 'form-control'));
        $this->add($etiquetaSistema);
        
        $urlSistema = new Text('urlSistema',
                             array('placeholder' => 'URL de Sistema', 'class' => 'form-control'));
        $this->add($urlSistema);
        
        $urlIcono = new Text('urlIcono',
                             array('placeholder' => 'Icono', 'class' => 'form-control'));
        $this->add($urlIcono);

        $estadoRegistro = new Select('estadoRegistro',
                                 array(''=>'Seleccione Estado...','S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);
        
        $indicadorAdministrador = new Select('indicadorAdministrador',
                                 array(''=>'Seleccione Indicador...','S' => 'Administrador', 'N' => 'No Administrador'));
        $this->add($indicadorAdministrador);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}