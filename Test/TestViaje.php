<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/Empresa.php";
include_once "../Clases/Viaje.php";
include_once "../Clases/BaseDatos.php";
include_once "../Clases/Pasajero.php";

/**
 * menu de opciones para hacer el test
 * @return string
 */
function menu()
{
    echo "\nIngrese 1: Para ingresar un pasajero" .
        "\nIngrese 2: Para modificar datos del pasajero" .
        "\nIngrese 3: Insertar viaje" .
        "\nIngrese 4: Modificar un viaje" .
        "\nIngrese 5: Ingresar al responsable del viaje" .
        "\nIngrese 6: Modificar responsable del viaje" .
        "\nIngrese 7: Modificar empresa" .
        "\nIngrese 8: Mostrar detalles del viaje" .
        "\nIngrese 9: Eliminar pasajero" .
        "\nIngrese 10: Eliminar viaje" .
        "\nIngrese 11: Eliminar responsable".
        "\nIngrese 12: Eliminar pasajero";
}

/**
 * menu general para preguntar el tipo de cambio
 * @return String
 */
function menuGeneral()
{
    echo "que quiere cambiar?\n";
    echo "Ingrese (nombre): Para cambiar el nombre del pasajero" .
        "\nIngrese (apellido): Para cambiar el apellido del pasajero" .
        "\nIngrese (telefono): Para cambiar el telefono del pasajero" .
        "\nIngrese (todo): Para cambiar toda la informacion de un pasajero\n";
}

function menuViaje()
{
    echo "que quiere cambiar?\n";
    echo "\nIngrese (destino): Para cambiar el destino del viaje" .
        "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
        "\nIngrese (empleado): Para cambiar el numero de empleado del viaje" .
        "\nIngrese (empresa): Para cambiar el id de la empresa que esta con el viaje" .
        "\nIngrese (importe): Para cambiar el importe del viaje" .
        "\nIngrese (todo): Para cambiar toda la informacion del viaje\n";
}

function menuResponsable()
{
    echo "que quiere cambiar?\n";
    echo "Ingrese (nombre): Para cambiar el nombre del responsable" .
        "\nIngrese (apellido): Para cambiar el apellido del responsable" .
        "\nIngrese (empleado): Para cambiar el numero de empleado del responsable" .
        "\nIngrese (licencia): Para cambiar el numero de licencia del responsable" .
        "\nIngrese (todo): Para cambiar toda la informacion de un responsable\n";
}

/**
 * Cambia los datos que comparten todos los pasajero
 * @param string
 * @param Viaje
 * @param int
 * @return boolean
 */
function cambiarPasajero($opcionCambio, $elPasajero)
{
    $estado = false;
    switch ($opcionCambio) {
        case "nombre":
            do {
                echo "ingrese otro nombre\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = strcmp($elPasajero->getNombre(), $otroDato);
                if ($cumple != 0) {
                    $elPasajero->setNombre($otroDato);
                    $elPasajero->modificar();
                    echo "nombre cambiado";
                    echo $elPasajero;
                    $estado = true;
                } else {
                    echo "el nombre tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "apellido":
            do {
                echo "ingrese otro apellido\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = strcmp($elPasajero->getApellido(), $otroDato);
                if ($cumple != 0) {
                    $elPasajero->setApellido($otroDato);
                    $elPasajero->modificar();
                    echo "apellido cambiado";
                    echo $elPasajero;
                    $estado = true;
                } else {
                    echo "el nombre tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "telefono":
            do {
                echo "ingrese otro telefono\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = $elPasajero->getTelefono() != $otroDato;
                if ($cumple) {
                    $elPasajero->setTelefono($otroDato);
                    $elPasajero->modificar();
                    echo "telefono cambiado";
                    echo $elPasajero;
                    $estado = true;
                } else {
                    echo "el telefono tiene que ser diferente\n";
                }
            } while (!$estado);
            break;
        case "idViaje": // fran
            $objViaje = new Viaje();
            $arrayViaje = $objViaje->listar();
            if (count($arrayViaje) == 0) {
                echo "No hay Viajes Disponibles";
            } else {
                do {
                    echo "\nSeleccione un indice de Viaje que quiera cambiar por: \n";
                    for ($i = 0; $i < count($arrayViaje); $i++) {
                        echo "---------" . $i + 1 . "------------";
                        echo $arrayViaje[$i];
                        echo "\n";
                    }
                    $indice = trim(fgets(STDIN));
                    if ($elPasajero->getObjViaje()->getIdViaje() == $indice) {
                        echo "\nElija otro idViaje, tiene que ser diferente\n\n";
                    } else {
                        $elPasajero->getObjViaje()->setIdViaje($indice);
                        $elPasajero->modificar();
                        echo "\nidViaje cambiado!\n";
                        $estado = true;
                    }
                } while (!$estado);
            }
            break;
        case "todo":
            echo "ingrese el nombre del pasajero\n";
            $nombre = trim(fgets(STDIN));
            echo "ingrese el apellido del pasajero\n";
            $apellido = trim(fgets(STDIN));
            echo "ingrese el numero de telefono del pasajero\n";
            $numTele = trim(fgets(STDIN));
            echo "ingrese el numero de id de viaje del pasajero\n";
            $numIdViaje = trim(fgets(STDIN));

            $elPasajero->setNombre($nombre);
            $elPasajero->setApellido($apellido);
            $elPasajero->setTelefono($numTele);
            $elPasajero->getObjViaje()->setIdViaje($numIdViaje);
            $elPasajero->modificar();
            echo $elPasajero;
            echo "datos cambiados";
            break;
    }
    return $estado;
}

function cambiarResponsable($responsable, $opcionCambio)
{
    $estado = false;
    switch ($opcionCambio) {
        case "nombre":
            do {
                echo "ingrese otro nombre\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = strcmp($responsable->getNombre(), $otroDato);
                if ($cumple != 0) {
                    $responsable->setNombre($otroDato);
                    $responsable->modificar();
                    echo "nombre cambiado";
                    echo $responsable;
                    $estado = true;
                } else {
                    echo "el nombre tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "apellido":
            do {
                echo "ingrese otro apellido\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = strcmp($responsable->getApellido(), $otroDato);
                if ($cumple != 0) {
                    $responsable->setApellido($otroDato);
                    $responsable->modificar();
                    echo "apellido cambiado";
                    echo $responsable;
                    $estado = true;
                } else {
                    echo "el apellido tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "empleado":
            do {
                echo "ingrese otro numero de empleado\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = $responsable->getNumEmpleado() != $otroDato;
                if ($cumple) {
                    $responsable->setNumEmpleado($otroDato);
                    $responsable->modificar();
                    echo "numero de empleado cambiado";
                    echo $responsable;
                    $estado = true;
                } else {
                    echo "el numero de empleado tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "licencia":
            do {
                echo "ingrese otro numero de licencia\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = $responsable->getNumLicencia() != $otroDato;
                if ($cumple) {
                    $responsable->setNumLicencia($otroDato);
                    $responsable->modificar();
                    echo "numero de licencia cambiado";
                    echo $responsable;
                    $estado = true;
                } else {
                    echo "el numero de licencia tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "todo":
            echo "ingrese el nombre del responsable\n";
            $nombre = trim(fgets(STDIN));
            echo "ingrese el apellido del responsable\n";
            $apellido = trim(fgets(STDIN));
            echo "ingrese otro numero de empleado\n";
            $numEmple = trim(fgets(STDIN));
            echo "ingrese otro numero de licencia\n";
            $numLice = trim(fgets(STDIN));
            $responsable->setNombre($nombre);
            $responsable->setApellido($apellido);
            $responsable->setNumEmpleado($numEmple);
            $responsable->setNumLicencia($numLice);
            $responsable->modificar();
            echo "datos cambiados";;
            break;
    }
    return $estado;
}

function cambioViaje($opcionCambio, $viajeSeleccionado)
{
    $estado = false;
    switch ($opcionCambio) {
        case 'destino':
            do {
                echo "ingrese otro destino\n";
                $otroDato = trim(fgets(STDIN));
                if (strcmp($viajeSeleccionado->getDestino(), $otroDato) != 0) {
                    echo "destino cambiado";
                    $viajeSeleccionado->setDestino($otroDato);
                    $viajeSeleccionado->modificar();
                    echo $viajeSeleccionado;
                    $estado = true;
                } else {
                    echo "No se puede cambiar por el mismo destino\n";
                }
            } while (!$estado);
            break;
        case 'maximo':
            do {
                echo "ingrese otra capacidad maxima de personas\n";
                $otroDato = trim(fgets(STDIN));
                if ($viajeSeleccionado->getCantMaxPasajeros() != $otroDato) {
                    echo "capacidad cambiado";
                    $viajeSeleccionado->setCantMaxPasajeros($otroDato);
                    $viajeSeleccionado->modificar();
                    echo $viajeSeleccionado;
                    $estado = true;
                } else {
                    echo "No se puede cambiar por el misma capacidad\n";
                }
            } while (!$estado);
            break;
        case 'empleado':
            do {
                $losResponsables = new ResponsableV();
                $arrResponsable = $losResponsables->listar();
                if ($arrResponsable == null) {
                    echo "No hay otros empleados para hacer el cambio";
                } else {
                    for ($i = 0; $i < count($arrResponsable); $i++) {
                        echo "---------" . $i + 1 . "------------";
                        echo $arrResponsable[$i];
                        echo "\n";
                    }
                    echo "ingrese el indice del empleado al que quiera cambiar\n";
                    $otroDato = trim(fgets(STDIN)) - 1;
                    $nuevoRes = $arrResponsable[$otroDato];
                    echo "numero de empleado cambiado";
                    $viajeSeleccionado->setObjNumeroEmpleado($nuevoRes);
                    $viajeSeleccionado->modificar();
                    echo $viajeSeleccionado;
                    $estado = true;
                }
            } while (!$estado);;
            break;
        case 'empresa':
            do {
                $misEmpresas = new Empresa();
                $arrEmpresa = $misEmpresas->listar();
                if ($arrEmpresa == null) {
                    echo "No hay otras empresas para hacer el cambio";
                } else {
                    for ($i = 0; $i < count($arrEmpresa); $i++) {
                        echo "---------" . $i + 1 . "------------";
                        echo $arrEmpresa[$i];
                        echo "\n";
                    }
                    echo "ingrese el indice del empleado al que quiera cambiar\n";
                    $otroDato = trim(fgets(STDIN)) - 1;
                    $nuevoRes = $arrEmpresa[$otroDato];
                    echo "numero de empleado cambiado";
                    $viajeSeleccionado->setObjNumeroEmpleado($nuevoRes);
                    $viajeSeleccionado->modificar();
                    echo $viajeSeleccionado;
                    $estado = true;
                }
            } while (!$estado);;
            break;
        case 'importe':
            do {
                echo "ingrese otra valor de importe\n";
                $otroDato = trim(fgets(STDIN));
                if ($viajeSeleccionado->getImporte() != $otroDato) {
                    echo "importe cambiado";
                    $viajeSeleccionado->setImporte($otroDato);
                    $viajeSeleccionado->modificar();
                    echo $viajeSeleccionado;
                    $estado = true;
                } else {
                    echo "No se puede cambiar por el misma importe\n";
                }
            } while (!$estado);
            break;
        case 'todo':
            echo "ingrese otro destino\n";
            $destino = trim(fgets(STDIN));
            echo "ingrese otra capacidad maxima de personas\n";
            $maximo = trim(fgets(STDIN));
            echo "ingrese otra valor de importe\n";
            $importe = trim(fgets(STDIN));
            $viajeSeleccionado->setDestino($destino);
            $viajeSeleccionado->setCantMaxPasajeros($maximo);
            $viajeSeleccionado->setImporte($importe);

            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            if ($arrResponsable == null) {
                echo "No hay otros empleados para hacer el cambio";
            } else {
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                }
                echo "ingrese el indice del empleado al que quiera cambiar\n";
                $otroDato = trim(fgets(STDIN)) - 1;
                $nuevoRes = $arrResponsable[$otroDato];
                $viajeSeleccionado->setObjNumeroEmpleado($nuevoRes);
                $viajeSeleccionado->modificar();
            }
            $misEmpresas = new Empresa();
            $arrEmpresa = $misEmpresas->listar();
            if ($arrEmpresa == null) {
                echo "No hay otras empresas para hacer el cambio";
            } else {
                for ($i = 0; $i < count($arrEmpresa); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrEmpresa[$i];
                    echo "\n";
                }
                echo "ingrese el indice del empleado al que quiera cambiar\n";
                $otroDato = trim(fgets(STDIN)) - 1;
                $nuevoRes = $arrEmpresa[$otroDato];
                $viajeSeleccionado->setObjNumeroEmpleado($nuevoRes);
                $viajeSeleccionado->modificar();
            }
            break;
    }
}

//--------------------------------------------------------------------------
$responsable = new Persona();
$responsable1 = new ResponsableV();
$responsable->cargar(44323057, "Lian", "Sinchez");
$responsable1->cargar(44323057, "Lian", "Sinchez", 22, 22);
$responsable->insertar();
$responsable1->insertar();

$arrayViajes = [];
$empresa = new Empresa();
$empresa->cargar(1, "Viaje Feliz", "Buenos Aires 1800");
$viaje = new Viaje();
$viaje->cargar(1, "Cipolletti", 20, $responsable1, $empresa, 1000);
$viaje2 = new Viaje();
$viaje2->cargar(2, "Cipolletti", 20, $responsable1, $empresa, 1000);
$empresa->insertar();
$viaje->insertar();
$viaje2->insertar();
$arrayViajes[] = $viaje;
$arrayViajes[] = $viaje2;

$res = new Persona();
$res1 = new Pasajero();
$res->cargar(22222222, "matias", "pera");
$res1->cargar(22222222, "matias", "pera", 22, $viaje, 2994130513);
$res->insertar();
$res1->insertar();

do {
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    $otroPasajero = new Pasajero();
    switch ($opcion) {
        case 1:
            $listaPasajero = $otroPasajero->listar();
            if (count($listaPasajero) < $viaje->getCantMaxPasajeros()) {
                echo "ingrese el nombre del pasajero\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del pasajero\n";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el numero de documento del pasajero\n";
                $numDoc = trim(fgets(STDIN));

                $pasajeroYacargado = $otroPasajero->Buscar($numDoc);
                $nuevaPersona = new Persona();
                $personaYaCargada = $nuevaPersona->Buscar($numDoc);
                if ($personaYaCargada) {
                    echo "Esa persona ya existe en la base de datos";
                } else if ($pasajeroYacargado) {
                    echo "Ya se encuentra en ese viaje";
                } else {
                    echo "ingrese el numero de telefono del pasajero\n";
                    $numTele = trim(fgets(STDIN));
                    $nuevaPersona = new Persona();
                    $nuevoPasajero = new Pasajero();
                    $nuevaPersona->cargar($numDoc, $nombre, $apellido);
                    $nuevoPasajero->cargar($numDoc, $nombre, $apellido, 20, $viaje, $numTele);
                    $nuevaPersona->insertar();
                    $nuevoPasajero->insertar();
                    echo "Pasajero cargado en la base de datos";
                }
            } else {
                echo "No disponible";
            };
            break;
        case 2:
            echo "Ingrese el documento del pasajero";
            $doc = trim(fgets(STDIN));
            //si el pasajero existe, realizara el cambio
            if ($otroPasajero->Buscar($doc)) {
                $elPasajero = $otroPasajero->devuelveAlguien($doc);
                menuGeneral();
                $opcionCambio = trim(fgets(STDIN));
                cambiarPasajero($opcionCambio, $elPasajero);
                echo $elPasajero;
            } else {
                echo "Ese pasajero no existe";
            };
            break;
        case 3:
            echo "Ingrese destino: \n";
            $destino = trim(fgets(STDIN));
            echo "Cantidad maxima de pasajeros: \n";
            $cantMaxPasajeros = trim(fgets(STDIN));
            $otroViaje = new Viaje();
            echo "Ingrese coste del viaje: ";
            $costo = trim(fgets(STDIN));
            $otroViaje->cargar(count($arrayViajes) + 1, $destino, $cantMaxPasajeros, $responsable1, $empresa, $costo);
            if ($otroViaje->insertar()) {
                $arrayViajes[] = $otroViaje;
                echo "Viaje correctamente insertado\n";
                $colViajes = $otroViaje->listar();
                foreach ($colViajes as $viaje) {
                    echo $viaje . "\n";
                }
            }
            break;
        case 4:
            $misViajes = new Viaje();
            $arrayViajes = $misViajes->listar();
            for ($i = 0; $i < count($arrayViajes); $i++) {
                echo "---------" . $i + 1 . "------------";
                echo $arrayViajes[$i];
                echo "\n";
            }
            echo "Seleccione cual viaje quiere cambiar: ";
            $seleccion = trim(fgets(STDIN)) - 1;
            $viajeSeleccionado = $arrayViajes[$seleccion];
            menuViaje();
            $opcionCambio = trim(fgets(STDIN));
            cambioViaje($opcionCambio, $viajeSeleccionado);;
            break;
        case 5:
            echo "Ingrese el numero de documento del responsable del viaje";
            $numDoc = trim(fgets(STDIN));
            $nuevoResponsable = new ResponsableV();
            $responsableYacargado = $nuevoResponsable->Buscar($numDoc);
            $nuevaPersona = new Persona();
            $personaYaCargada = $nuevaPersona->Buscar($numDoc);
            if ($personaYaCargada) {
                echo "Esa persona ya existe en la base de datos";
            } else if ($responsableYacargado) {
                echo "Ya se encuentra ese responsable";
            } else {
                echo "ingrese el nombre del responsable\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del responsable\n";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia\n";
                $numLice = trim(fgets(STDIN));
                $nuevaPersona->cargar($numDoc, $nombre, $apellido);
                $nuevoResponsable->cargar($numDoc, $nombre, $apellido, 2, $numLice);
                $nuevaPersona->insertar();
                $nuevoResponsable->insertar();
                echo "Responsable cargado en la base de datos";
            };
            break;
        case 6:
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            for ($i = 0; $i < count($arrResponsable); $i++) {
                echo "---------" . $i + 1 . "------------";
                echo $arrResponsable[$i];
                echo "\n";
            }
            echo "Seleccione cual responsable quiere cambiar: ";
            $seleccion = trim(fgets(STDIN)) - 1;
            $responsableSeleccionado = $arrResponsable[$seleccion];
            menuResponsable();
            $opcionCambio=trim(fgets(STDIN));
            cambiarResponsable($responsableSeleccionado,$opcionCambio);
            ;break;
        case 7:
            echo "Desea cambiar dirección o nombre de la empresa?: ";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 'direccion':
                    do {
                        echo "Ingrese nueva dirección: \n";
                        $direccion = trim(fgets(STDIN));
                        $empresa->setDireccion($direccion);
                        if ($empresa->modificar()) {
                            echo "Direccion modificada correctamente\n";
                            $estado = true;
                        } else {
                            echo "No se pudo modificar la dirección";
                        }
                    } while (!$estado);
                    break;
                case 'nombre':
                    do {
                        echo "Ingrese nuevo nombre: \n";
                        $nombre = trim(fgets(STDIN));
                        $empresa->setNombre($nombre);
                        if ($empresa->modificar()) {
                            echo "Nombre modificada correctamente\n";
                            $estado = true;
                        } else {
                            echo "No se pudo modificar el nombre";
                        }
                    } while (!$estado);
                    break;
                default:
                    break;
            }
            ;break;
        case 8:
            $col = $viaje->listar();
            foreach ($col as $viaje) {
                echo $viaje;
            }
            break;
        case 9:
            $losViajes = new Viaje();
            $arrayViajes = $losViajes->listar();
            for ($i = 0; $i < count($arrayViajes); $i++) {
                echo "---------" . $i + 1 . "------------";
                echo $arrayViajes[$i];
                echo "\n";
            }
            echo "Seleccione cual viaje quiere eliminar: ";
            $seleccion = trim(fgets(STDIN)) - 1;
            $viajeSeleccionado = $arrayViajes[$seleccion];
            if ($viajeSeleccionado->eliminar()) {
                unset($arrayViajes[$seleccion]);
                echo "Viaje eliminado\n";
                for ($i = 0; $i < count($arrayViajes); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrayViajes[$i];
                    echo "\n";
                }
            } else {
                echo "Hubo un error eliminando el viaje\n";
            };
            break;
        case 10:
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            for ($i = 0; $i < count($arrResponsable); $i++) {
                echo "---------" . $i + 1 . "------------";
                echo $arrResponsable[$i];
                echo "\n";
            }
            echo "Seleccione cual responsable quiere cambiar: ";
            $seleccion = trim(fgets(STDIN)) - 1;
            $responsableSeleccionado = $arrResponsable[$seleccion];
            $responsableSeleccionado->eliminar();
            if ($responsableSeleccionado->eliminar()) {
                unset($arrResponsable[$seleccion]);
                echo "Responsable eliminado\n";
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                }
            } else {
                echo "Hubo un error eliminando el responsable\n";
            }
        case 11:
            $lasEmpresas = new Empresa();
            $arrEmpresas = $lasEmpresas->listar();
            for ($i = 0; $i < count($arrEmpresas); $i++) {
                echo "---------" . $i + 1 . "------------";
                echo $arrEmpresas[$i];
                echo "\n";
            }
            echo "Seleccione cual responsable quiere cambiar: ";
            $seleccion = trim(fgets(STDIN)) - 1;
            $empresaSeleccionada = $arrEmpresas[$seleccion];
            if ($empresaSeleccionada->eliminar()) {
                unset($arrEmpresas[$seleccion]);
                echo "Empresa eliminada\n";
                for ($i = 0; $i < count($arrEmpresas); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrEmpresas[$i];
                    echo "\n";
                }
            } else {
                echo "Hubo un error eliminando la empresa\n";
            };
            break;
        default:
            echo "\nOpcion Invalida";
            break;
    }
    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');
