<?php

class Producto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codProducto;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $descripcion;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    public $imagen;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fechaBaja;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    public $motivoBaja;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $estadoRegistro;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    public $usuarioInsercion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fechaInsercion;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    public $usuarioModificacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fechaModificacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codCategoria;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codMarca;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codModelo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codEmpresa;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $descripcionCorta;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fechaVencimiento;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fechaAlta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codAgencia;

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
     * Method to set the value of field descripcion
     *
     * @param string $descripcion
     * @return $this
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Method to set the value of field imagen
     *
     * @param string $imagen
     * @return $this
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Method to set the value of field fechaBaja
     *
     * @param string $fechaBaja
     * @return $this
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Method to set the value of field motivoBaja
     *
     * @param string $motivoBaja
     * @return $this
     */
    public function setMotivoBaja($motivoBaja)
    {
        $this->motivoBaja = $motivoBaja;

        return $this;
    }

    /**
     * Method to set the value of field estadoRegistro
     *
     * @param string $estadoRegistro
     * @return $this
     */
    public function setEstadoRegistro($estadoRegistro)
    {
        $this->estadoRegistro = $estadoRegistro;

        return $this;
    }

    /**
     * Method to set the value of field usuarioInsercion
     *
     * @param string $usuarioInsercion
     * @return $this
     */
    public function setUsuarioInsercion($usuarioInsercion)
    {
        $this->usuarioInsercion = $usuarioInsercion;

        return $this;
    }

    /**
     * Method to set the value of field fechaInsercion
     *
     * @param string $fechaInsercion
     * @return $this
     */
    public function setFechaInsercion($fechaInsercion)
    {
        $this->fechaInsercion = $fechaInsercion;

        return $this;
    }

    /**
     * Method to set the value of field usuarioModificacion
     *
     * @param string $usuarioModificacion
     * @return $this
     */
    public function setUsuarioModificacion($usuarioModificacion)
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    /**
     * Method to set the value of field fechaModificacion
     *
     * @param string $fechaModificacion
     * @return $this
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Method to set the value of field codCategoria
     *
     * @param integer $codCategoria
     * @return $this
     */
    public function setCodCategoria($codCategoria)
    {
        $this->codCategoria = $codCategoria;

        return $this;
    }

    /**
     * Method to set the value of field codMarca
     *
     * @param integer $codMarca
     * @return $this
     */
    public function setCodMarca($codMarca)
    {
        $this->codMarca = $codMarca;

        return $this;
    }

    /**
     * Method to set the value of field codModelo
     *
     * @param integer $codModelo
     * @return $this
     */
    public function setCodModelo($codModelo)
    {
        $this->codModelo = $codModelo;

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
     * Method to set the value of field descripcionCorta
     *
     * @param string $descripcionCorta
     * @return $this
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    /**
     * Method to set the value of field fechaVencimiento
     *
     * @param string $fechaVencimiento
     * @return $this
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Method to set the value of field fechaAlta
     *
     * @param string $fechaAlta
     * @return $this
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

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
     * Returns the value of field codProducto
     *
     * @return integer
     */
    public function getCodProducto()
    {
        return $this->codProducto;
    }

    /**
     * Returns the value of field descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Returns the value of field imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Returns the value of field fechaBaja
     *
     * @return string
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Returns the value of field motivoBaja
     *
     * @return string
     */
    public function getMotivoBaja()
    {
        return $this->motivoBaja;
    }

    /**
     * Returns the value of field estadoRegistro
     *
     * @return string
     */
    public function getEstadoRegistro()
    {
        return $this->estadoRegistro;
    }

    /**
     * Returns the value of field usuarioInsercion
     *
     * @return string
     */
    public function getUsuarioInsercion()
    {
        return $this->usuarioInsercion;
    }

    /**
     * Returns the value of field fechaInsercion
     *
     * @return string
     */
    public function getFechaInsercion()
    {
        return $this->fechaInsercion;
    }

    /**
     * Returns the value of field usuarioModificacion
     *
     * @return string
     */
    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    /**
     * Returns the value of field fechaModificacion
     *
     * @return string
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Returns the value of field codCategoria
     *
     * @return integer
     */
    public function getCodCategoria()
    {
        return $this->codCategoria;
    }

    /**
     * Returns the value of field codMarca
     *
     * @return integer
     */
    public function getCodMarca()
    {
        return $this->codMarca;
    }

    /**
     * Returns the value of field codModelo
     *
     * @return integer
     */
    public function getCodModelo()
    {
        return $this->codModelo;
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
     * Returns the value of field descripcionCorta
     *
     * @return string
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Returns the value of field fechaVencimiento
     *
     * @return string
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Returns the value of field fechaAlta
     *
     * @return string
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
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
        $this->setSource("producto");
        $this->hasMany('codProducto', 'HistoricoMovimientos', 'codProducto', ['alias' => 'HistoricoMovimientos']);
        $this->hasMany('codProducto', 'Logistica', 'codProducto', ['alias' => 'Logistica']);
        $this->hasMany('codProducto', 'ProductoPrecio', 'codProducto', ['alias' => 'ProductoPrecio']);
        $this->hasMany('codProducto', 'ProductoProveedor', 'codProducto', ['alias' => 'ProductoProveedor']);
        $this->hasMany('codProducto', 'ProductoUnidad', 'codProducto', ['alias' => 'ProductoUnidad']);
        $this->hasMany('codProducto', 'Ubicacion', 'codProducto', ['alias' => 'Ubicacion']);
        $this->belongsTo('codCategoria', '\Categoria', 'codCategoria', ['alias' => 'Categoria']);
        $this->belongsTo('codMarca', '\Marca', 'codMarca', ['alias' => 'Marca']);
        $this->belongsTo('codModelo', '\Modelo', 'codModelo', ['alias' => 'Modelo']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Producto[]|Producto|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Producto|\Phalcon\Mvc\Model\ResultInterface
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
        return 'producto';
    }

}
