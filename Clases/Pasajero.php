<?php

class Pasajero extends Persona {
	private $idpasajero;
	private $objViaje;
    private $telefono;
    private $mensajeoperacion;

    public function __construct(){
        parent::__construct();
        $this->objViaje = new Viaje();
        $this->telefono = "";
    }

    // Metodo Cargar Datos
    public function cargar($NroD, $Nom, $Ape, $objViaje = null, $telef = null){
        parent::cargar($NroD, $Nom, $Ape);
        $this->setTelefono($telef);
		$this->setobjViaje($objViaje);
	}

    // <--------------Metodo Get------------------------------------------------------->
	public function getIdPasajero(){
	    return $this->idpasajero;
	}
	public function getTelefono() {
		return $this->telefono;
	}
	public function getobjViaje(){
		return $this->objViaje;
	}

    public function getMensajeoperacion() {
        return $this->mensajeoperacion;
    }

    // Métodos Set
    public function setIdPasajero($idpasajero){
        $this->idpasajero = $idpasajero;
    }

    public function setTelefono($nuevoTelefono) {
        $this->telefono = $nuevoTelefono;
    }

	public function setobjViaje($objViaje){
		$this->objViaje=$objViaje;
	}

    public function setMensajeoperacion($nuevoMensajeOperacion) {
        $this->mensajeoperacion = $nuevoMensajeOperacion;
    }

    // Métodos
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO pasajero(documento, idViaje, telefono) 
                             VALUES ('".parent::getdocumento()."', '".$this->getobjViaje()->getIdViaje()."', '" . $this->getTelefono() . "')";
        
        if($base->Iniciar()){
            if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdPasajero($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

	public function modificar(){
	$resp =false; 
	$base=new BaseDatos();
	$consultaModifica="UPDATE pasajero SET telefono='".$this->getTelefono()."' WHERE documento=". $this->getdocumento();
	if($base->Iniciar()){
		if($base->Ejecutar($consultaModifica)){
			$resp=  true;
		}else{
			$this->setmensajeoperacion($base->getError());
			
		}
	}else{
			$this->setmensajeoperacion($base->getError());
		
	}
	return $resp;
}
	
	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM persona WHERE documento=".$this->getdocumento();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

	public function __toString(){
		return parent::__toString() . "\nobjViaje: " . $this->getobjViaje() . "\nTelefono: " . $this->getTelefono();
	}

}
?>
