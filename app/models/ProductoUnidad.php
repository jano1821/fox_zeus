<?php

class ProductoUnidad extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $correlativo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codUnidadPadre;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codUnidadHijo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codProducto;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $indicadorPrincipal;

    /**
     *
     * @var double
     * @Column(type="double", length=13, nullable=true)
     */
    protected $contenido;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    protected $estadoRegistro;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    protected $usuarioInsercion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $fechaInsercion;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $usuarioModificacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $fechaModificacion;

    /**
     * Method to set the value of field correlativo
     *
     * @param integer $correlativo
     * @return $this
     */
    public function setCorrelativo($correlativo)
    {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Method to set the value of field codUnidadPadre
     *
     * @param integer $codUnidadPadre
     * @return $this
     */
    public function setCodUnidadPadre($codUnidadPadre)
    {
        $this->codUnidadPadre = $codUnidadPadre;

        return $this;
    }

    /**
     * Method to set the value of field codUnidadHijo
     *
     * @param integer $codUnidadHijo
     * @return $this
     */
    public function setCodUnidadHijo($codUnidadHijo)
    {
        $this->codUnidadHijo = $codUnidadHijo;

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
     * Method to set the value of field indicadorPrincipal
     *
     * @param string $indicadorPrincipal
     * @return $this
     */
    public function setIndicadorPrincipal($indicadorPrincipal)
    {
        $this->indicadorPrincipal = $indicadorPrincipal;

        return $this;
    }

    /**
     * Method to set the value of field contenido
     *
     * @param double $contenido
     * @return $this
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

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
     * Returns the value of field correlativo
     *
     * @return integer
     */
    public function getCorrelativo()
    {
        return $this->correlativo;
    }

    /**
     * Returns the value of field codUnidadPadre
     *
     * @return integer
     */
    public function getCodUnidadPadre()
    {
        return $this->codUnidadPadre;
    }

    /**
     * Returns the value of field codUnidadHijo
     *
     * @return integer
     */
    public function getCodUnidadHijo()
    {
        return $this->codUnidadHijo;
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
     * Returns the value of field indicadorPrincipal
     *
     * @return string
     */
    public function getIndicadorPrincipal()
    {
        return $this->indicadorPrincipal;
    }

    /**
     * Returns the value of field contenido
     *
     * @return double
     */
    public function getContenido()
    {
        return $this->contenido;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("producto_unidad");
        $this->belongsTo('codUnidadPadre', '\UnidadMedida', 'codUnidad', ['alias' => 'UnidadMedida']);
        $this->belongsTo('codUnidadHijo', '\UnidadMedida', 'codUnidad', ['alias' => 'UnidadMedida']);
        $this->belongsTo('codProducto', '\Producto', 'codProducto', ['alias' => 'Producto']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'producto_unidad';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductoUnidad[]|ProductoUnidad|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductoUnidad|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
