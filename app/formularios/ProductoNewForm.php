<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\PresenceOf;
class ProductoNewForm extends Form {

    public function initialize() {

        $descripcion = new Text('descripcion',
                                array('placeholder' => ' Descripcion', 'class' => 'form-control'));
        $descripcion->addValidator(new PresenceOf(array('message' => 'Se Requiere Descripcion')));
        $this->add($descripcion);
        $codProducto = new Hidden('codProducto');
        $this->add($codProducto);

        $descCorta = new Text('descCorta',
                                array('placeholder' => ' Descripcion Corta', 'class' => 'form-control'));
        $this->add($descCorta);
        
        $fechaVencimiento = new Text('fechaVencimiento',
                                array('placeholder' => ' Fecha de Vencimiento', 'class' => 'form-control'));
        $this->add($fechaVencimiento);
        
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

        $imagen = new Text('imagen',
                                array('placeholder' => ' Imagen', 'class' => 'form-control'));
        $this->add($imagen);
        
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array('value' => $this->security->getSessionToken(), 'message' => '¡La validación CSRF ha fallado!')));
        $this->add($csrf);

        $submit = new Submit('save',
                             array('value' => 'Grabar', 'class' => 'col-sm-5 btn btn-primary'));
        $this->add($submit);
    }
}