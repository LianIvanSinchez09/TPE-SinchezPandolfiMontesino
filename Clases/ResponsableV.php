<?php

//registra el número de empleado, número de licencia, nombre y apellido
class ResponsableV extends Persona
{

  private $numEmpleado;
  private $numLicencia;


  public function __construct()
  {
    parent::__construct();
    $this->numEmpleado = "";
    $this->numLicencia = "";
  }

  public function cargar($NroD, $Nom, $Ape, $numEmpleado = "", $numLicencia = "")
  {
    parent::cargar($NroD, $Nom, $Ape);
    $this->setNumEmpleado($numEmpleado);
    $this->setNumLicencia($numLicencia);
  }

  public function getNumEmpleado()
  {
    return $this->numEmpleado;
  }
  public function setNumEmpleado($value)
  {
    $this->numEmpleado = $value;
  }

  public function getNumLicencia()
  {
    return $this->numLicencia;
  }

  public function setNumLicencia($value)
  {
    $this->numLicencia = $value;
  }

  public function __toString()
  {
    return parent::__toString() . "Numero de Empleado: " . $this->getNumEmpleado() . "\nNumero de Licencia: " . $this->getNumLicencia() . "\n";
  }


  public function Buscar($dni)
  {
    $base = new BaseDatos();
    $consulta = "Select * from personaresponsable where documento=" . $dni;
    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consulta)) {
        if ($row2 = $base->Registro()) {
          parent::Buscar($dni);
          $this->setNumEmpleado($row2['numeroEmpleado']);
          $this->setNumLicencia($row2['numeroLicencia']);
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
    $arreglo = null;
    $base = new BaseDatos();
    $consulta = "Select * from personaresponsable ";
    if ($condicion != "") {
      $consulta = $consulta . ' where ' . $condicion;
    }
    $consulta .= " order by carrera ";
    //echo $consultaPersonas;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consulta)) {
        $arreglo = array();
        while ($row2 = $base->Registro()) {
          $obj = new ResponsableV();
          $obj->Buscar($row2['documento']);
          array_push($arreglo, $obj);
        }
      } else {
        $this->setmensajeoperacion($base->getError());
      }
    } else {
      $this->setmensajeoperacion($base->getError());
    }
    return $arreglo;
  }

  public function insertar()
  {
    $base = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO personaresponsable(documento, numeroEmpleado, numeroLicencia) 
          VALUES (" . $this->getdocumento() . ",'" . $this->getNumEmpleado() . "','" . $this->getNumLicencia() . "')";

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
    if (parent::modificar()) {
      $consultaModifica = "UPDATE personaresponsable SET numeroEmpleado='" . $this->getNumEmpleado() . "',numeroLicencia='" . $this->getNumLicencia() . "' WHERE documento =" . parent::getdocumento();
      if ($base->Iniciar()) {
        if ($base->Ejecutar($consultaModifica)) {
          $resp =  true;
        } else {
          $this->setmensajeoperacion($base->getError());
        }
      } else {
        $this->setmensajeoperacion($base->getError());
      }
    }

    return $resp;
  }

  public function eliminar()
  {
    $base = new BaseDatos();
    $resp = false;
    if ($base->Iniciar()) {
      $consultaBorra = "DELETE FROM personaresponsable WHERE documento=" . $this->getdocumento();
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
}
