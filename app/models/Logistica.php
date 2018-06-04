<?php

class Logistica extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codLogistica;

    /**
     *
     * @var double
     * @Column(type="double", length=13, nullable=false)
     */
    protected $stock;

    /**
     *
     * @var double
     * @Column(type="double", length=13, nullable=false)
     */
    protected $minimo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codProducto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codUnidad;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codEmpresa;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codAlmacen;

    /**
     *
     * @var double
     * @Column(type="double", length=13, nullable=false)
     */
    protected $stoack;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codAgencia;

    /**
     * Method to set the value of field codLogistica
     *
     * @param integer $codLogistica
     * @return $this
     */
    public function setCodLogistica($codLogistica)
    {
        $this->codLogistica = $codLogistica;

        return $this;
    }

    /**
     * Method to set the value of field stock
     *
     * @param double $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Method to set the value of field minimo
     *
     * @param double $minimo
     * @return $this
     */
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }

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
     * Method to set the value of field codUnidad
     *
     * @param integer $codUnidad
     * @return $this
     */
    public function setCodUnidad($codUnidad)
    {
        $this->codUnidad = $codUnidad;

        return $this;
    }

    /**
     * Method to set the value of field codEmpresa
     *
     * @param integer $codEmpresa
     * @return $this
     */
    public function setCodEmpresa($codEmpresa)
    {
        $this->codEmpresa = $codEmpresa;

        return $this;
    }

    /**
     * Method to set the value of field codAlmacen
     *
     * @param integer $codAlmacen
     * @return $this
     */
    public function setCodAlmacen($codAlmacen)
    {
        $this->codAlmacen = $codAlmacen;

        return $this;
    }

    /**
     * Method to set the value of field stoack
     *
     * @param double $stoack
     * @return $this
     */
    public function setStoack($stoack)
    {
        $this->stoack = $stoack;

        return $this;
    }

    /**
     * Method to set the value of field codAgencia
     *
     * @param integer $codAgencia
     * @return $this
     */
    public function setCodAgencia($codAgencia)
    {
        $this->codAgencia = $codAgencia;

        return $this;
    }

    /**
     * Returns the value of field codLogistica
     *
     * @return integer
     */
    public function getCodLogistica()
    {
        return $this->codLogistica;
    }

    /**
     * Returns the value of field stock
     *
     * @return double
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Returns the value of field minimo
     *
     * @return double
     */
    public function getMinimo()
    {
        return $this->minimo;
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
     * Returns the value of field codUnidad
     *
     * @return integer
     */
    public function getCodUnidad()
    {
        return $this->codUnidad;
    }

    /**
     * Returns the value of field codEmpresa
     *
     * @return integer
     */
    public function getCodEmpresa()
    {
        return $this->codEmpresa;
    }

    /**
     * Returns the value of field codAlmacen
     *
     * @return integer
     */
    public function getCodAlmacen()
    {
        return $this->codAlmacen;
    }

    /**
     * Returns the value of field stoack
     *
     * @return double
     */
    public function getStoack()
    {
        return $this->stoack;
    }

    /**
     * Returns the value of field codAgencia
     *
     * @return integer
     */
    public function getCodAgencia()
    {
        return $this->codAgencia;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("logistica");
        $this->belongsTo('codProducto', '\Producto', 'codProducto', ['alias' => 'Producto']);
        $this->belongsTo('codUnidad', '\UnidadMedida', 'codUnidad', ['alias' => 'UnidadMedida']);
        $this->belongsTo('codAlmacen', '\Almacen', 'codAlmacen', ['alias' => 'Almacen']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'logistica';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logistica[]|Logistica|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logistica|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
