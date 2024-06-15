<?php

class Viaje {

    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objNumeroEmpleado; // foranea 1:1 (obj)
    private $objIdEmpresa;      // foranea 1:1 (obj)
    private $importe;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idViaje = "";
        $this->destino = "";
        $this->cantMaxPasajeros = "";
        $this->objNumeroEmpleado = "";
        $this->objIdEmpresa = "";
        $this->importe = "";
        
    }

    public function cargar($idViaje, $destino, $cantMaxPasajeros, $objNumeroEmpleado, $objIdEmpresa, $importe)
	{
		$this->setIdViaje($idViaje);
		$this->setDestino($destino);
		$this->setCantMaxPasajeros($cantMaxPasajeros);
        $this->setObjNumeroEmpleado($objNumeroEmpleado);
		$this->setObjIdEmpresa($objIdEmpresa);
		$this->setImporte($importe);
	}

    //<-------Metodos get---------------------------------------------------->
	public function getIdViaje() {
		return $this->idViaje;
	}

	public function getDestino() {
		return $this->destino;
	}

	public function getCantMaxPasajeros() {
		return $this->cantMaxPasajeros;
	}

	public function getObjNumeroEmpleado() {
		return $this->objNumeroEmpleado;
	}

	public function getObjIdEmpresa() {
		return $this->objIdEmpresa;
	}

	public function getImporte() {
		return $this->importe;
	}

    public function getmensajeoperacion()
	{
		return $this->mensajeoperacion;
	}

    //<-------Metodos set---------------------------------------------------->
	public function setIdViaje($value) {
		$this->idViaje = $value;
	}

	public function setDestino($value) {
		$this->destino = $value;
	}

	public function setCantMaxPasajeros($value) {
		$this->cantMaxPasajeros = $value;
	}

	public function setObjNumeroEmpleado($value) {
		$this->objNumeroEmpleado = $value;
	}

	public function setObjIdEmpresa($value) {
		$this->objIdEmpresa = $value;
	}

	public function setImporte($value) {
		$this->importe = $value;
	}

    public function setmensajeoperacion($mensajeoperacion)
	{
		$this->mensajeoperacion = $mensajeoperacion;
	}

    public function __toString()
    { 

        $info = "\nId Viaje: " . $this->getIdViaje();
        $info .= "\nDestino: " . $this->getDestino();
        $info .= "\nCantidad Max De Pasajeros: " . $this->getCantMaxPasajeros();
        $info .= "\nNumero Empleado: " . $this->getCantMaxPasajeros(); // aca tiene que ir la clave foranea (numeroEmpleado)
        $info .= "\nId Empresa: " . $this->getObjIdEmpresa(); // aca tiene que ir la clave foranea (idEmpresa)
        $info .= "\nImporte: $" . $this->getImporte();

        return $info;
    }

    public function Buscar($id)    
	{
		$base = new BaseDatos();
		$consultaViaje = "Select * from viaje where idViaje=" . $id;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaViaje)) {
				if ($row2 = $base->Registro()) {
					$this->setIdViaje($id);
					$this->setDestino($row2['destino']);
					$this->setCantMaxPasajeros($row2['cantMaxPasajeros']);
                    $this->setObjNumeroEmpleado($row2['numeroEmpleado']);
					$this->setObjIdEmpresa($row2['idEmpresa']);
                    $this->setImporte($row2['importe']);					
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
		$arregloViaje = null;
		$base = new BaseDatos();
		$consultaViaje = "Select * from viaje ";
		if ($condicion != "") {
			$consultaViaje = $consultaViaje . ' where ' . $condicion;
		}
		$consultaViaje .= " order by destino ";
		//echo $consultaViaje;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaViaje)) {
				$arregloViaje = array();
				while ($row2 = $base->Registro()) {

					$idViaje = $row2['idViaje'];
					$destino = $row2['destino'];
					$cantMaxPasajeros = $row2['cantMaxPasajeros'];
                    $objNumeroEmpleado = $row2['numeroEmpleado'];
					$objIdEmpresa = $row2['idEmpresa'];
					$importe = $row2['importe'];

					$viaj = new Viaje();
					$viaj->cargar($idViaje, $destino, $cantMaxPasajeros, $objNumeroEmpleado, $objIdEmpresa, $importe);
					array_push($arregloViaje, $viaj);
				}
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $arregloViaje;
	}

    public function insertar()
	{ 
		$base = new BaseDatos();
		$resp = false;              // no se si va idViaje ????
		$consultaInsertar = "INSERT INTO viaje(idViaje, destino, cantMaxPasajeros, numeroEmpleado, idEmpresa, importe) 
				VALUES (" . $this->getIdViaje() . ",'" . $this->getDestino() . "','" . $this->getCantMaxPasajeros() . ",'" . $this->getObjNumeroEmpleado() . "','" . $this->getObjIdEmpresa() . "','" . $this->getImporte() . "')";
        // hay que poner la claves foraneas no el objeto
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
		$consultaModifica = "UPDATE viaje SET destino='" . $this->getDestino() . "',cantMaxPasajeros='" . $this->getCantMaxPasajeros() . "',numeroEmpleado='" . $this->getObjNumeroEmpleado() . "',idEmpresa='" . $this->getObjIdEmpresa() . "',importe='" . $this->getImporte() . "' WHERE idViaje=" . $this->getIdViaje();
        // tiene que delegar las clave foraneas caso idempresa y numeroEpleado 
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
			$consultaBorra = "DELETE FROM viaje WHERE idViaje=" . $this->getIdViaje();
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

    /*
    errores a corregir:
        
        #funcion __toString(): debe llevar clave foranea, no objeto

        #funcion insertar(): debe llevar clave foranea, no objeto

        #funcion modificar(): debe llevar clave foranea, no objeto

        falta comprobarlo en el test
    */

}
?>