<?php

class ProductoPrecio extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codProducto;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codPrecio;

    /**
     * Method to set the value of field codProducto
     *
     * @param integer $codProducto
     * @return $this
     */
    public function setCodProducto($codProducto)
    {
        $this->codProducto = $codProducto;

        return $this;
    }

    /**
     * Method to set the value of field codPrecio
     *
     * @param integer $codPrecio
     * @return $this
     */
    public function setCodPrecio($codPrecio)
    {
        $this->codPrecio = $codPrecio;

        return $this;
    }

    /**
     * Returns the value of field codProducto
     *
     * @return integer
     */
    public function getCodProducto()
    {
        return $this->codProducto;
    }

    /**
     * Returns the value of field codPrecio
     *
     * @return integer
     */
    public function getCodPrecio()
    {
        return $this->codPrecio;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("producto_precio");
        $this->belongsTo('codProducto', '\Producto', 'codProducto', ['alias' => 'Producto']);
        $this->belongsTo('codPrecio', '\Precio', 'codPrecio', ['alias' => 'Precio']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'producto_precio';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductoPrecio[]|ProductoPrecio|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductoPrecio|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
