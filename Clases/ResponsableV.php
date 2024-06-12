<?php

//registra el número de empleado, número de licencia, nombre y apellido
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

    public function insertar(){
      $base=new BaseDatos();
      $resp= false;
      $consultaInsertar="INSERT INTO personaresponsable(documento, numeroEmpleado, numeroLicencia) 
          VALUES (".$this->getdocumento().",'".$this->getNumEmpleado()."','".$this->getNumLicencia()."')";
      
      if($base->Iniciar()){
  
        if($base->Ejecutar($consultaInsertar)){
  
            $resp=  true;
  
        }	else {
            $this->setmensajeoperacion($base->getError());
            
        }
  
      } else {
          $this->setmensajeoperacion($base->getError());
        
      }
      return $resp;
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

    public function __toString()
    {
        return parent::__toString() . "\n" . $this->getNumEmpleado() . "\n" . $this->getNumLicencia();
    }
}