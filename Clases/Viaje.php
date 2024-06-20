<?php

class Viaje {

    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objNumeroDniEmpleado; // objeto foráneo
    private $objIdEmpresa;      // objeto foráneo
    private $importe;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idViaje = "";
        $this->destino = "";
        $this->cantMaxPasajeros = "";
        $this->objNumeroDniEmpleado = new ResponsableV(); // Inicializamos como objetos
        $this->objIdEmpresa = new Empresa(); // Inicializamos como objetos
        $this->importe = "";
    }

    public function cargar($idViaje, $destino, $cantMaxPasajeros, $objNumeroDniEmpleado, $objIdEmpresa, $importe)
    {
        $this->setIdViaje($idViaje);
        $this->setDestino($destino);
        $this->setCantMaxPasajeros($cantMaxPasajeros);
        $this->setObjNumeroDniEmpleado($objNumeroDniEmpleado); // Objeto
        $this->setObjIdEmpresa($objIdEmpresa); // Objeto
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

    public function getObjNumeroDniEmpleado() { // Objeto
        return $this->objNumeroDniEmpleado;
    }

    public function getObjIdEmpresa() { // Objeto
        return $this->objIdEmpresa;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function getmensajeoperacion() {
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

    public function setObjNumeroDniEmpleado($value) { // Objeto
        $this->objNumeroDniEmpleado = $value;
    }

    public function setObjIdEmpresa($value) { // Objeto
        $this->objIdEmpresa = $value;
    }

    public function setImporte($value) {
        $this->importe = $value;
    }

    public function setmensajeoperacion($mensajeoperacion) {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __toString() {
        $info = "\nId Viaje: " . $this->getIdViaje();
        $info .= "\nDestino: " . $this->getDestino();
        $info .= "\nCantidad Max De Pasajeros: " . $this->getCantMaxPasajeros();
        $info .= "\nDNI Empleado a cargo: \n" . $this->getObjNumeroDniEmpleado()->getdocumento(); // clave foranea
        $info .= "\nEmpresa a la que esta asociada: \n" . $this->getObjIdEmpresa()->getIdEmpresa(); // clave foranea
        $info .= "\nImporte: $" . $this->getImporte() . "\n";

        return $info;
    }

    public function Buscar($id) {
        $base = new BaseDatos();
        $consultaViaje = "Select * from viaje where idViaje=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdViaje($id);
                    $this->setDestino($row2['destino']);
                    $this->setCantMaxPasajeros($row2['cantMaxPasajeros']);
                    $numeroDniEmpleado = new ResponsableV();
                    $numeroDniEmpleado->Buscar($row2['documentoEmpleado']); // Cargar objeto empleado
                    $this->setObjNumeroDniEmpleado($numeroDniEmpleado);
                    $idEmpresa = new Empresa();
                    $idEmpresa->Buscar($row2['idEmpresa']); // Cargar objeto empresa
                    $this->setObjIdEmpresa($idEmpresa);
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


    public function listar($condicion = "") {
        $arregloViaje = null;
        $base = new BaseDatos();
        $consultaViaje = "Select * from viaje ";
        if ($condicion != "") {
            $consultaViaje = $consultaViaje . ' where ' . $condicion;
        }
        $consultaViaje .= " order by destino ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                $arregloViaje = array();
                while ($row2 = $base->Registro()) {
                    $idViaje = $row2['idViaje'];
                    $destino = $row2['destino'];
                    $cantMaxPasajeros = $row2['cantMaxPasajeros'];
                    $numeroEmpleado = new ResponsableV();
                    $numeroEmpleado->Buscar($row2['documentoEmpleado']); // Cargar objeto empleado
                    $idEmpresa = new Empresa();
                    $idEmpresa->Buscar($row2['idEmpresa']); // Cargar objeto empresa
                    $importe = $row2['importe'];

                    $viaj = new Viaje();
                    $viaj->cargar($idViaje, $destino, $cantMaxPasajeros, $numeroEmpleado, $idEmpresa, $importe);
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

    public function insertar() {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO viaje(destino, cantMaxPasajeros, documentoEmpleado, idEmpresa, importe) 
                VALUES ('" . $this->getDestino() . "','" . $this->getCantMaxPasajeros() . "','" . $this->getObjNumeroDniEmpleado()->getdocumento() . "','" . $this->getObjIdEmpresa()->getIdEmpresa() . "','" . $this->getImporte() . "')";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdViaje($id);
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE viaje SET destino='" . $this->getDestino() . "',cantMaxPasajeros='" . $this->getCantMaxPasajeros() . "',documentoEmpleado='" . $this->getObjNumeroDniEmpleado()->getdocumento() . "',idEmpresa='" . $this->getObjIdEmpresa()->getIdEmpresa() . "',importe='" . $this->getImporte() . "' WHERE idViaje=" . $this->getIdViaje();
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

    public function eliminar() {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM viaje WHERE idViaje=" . $this->getIdViaje();
            if ($id = $base->devuelveIDInsercion($consultaBorra)) {
                $this->setIdViaje($id);
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function hayPasajesDisponibles($id){
        $pasajero = new Pasajero();
        $cantPasajeros = 0;
        $viaje = null;
        $pasajeros = $pasajero->listar();
        $esDisponible = false;
        for ($i=0; $i < count($pasajeros); $i++) { 
            if($id == $pasajeros[$i]->getObjViaje()->getIdViaje()){
                $viaje = $pasajeros[$i]->getObjViaje();
                $cantPasajeros++;
            }
        }

        if(count($pasajeros) == 0 || $viaje->getCantMaxPasajeros() > $cantPasajeros){
            $esDisponible = true;
        }
        return $esDisponible;
    }

}
?>
