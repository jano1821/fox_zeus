<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\PresenceOf;
class ProductoIndexForm extends Form {

    public function initialize() {

        $descripcion = new Text('descripcion',
                                array('placeholder' => ' Descripcion', 'class' => 'form-control'));
        $descripcion->addValidator(new PresenceOf(array('message' => 'Se Requiere Descripcion')));
        $this->add($descripcion);
        $codProducto = new Hidden('codProducto');
        $this->add($codProducto);

        $categoria = new Text('categoria',
                              array('placeholder' => 'Categoria', 'class' => 'form-control', 'readonly' => 'true'));
        $categoria->addValidator(new PresenceOf(array('message' => 'Se Requiere Categoria')));
        $this->add($categoria);
        $codCategoria = new Hidden('codCategoria');
        $this->add($codCategoria);

        $modelo = new Text('modelo',
                           array('placeholder' => 'Modelo', 'class' => 'form-control', 'readonly' => 'true'));
        $modelo->addValidator(new PresenceOf(array('message' => 'Se Requiere Modelo')));
        $this->add($modelo);
        $codModelo = new Hidden('codModelo');
        $this->add($codModelo);

        $marca = new Text('marca',
                          array('placeholder' => 'Marca', 'class' => 'form-control', 'readonly' => 'true'));
        $marca->addValidator(new PresenceOf(array('message' => 'Se Requiere Marca')));
        $this->add($marca);
        $codMarca = new Hidden('codMarca');
        $this->add($codMarca);

        $estadoRegistro = new Select('estadoRegistro',
                                     array('' => 'Seleccione Estado...', 'S' => 'Vigente', 'N' => 'No vigente'));
        $this->add($estadoRegistro);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('buscar',
                             array('value' => 'Buscar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}