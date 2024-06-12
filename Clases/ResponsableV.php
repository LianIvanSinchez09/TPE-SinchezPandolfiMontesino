<?php

//registra el número de empleado, número de licencia, nombre y apellido
class ResponsableV extends Persona {
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;
    private $dni;
    private $mail;


    public function __construct() {
        parent::__construct();
    	$this->numEmpleado = "";
    	$this->numLicencia = "";        
    }

    public function cargar($numEmpleado, $numLicencia, $nombre, $apellido, $dni, $mail = null){
        parent::cargar($dni, $nombre, $apellido, $mail);
        $this->setNumEmpleado($numEmpleado);
        $this->setNumLicencia($numLicencia);
    }

    public function getNumEmpleado() {
      return $this->numEmpleado;
    }
    public function setNumEmpleado($value) {
      $this->numEmpleado = $value;
    }

    public function getNumLicencia() {
      return $this->numLicencia;
    }
    public function setNumLicencia($value) {
      $this->numLicencia = $value;
    }
}