<?php

class Empresa
{

    private $idEmpresa;
    private $nombre;
    private $direccion;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idEmpresa = "";
        $this->nombre = "";
        $this->direccion = "";
    }

    public function cargar($idEmpresa, $Nom, $direccion)
    {
        $this->setIdEmpresa($idEmpresa);
        $this->setNombre($Nom);
        $this->setDireccion($direccion);
    }

    //<-------Metodos get---------------------------------------------------->
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    //<-------Metodos set---------------------------------------------------->
    public function setIdEmpresa($value)
    {
        $this->idEmpresa = $value;
    }

    public function setNombre($value)
    {
        $this->nombre = $value;
    }

    public function setDireccion($value)
    {
        $this->direccion = $value;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __toString()
    {
        return "\nId Empresa: " . $this->getIdEmpresa() . "\nNombre: " . $this->getNombre() . "\nDireccion: " . $this->getDireccion() . "\n";
    }

    /**
     * Recupera los datos de una empresa por id
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaEmpresa = "Select * from empresa where idEmpresa=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresa)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdEmpresa($id);
                    $this->setNombre($row2['nombre']);
                    $this->setDireccion($row2['direccion']);
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
        $consultaEmpresa = "Select * from empresa ";
        if ($condicion != "") {
            $consultaEmpresa = $consultaEmpresa . ' where ' . $condicion;
        }
        $consultaEmpresa .= " order by nombre ";
        //echo $consultaEmpresa;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresa)) {
                $arregloEmpresa = array();
                while ($row2 = $base->Registro()) {

                    $idEmpresa = $row2['idEmpresa'];
                    $nombre = $row2['nombre'];
                    $direccion = $row2['direccion'];

                    $empre = new Empresa();
                    $empre->cargar($idEmpresa, $nombre, $direccion);
                    array_push($arregloEmpresa, $empre);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloEmpresa;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(idEmpresa, nombre, direccion) 
				VALUES ('" . $this->getIdEmpresa() . "','" . $this->getNombre() . "','" . $this->getDireccion() . "')";

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
		$consultaModifica = "UPDATE empresa SET direccion='" . $this->getDireccion() . "',nombre='" . $this->getNombre() . "' WHERE idEmpresa=" . $this->getIdEmpresa();
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
			$consultaBorra = "DELETE FROM empresa WHERE idEmpresa=" . $this->getIdEmpresa();
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
?>
