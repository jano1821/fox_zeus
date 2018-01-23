<?php

class Empleado extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codPersona;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codTipoEmpleado;

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
     * Method to set the value of field codTipoEmpleado
     *
     * @param integer $codTipoEmpleado
     * @return $this
     */
    public function setCodTipoEmpleado($codTipoEmpleado)
    {
        $this->codTipoEmpleado = $codTipoEmpleado;

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
     * Returns the value of field codPersona
     *
     * @return integer
     */
    public function getCodPersona()
    {
        return $this->codPersona;
    }

    /**
     * Returns the value of field codTipoEmpleado
     *
     * @return integer
     */
    public function getCodTipoEmpleado()
    {
        return $this->codTipoEmpleado;
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
        $this->setSource("empleado");
        $this->hasMany('codPersona', 'Horario', 'codPersona', ['alias' => 'Horario']);
        $this->hasMany('codPersona', 'Permisos', 'codPersona', ['alias' => 'Permisos']);
        $this->hasMany('codPersona', 'RegistroAsistencia', 'codPersona', ['alias' => 'RegistroAsistencia']);
        $this->hasMany('codPersona', 'Usuario', 'codPersona', ['alias' => 'Usuario']);
        $this->hasMany('codPersona', 'Venta', 'codPersona', ['alias' => 'Venta']);
        $this->belongsTo('codPersona', '\Persona', 'codPersona', ['alias' => 'Persona']);
        $this->belongsTo('codTipoEmpleado', '\TipoEmpleado', 'codTipoEmpleado', ['alias' => 'TipoEmpleado']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Empleado[]|Empleado|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Empleado|\Phalcon\Mvc\Model\ResultInterface
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
        return 'empleado';
    }

}
