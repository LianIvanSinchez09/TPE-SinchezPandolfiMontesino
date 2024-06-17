<?php
class Pasajero extends Persona {
    private $idpasajero;
    private $objViaje; // foránea 1:1 (obj) claveforánea es (atributo adentro del objeto: idViaje)
    private $telefono;
    private $mensajeoperacion;

    public function __construct(){
        parent::__construct();
        $this->idpasajero = "";
        $this->objViaje = new Viaje();
        $this->telefono = "";
    }

    // Metodo Cargar Datos
    public function cargar($NroD, $Nom, $Ape, $idpasajero = null, $objViaje = null, $telef = ""){
        parent::cargar($NroD, $Nom, $Ape);
        $this->setIdPasajero($idpasajero);
        $this->setObjViaje($objViaje);
        $this->setTelefono($telef);
    }

    // <--------------Metodos Get------------------------------------------------------->
    public function getIdPasajero(){
        return $this->idpasajero;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getObjViaje(){
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

    public function setObjViaje($objViaje){
        $this->objViaje = $objViaje;
    }

    public function setMensajeoperacion($nuevoMensajeOperacion) {
        $this->mensajeoperacion = $nuevoMensajeOperacion;
    }

    // Métodos

    public function Buscar($dni){
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero WHERE documento='" . $dni . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($dni);
                    $this->setIdPasajero($row2['idPasajero']);
                    $this->setTelefono($row2['telefono']);
                    $objViaje = new Viaje();
                    $objViaje->Buscar($row2['idViaje']);
                    $this->setObjViaje($objViaje);
                    $resp = true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = ""){
        $arreglo = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY idPasajero ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Pasajero();
                    $obj->Buscar($row2['documento']);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arreglo;
    }

    

    public function hayPasajesDisponibles(){
        $cantActualPasajeros = count($this->listar());
        $esDisponible = false;
        if($this->getObjViaje()->getCantMaxPasajeros() > $cantActualPasajeros){
            $esDisponible = true;
        }
        return $esDisponible;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO pasajero(documento, idViaje, telefono) 
                            VALUES ('".parent::getdocumento()."', '".$this->getobjViaje()->getIdViaje()."', '" . $this->getTelefono() . "')";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdPasajero($id);
                $resp = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }

        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE pasajero SET telefono='" . $this->getTelefono() . "', idViaje='" . $this->getObjViaje()->getIdViaje() . "' WHERE documento='" . parent::getDocumento() . "' AND idPasajero='" . $this->getIdPasajero();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setMensajeoperacion($base->getError());
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }

        return $resp;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM pasajero WHERE documento='" . parent::getDocumento() . "' AND idPasajero='" . $this->getIdPasajero() . "'";
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
                    $resp = true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function __toString(){
        return parent::__toString() . "Id Pasajero: " . $this->getIdPasajero() . "\nId Viaje: " . $this->getObjViaje()->getIdViaje() . "\nTelefono: " . $this->getTelefono() ."\n";
    }
}

/*
    public function hayPasajesDisponibles(){
        
        $colViaje = [];
        $esDisponible = false;
        $colTotalPasajeros = $this->listar();

        foreach($colTotalPasajeros as $pasajero){

            if(pasajero->$this->getobjViaje()->getIdViaje()) == 1){
                
                array_push($colViaje,  $pasajero);

            }

        }
            
        
        if($this->getObjViaje()->getCantMaxPasajeros() > $count($colViaje)){
            $esDisponible = true;
        }

        return $esDisponible;
    }
    */
?>