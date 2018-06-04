<?php

class Marca extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codMarca;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $descripcion;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
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
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $indicadorExclusivo;

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
    public $codAgencia;

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
     * Method to set the value of field indicadorExclusivo
     *
     * @param string $indicadorExclusivo
     * @return $this
     */
    public function setIndicadorExclusivo($indicadorExclusivo)
    {
        $this->indicadorExclusivo = $indicadorExclusivo;

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
     * Returns the value of field codMarca
     *
     * @return integer
     */
    public function getCodMarca()
    {
        return $this->codMarca;
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
     * Returns the value of field indicadorExclusivo
     *
     * @return string
     */
    public function getIndicadorExclusivo()
    {
        return $this->indicadorExclusivo;
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
        $this->setSource("marca");
        $this->hasMany('codMarca', 'Producto', 'codMarca', ['alias' => 'Producto']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Marca[]|Marca|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Marca|\Phalcon\Mvc\Model\ResultInterface
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
        return 'marca';
    }

}
