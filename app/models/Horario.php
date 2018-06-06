<?php

class Horario extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $codHorario;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $horaIngreso;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horaSalida;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horaDescanso;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horaRetorno;

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
    public $codPersona;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horaIngresoSabatino;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horaSalidaSabatino;

    /**
     * Method to set the value of field codHorario
     *
     * @param integer $codHorario
     * @return $this
     */
    public function setCodHorario($codHorario)
    {
        $this->codHorario = $codHorario;

        return $this;
    }

    /**
     * Method to set the value of field horaIngreso
     *
     * @param string $horaIngreso
     * @return $this
     */
    public function setHoraIngreso($horaIngreso)
    {
        $this->horaIngreso = $horaIngreso;

        return $this;
    }

    /**
     * Method to set the value of field horaSalida
     *
     * @param string $horaSalida
     * @return $this
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    /**
     * Method to set the value of field horaDescanso
     *
     * @param string $horaDescanso
     * @return $this
     */
    public function setHoraDescanso($horaDescanso)
    {
        $this->horaDescanso = $horaDescanso;

        return $this;
    }

    /**
     * Method to set the value of field horaRetorno
     *
     * @param string $horaRetorno
     * @return $this
     */
    public function setHoraRetorno($horaRetorno)
    {
        $this->horaRetorno = $horaRetorno;

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
     * Method to set the value of field horaIngresoSabatino
     *
     * @param string $horaIngresoSabatino
     * @return $this
     */
    public function setHoraIngresoSabatino($horaIngresoSabatino)
    {
        $this->horaIngresoSabatino = $horaIngresoSabatino;

        return $this;
    }

    /**
     * Method to set the value of field horaSalidaSabatino
     *
     * @param string $horaSalidaSabatino
     * @return $this
     */
    public function setHoraSalidaSabatino($horaSalidaSabatino)
    {
        $this->horaSalidaSabatino = $horaSalidaSabatino;

        return $this;
    }

    /**
     * Returns the value of field codHorario
     *
     * @return integer
     */
    public function getCodHorario()
    {
        return $this->codHorario;
    }

    /**
     * Returns the value of field horaIngreso
     *
     * @return string
     */
    public function getHoraIngreso()
    {
        return $this->horaIngreso;
    }

    /**
     * Returns the value of field horaSalida
     *
     * @return string
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Returns the value of field horaDescanso
     *
     * @return string
     */
    public function getHoraDescanso()
    {
        return $this->horaDescanso;
    }

    /**
     * Returns the value of field horaRetorno
     *
     * @return string
     */
    public function getHoraRetorno()
    {
        return $this->horaRetorno;
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
     * Returns the value of field codPersona
     *
     * @return integer
     */
    public function getCodPersona()
    {
        return $this->codPersona;
    }

    /**
     * Returns the value of field horaIngresoSabatino
     *
     * @return string
     */
    public function getHoraIngresoSabatino()
    {
        return $this->horaIngresoSabatino;
    }

    /**
     * Returns the value of field horaSalidaSabatino
     *
     * @return string
     */
    public function getHoraSalidaSabatino()
    {
        return $this->horaSalidaSabatino;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fox_zeus");
        $this->setSource("horario");
        $this->belongsTo('codPersona', '\Empleado', 'codPersona', ['alias' => 'Empleado']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Horario[]|Horario|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Horario|\Phalcon\Mvc\Model\ResultInterface
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
        return 'horario';
    }

}
