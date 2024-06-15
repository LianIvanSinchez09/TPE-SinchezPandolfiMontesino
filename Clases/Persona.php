<?php
include_once "BaseDatos.php";
class Persona
{

	private $documento;
	private $nombre;
	private $apellido;
	private $mensajeoperacion;


	public function __construct()
	{
		$this->documento = "";
		$this->nombre = "";
		$this->apellido = "";
	}

	public function cargar($NroD, $Nom, $Ape)
	{
		$this->setdocumento($NroD);
		$this->setNombre($Nom);
		$this->setApellido($Ape);
	}

	//<-------Metodos set---------------------------------------------------->
	public function setdocumento($NroDNI)
	{
		$this->documento = $NroDNI;
	}
	public function setNombre($Nom)
	{
		$this->nombre = $Nom;
	}
	public function setApellido($Ape)
	{
		$this->apellido = $Ape;
	}

	public function setmensajeoperacion($mensajeoperacion)
	{
		$this->mensajeoperacion = $mensajeoperacion;
	}

	//<------Metodo get----------------------------------------------------->
	public function getdocumento()
	{
		return $this->documento;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function getApellido()
	{
		return $this->apellido;
	}

	public function getmensajeoperacion()
	{
		return $this->mensajeoperacion;
	}

	/**
	 * Recupera los datos de una persona por dni
	 * @param int $dni
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */
	public function Buscar($dni)
	{
		$base = new BaseDatos();
		$consultaPersona = "Select * from persona where documento=" . $dni;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersona)) {
				if ($row2 = $base->Registro()) {
					$this->setdocumento($dni);
					$this->setNombre($row2['nombre']);
					$this->setApellido($row2['apellido']);
					$resp = true;
				}
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}


	public function listar($condicion = "")
	{
		$arregloPersona = null;
		$base = new BaseDatos();
		$consultaPersonas = "Select * from persona ";
		if ($condicion != "") {
			$consultaPersonas = $consultaPersonas . ' where ' . $condicion;
		}
		$consultaPersonas .= " order by apellido ";
		//echo $consultaPersonas;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersonas)) {
				$arregloPersona = array();
				while ($row2 = $base->Registro()) {

					$documento = $row2['documento'];
					$Nombre = $row2['nombre'];
					$Apellido = $row2['apellido'];

					$perso = new Persona();
					$perso->cargar($documento, $Nombre, $Apellido);
					array_push($arregloPersona, $perso);
				}
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $arregloPersona;
	}



	public function insertar()
	{
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO persona(documento, apellido, nombre) 
				VALUES (" . $this->getdocumento() . ",'" . $this->getApellido() . "','" . $this->getNombre() . "')";

		if ($base->Iniciar()) {

			if ($base->Ejecutar($consultaInsertar)) {

				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}



	public function modificar()
	{
		$resp = false;
		$base = new BaseDatos();
		$consultaModifica = "UPDATE persona SET apellido='" . $this->getApellido() . "',nombre='" . $this->getNombre() . "' WHERE documento=" . $this->getdocumento();
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaModifica)) {
				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

	public function eliminar()
	{
		$base = new BaseDatos();
		$resp = false;
		if ($base->Iniciar()) {
			$consultaBorra = "DELETE FROM persona WHERE documento=" . $this->getdocumento();
			if ($base->Ejecutar($consultaBorra)) {
				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

	public function __toString()
	{
		return "\nNombre: " . $this->getNombre() . "\nApellido:" . $this->getApellido() . "\nDNI: " . $this->getdocumento() . "\n";
	}
}
