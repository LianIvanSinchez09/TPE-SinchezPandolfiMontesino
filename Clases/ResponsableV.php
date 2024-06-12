<?php

// aregistra el número de empleado, número de licencia, nombre y apellido
class ResponsableV extends Persona {
    private $numEmpleado;
    private $numLicencia;


    public function __construct() {
        parent::__construct();
    	$this->numEmpleado = "";
    	$this->numLicencia = "";        
    }

    public function cargar($NroD,$Nom,$Ape,$numEmpleado = "", $numLicencia = ""){
        parent::cargar($NroD,$Nom,$Ape);
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