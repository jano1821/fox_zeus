<?php

class Submenu extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codSubMenu;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=false)
     */
    protected $descripcion;

    /**
     *
     * @var string
     * @Column(type="string", length=350, nullable=true)
     */
    protected $urlSubmenu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codSistema;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $indicadorSeparador;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $indicadorAdministrador;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $indicadorMenuPrincipal;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ordenMenu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $codMenuPadre;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $estadoRegistro;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $fechaInsercion;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    protected $usuarioInsercion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $fechaModificacion;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $usuarioModificacion;

    /**
     * Method to set the value of field codSubMenu
     *
     * @param integer $codSubMenu
     * @return $this
     */
    public function setCodSubMenu($codSubMenu)
    {
        $this->codSubMenu = $codSubMenu;

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
     * Method to set the value of field urlSubmenu
     *
     * @param string $urlSubmenu
     * @return $this
     */
    public function setUrlSubmenu($urlSubmenu)
    {
        $this->urlSubmenu = $urlSubmenu;

        return $this;
    }

    /**
     * Method to set the value of field codSistema
     *
     * @param integer $codSistema
     * @return $this
     */
    public function setCodSistema($codSistema)
    {
        $this->codSistema = $codSistema;

        return $this;
    }

    /**
     * Method to set the value of field indicadorSeparador
     *
     * @param string $indicadorSeparador
     * @return $this
     */
    public function setIndicadorSeparador($indicadorSeparador)
    {
        $this->indicadorSeparador = $indicadorSeparador;

        return $this;
    }

    /**
     * Method to set the value of field indicadorAdministrador
     *
     * @param string $indicadorAdministrador
     * @return $this
     */
    public function setIndicadorAdministrador($indicadorAdministrador)
    {
        $this->indicadorAdministrador = $indicadorAdministrador;

        return $this;
    }

    /**
     * Method to set the value of field indicadorMenuPrincipal
     *
     * @param string $indicadorMenuPrincipal
     * @return $this
     */
    public function setIndicadorMenuPrincipal($indicadorMenuPrincipal)
    {
        $this->indicadorMenuPrincipal = $indicadorMenuPrincipal;

        return $this;
    }

    /**
     * Method to set the value of field ordenMenu
     *
     * @param integer $ordenMenu
     * @return $this
     */
    public function setOrdenMenu($ordenMenu)
    {
        $this->ordenMenu = $ordenMenu;

        return $this;
    }

    /**
     * Method to set the value of field codMenuPadre
     *
     * @param integer $codMenuPadre
     * @return $this
     */
    public function setCodMenuPadre($codMenuPadre)
    {
        $this->codMenuPadre = $codMenuPadre;

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
     * Returns the value of field codSubMenu
     *
     * @return integer
     */
    public function getCodSubMenu()
    {
        return $this->codSubMenu;
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
     * Returns the value of field urlSubmenu
     *
     * @return string
     */
    public function getUrlSubmenu()
    {
        return $this->urlSubmenu;
    }

    /**
     * Returns the value of field codSistema
     *
     * @return integer
     */
    public function getCodSistema()
    {
        return $this->codSistema;
    }

    /**
     * Returns the value of field indicadorSeparador
     *
     * @return string
     */
    public function getIndicadorSeparador()
    {
        return $this->indicadorSeparador;
    }

    /**
     * Returns the value of field indicadorAdministrador
     *
     * @return string
     */
    public function getIndicadorAdministrador()
    {
        return $this->indicadorAdministrador;
    }

    /**
     * Returns the value of field indicadorMenuPrincipal
     *
     * @return string
     */
    public function getIndicadorMenuPrincipal()
    {
        return $this->indicadorMenuPrincipal;
    }

    /**
     * Returns the value of field ordenMenu
     *
     * @return integer
     */
    public function getOrdenMenu()
    {
        return $this->ordenMenu;
    }

    /**
     * Returns the value of field codMenuPadre
     *
     * @return integer
     */
    public function getCodMenuPadre()
    {
        return $this->codMenuPadre;
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
     * Returns the value of field fechaInsercion
     *
     * @return string
     */
    public function getFechaInsercion()
    {
        return $this->fechaInsercion;
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
     * Returns the value of field fechaModificacion
     *
     * @return string
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("submenu");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'submenu';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Submenu[]|Submenu|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Submenu|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
