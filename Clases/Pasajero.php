<?php

class Pasajero {

    private $nombre;
    private $apellido;
    private $nroDoc;
    private $telefono;
    private $mensajeoperacion;

    public function __construct(){

		$this->nombre = "";
		$this->apellido = "";
		$this->nroDoc = "";
		$this->telefono = "";

	}

    // Metodo Cargar Datos
    public function cargar($nomb, $apelli, $nroD, $telef){
		
		$this->setNombre($nomb);
		$this->setApellido($apelli);
		$this->setNrodoc($nroD);
        $this->setTelefono($telef);

	}

    // <--------------Metodo Get------------------------------------------------------->
	public function getNombre() {
		return $this->nombre;
	}

	public function getApellido() {
		return $this->apellido;
	}

	public function getNroDoc() {
		return $this->nroDoc;
	}

	public function getTelefono() {
		return $this->telefono;
	}

	public function getMensajeoperacion() {
		return $this->mensajeoperacion;
	}

    // <------------Metodo Set----------------------------------------------------------->
	public function setNombre($nuevoNombre) {
		$this->nombre = $nuevoNombre;
	}

	public function setApellido($nuevoApellido) {
		$this->apellido = $nuevoApellido;
	}

	public function setNroDoc($nuevoNroDoc) {
		$this->nroDoc = $nuevoNroDoc;
	}

	public function setTelefono($nuevoTelefono) {
		$this->telefono = $nuevoTelefono;
	}

	public function setMensajeoperacion($nuevoMensajeOperacion) {
		$this->mensajeoperacion = $nuevoMensajeOperacion;
	}

}
?>