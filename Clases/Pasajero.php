<?php

class Pasajero extends Persona {
	private $idpasajero;
	private $objViaje;
    private $telefono;
    private $mensajeoperacion;

    public function __construct(){
		parent::__construct();
		$this->idpasajero=0;
		$this->objViaje = new Viaje();
		$this->telefono = "";

	}

	// Metodo Cargar Datos
	/*LIAN esto no lo borres es otra forma de hacer el cargar en las funciones
	public function cargar($param){
		parent::cargar($param);
		$this->setIdPasajero($param['idpasajero'] );
        $this->setTelefono($param['telef'] );*/
  	public function cargar($NroD,$Nom,$Ape, $objViaje=null,$telef = null){
		parent::cargar($NroD,$Nom,$Ape);
		$this->setIdPasajero(0);
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

	//<--------------------Metodos-- --------------------->
	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO pasajero(idPasajero, documento, objViaje, telefono) 
			VALUES ('".$this->getIdPasajero()."','".$this->getdocumento()."','" . $this->getobjViaje()->getIdViaje() . "','" . $this->getTelefono() . "')";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdPasajero($id);
			    $resp=  true;
			}	else {
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
