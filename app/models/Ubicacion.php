<?php

class Ubicacion extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codUbicacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codSecion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codZona;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codSector;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codAlmacen;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codEmpresa;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codProducto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codAgencia;

    /**
     * Method to set the value of field codUbicacion
     *
     * @param integer $codUbicacion
     * @return $this
     */
    public function setCodUbicacion($codUbicacion)
    {
        $this->codUbicacion = $codUbicacion;

        return $this;
    }

    /**
     * Method to set the value of field codSecion
     *
     * @param integer $codSecion
     * @return $this
     */
    public function setCodSecion($codSecion)
    {
        $this->codSecion = $codSecion;

        return $this;
    }

    /**
     * Method to set the value of field codZona
     *
     * @param integer $codZona
     * @return $this
     */
    public function setCodZona($codZona)
    {
        $this->codZona = $codZona;

        return $this;
    }

    /**
     * Method to set the value of field codSector
     *
     * @param integer $codSector
     * @return $this
     */
    public function setCodSector($codSector)
    {
        $this->codSector = $codSector;

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
     * Returns the value of field codUbicacion
     *
     * @return integer
     */
    public function getCodUbicacion()
    {
        return $this->codUbicacion;
    }

    /**
     * Returns the value of field codSecion
     *
     * @return integer
     */
    public function getCodSecion()
    {
        return $this->codSecion;
    }

    /**
     * Returns the value of field codZona
     *
     * @return integer
     */
    public function getCodZona()
    {
        return $this->codZona;
    }

    /**
     * Returns the value of field codSector
     *
     * @return integer
     */
    public function getCodSector()
    {
        return $this->codSector;
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
     * Returns the value of field codEmpresa
     *
     * @return integer
     */
    public function getCodEmpresa()
    {
        return $this->codEmpresa;
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
        $this->setSource("ubicacion");
        $this->hasMany('codUbicacion', 'HistoricoMovimientos', 'codUbicacion', ['alias' => 'HistoricoMovimientos']);
        $this->belongsTo('codSecion', '\Seccion', 'codSecion', ['alias' => 'Seccion']);
        $this->belongsTo('codZona', '\Zona', 'codZona', ['alias' => 'Zona']);
        $this->belongsTo('codSector', '\Sector', 'codSector', ['alias' => 'Sector']);
        $this->belongsTo('codAlmacen', '\Almacen', 'codAlmacen', ['alias' => 'Almacen']);
        $this->belongsTo('codProducto', '\Producto', 'codProducto', ['alias' => 'Producto']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ubicacion[]|Ubicacion|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ubicacion|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ubicacion';
    }

}
