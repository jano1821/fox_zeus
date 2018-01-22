<?php

class Persona extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codPersona;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=false)
     */
    protected $nombrePersona;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $apePat;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $apeMat;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    protected $sexo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $edad;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    protected $numeroDocumento;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    protected $razonSocial;

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
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $codTipoDocumento;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $tipoPersona;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codEmpresa;

    /**
     * Method to set the value of field codPersona
     *
     * @param integer $codPersona
     * @return $this
     */
    public function setCodPersona($codPersona)
    {
        $this->codPersona = $codPersona;

        return $this;
    }

    /**
     * Method to set the value of field nombrePersona
     *
     * @param string $nombrePersona
     * @return $this
     */
    public function setNombrePersona($nombrePersona)
    {
        $this->nombrePersona = $nombrePersona;

        return $this;
    }

    /**
     * Method to set the value of field apePat
     *
     * @param string $apePat
     * @return $this
     */
    public function setApePat($apePat)
    {
        $this->apePat = $apePat;

        return $this;
    }

    /**
     * Method to set the value of field apeMat
     *
     * @param string $apeMat
     * @return $this
     */
    public function setApeMat($apeMat)
    {
        $this->apeMat = $apeMat;

        return $this;
    }

    /**
     * Method to set the value of field sexo
     *
     * @param string $sexo
     * @return $this
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Method to set the value of field edad
     *
     * @param integer $edad
     * @return $this
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Method to set the value of field numeroDocumento
     *
     * @param string $numeroDocumento
     * @return $this
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Method to set the value of field razonSocial
     *
     * @param string $razonSocial
     * @return $this
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

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
     * Method to set the value of field codTipoDocumento
     *
     * @param integer $codTipoDocumento
     * @return $this
     */
    public function setCodTipoDocumento($codTipoDocumento)
    {
        $this->codTipoDocumento = $codTipoDocumento;

        return $this;
    }

    /**
     * Method to set the value of field tipoPersona
     *
     * @param string $tipoPersona
     * @return $this
     */
    public function setTipoPersona($tipoPersona)
    {
        $this->tipoPersona = $tipoPersona;

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
     * Returns the value of field codPersona
     *
     * @return integer
     */
    public function getCodPersona()
    {
        return $this->codPersona;
    }

    /**
     * Returns the value of field nombrePersona
     *
     * @return string
     */
    public function getNombrePersona()
    {
        return $this->nombrePersona;
    }

    /**
     * Returns the value of field apePat
     *
     * @return string
     */
    public function getApePat()
    {
        return $this->apePat;
    }

    /**
     * Returns the value of field apeMat
     *
     * @return string
     */
    public function getApeMat()
    {
        return $this->apeMat;
    }

    /**
     * Returns the value of field sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Returns the value of field edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Returns the value of field numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Returns the value of field razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
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
     * Returns the value of field codTipoDocumento
     *
     * @return integer
     */
    public function getCodTipoDocumento()
    {
        return $this->codTipoDocumento;
    }

    /**
     * Returns the value of field tipoPersona
     *
     * @return string
     */
    public function getTipoPersona()
    {
        return $this->tipoPersona;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("persona");
        $this->hasMany('codPersona', 'Cliente', 'codPersona', ['alias' => 'Cliente']);
        $this->hasMany('codPersona', 'Direccion', 'codPersona', ['alias' => 'Direccion']);
        $this->hasMany('codPersona', 'Empleado', 'codPersona', ['alias' => 'Empleado']);
        $this->hasMany('codPersona', 'Proveedor', 'codPersona', ['alias' => 'Proveedor']);
        $this->hasMany('codPersona', 'Telefono', 'codPersona', ['alias' => 'Telefono']);
        $this->belongsTo('codTipoDocumento', '\TipoDocumento', 'codTipoDocumento', ['alias' => 'TipoDocumento']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'persona';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Persona[]|Persona|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Persona|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
