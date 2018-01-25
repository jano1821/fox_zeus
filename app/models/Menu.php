<?php

class Menu extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codMenu;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $descripcion;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    protected $icono;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $idBoton;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $nombreBoton;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $tipoMenu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $orden;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
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
     * Method to set the value of field codMenu
     *
     * @param integer $codMenu
     * @return $this
     */
    public function setCodMenu($codMenu)
    {
        $this->codMenu = $codMenu;

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
     * Method to set the value of field id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field icono
     *
     * @param string $icono
     * @return $this
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;

        return $this;
    }

    /**
     * Method to set the value of field idBoton
     *
     * @param string $idBoton
     * @return $this
     */
    public function setIdBoton($idBoton)
    {
        $this->idBoton = $idBoton;

        return $this;
    }

    /**
     * Method to set the value of field nombreBoton
     *
     * @param string $nombreBoton
     * @return $this
     */
    public function setNombreBoton($nombreBoton)
    {
        $this->nombreBoton = $nombreBoton;

        return $this;
    }

    /**
     * Method to set the value of field tipoMenu
     *
     * @param string $tipoMenu
     * @return $this
     */
    public function setTipoMenu($tipoMenu)
    {
        $this->tipoMenu = $tipoMenu;

        return $this;
    }

    /**
     * Method to set the value of field orden
     *
     * @param integer $orden
     * @return $this
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

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
     * Returns the value of field codMenu
     *
     * @return integer
     */
    public function getCodMenu()
    {
        return $this->codMenu;
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
     * Returns the value of field id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field icono
     *
     * @return string
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Returns the value of field idBoton
     *
     * @return string
     */
    public function getIdBoton()
    {
        return $this->idBoton;
    }

    /**
     * Returns the value of field nombreBoton
     *
     * @return string
     */
    public function getNombreBoton()
    {
        return $this->nombreBoton;
    }

    /**
     * Returns the value of field tipoMenu
     *
     * @return string
     */
    public function getTipoMenu()
    {
        return $this->tipoMenu;
    }

    /**
     * Returns the value of field orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
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
        $this->setSource("menu");
        $this->hasMany('codMenu', 'MenuSistema', 'codMenu', ['alias' => 'MenuSistema']);
        $this->hasMany('codMenu', 'MenuUsuario', 'codMenu', ['alias' => 'MenuUsuario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'menu';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Menu[]|Menu|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Menu|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
