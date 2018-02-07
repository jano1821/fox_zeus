<?php

class Proveedor extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $codPersona;

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
        $this->setSource("proveedor");
        $this->hasMany('codPersona', 'HistoricoMovimientos', 'codPersona', ['alias' => 'HistoricoMovimientos']);
        $this->hasMany('codPersona', 'ProductoProveedor', 'codPersona', ['alias' => 'ProductoProveedor']);
        $this->belongsTo('codPersona', '\Persona', 'codPersona', ['alias' => 'Persona']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'proveedor';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Proveedor[]|Proveedor|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Proveedor|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
