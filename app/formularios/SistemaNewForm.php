<?php
use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\PresenceOf,                        
    Phalcon\Validation\Validator\Identical;

class SistemaNewForm extends Form {

    public function initialize() {
        
        $etiquetaSistema = new Text('etiquetaSistema',
                             array('placeholder' => 'Etiqueta de Sistema', 'class' => 'form-control'));
        $etiquetaSistema->addValidator(new PresenceOf(array('message' => 'Se Requiere Etiqueta')));
        $this->add($etiquetaSistema);
        
        $urlSistema = new Text('urlSistema',
                             array('placeholder' => 'URL de Sistema', 'class' => 'form-control'));
        $urlSistema->addValidator(new PresenceOf(array('message' => 'Se Requiere URL')));
        $this->add($urlSistema);
        
        $urlIcono = new Text('urlIcono',
                             array('placeholder' => 'Icono', 'class' => 'form-control'));
        $this->add($urlIcono);

        $indicadorAdministrador = new Select('indicadorAdministrador',
                                 array(''=>'Seleccione Indicador...','S' => 'Administrador', 'N' => 'No Administrador'));
        $indicadorAdministrador->addValidator(new PresenceOf(array('message' => 'Se Requiere Indicador de Administrador')));
        $this->add($indicadorAdministrador);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Guardar','class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}
