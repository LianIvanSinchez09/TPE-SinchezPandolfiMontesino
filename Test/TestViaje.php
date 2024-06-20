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
    "\nIngrese 2: Para ingresar un viaje" .
    "\nIngrese 3: Para ingresar al responsable del viaje" .
    "\nIngrese 4: Para modificar datos del pasajero" .
    "\nIngrese 5: Para modificar un viaje" .
    "\nIngrese 6: Para modificar un responsable del viaje" .
    "\nIngrese 7: Para modificar la empresa" .
    "\nIngrese 8: Eliminar viaje" .
    "\nIngrese 9: Eliminar responsable" .
    "\nIngrese 10: Eliminar empresa" .
    "\nIngrese 11: Eliminar pasajero" .
    "\nIngrese 12: Mostrar pasajeros" .
    "\nIngrese 13: Mostrar detalles del viaje" .
    "\nIngrese 14: Mostrar responsables\n";
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

//---------------CARGA DE OBJETOS PRINCIPALES-----------------------------------------
$empresa = new Empresa();
if($empresa->listar()==null){
    $empresa->cargar(1, "Viaje Feliz", "Buenos Aires 1800");
    $empresa->insertar();
}
//---------------------------------------------------------------------------
$arrayViajes = array();
$viaje= new Viaje();
do {
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1:
            $colViajes = $viaje->listar();
            if($colViajes==null){
                echo "No hay ningun viaje cargado";
            }else{
                foreach ($colViajes as $viaje) {
                    echo $viaje . "\n";
                }
                echo "A cual viaje desea ir (id): \n";
                $idOpcViaje = trim(fgets(STDIN));
                if ($viaje->hayPasajesDisponibles($idOpcViaje)) {
                    echo "Hay pasajes disponibles\n";
                    echo "ingrese el nombre del pasajero\n";
                    $nombre = trim(fgets(STDIN));
                    echo "ingrese el apellido del pasajero\n";
                    $apellido = trim(fgets(STDIN));
                    echo "ingrese el numero de documento del pasajero\n";
                    $numDoc = trim(fgets(STDIN));
    
                    $nuevoPasajero = new Pasajero();
                    $pasajeroYacargado = $nuevoPasajero->Buscar($numDoc);

                    if ($pasajeroYacargado) {
                        echo "Ya se encuentra en ese viaje";
                    } else {
                        echo "ingrese el numero de telefono del pasajero\n";
                        $numTele = trim(fgets(STDIN));

                        $nuevoPasajero->cargar($numDoc, $nombre, $apellido, $viaje, $numTele);
                        $nuevoPasajero->insertar();
                        echo "Pasajero cargado en la base de datos";
                    }
                } else {
                    echo "No disponible";
                }
            };
            break;
        case 2:
            
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            if($arrResponsable==null){
                echo "No hay ningun responsable cargado para cargar un nuevo viaje";
            }else{
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                }
                echo "Seleccione cual responsable quiere que tenga el viaje: ";
                $seleccion = trim(fgets(STDIN)) - 1;
                $responsableSeleccionado = $arrResponsable[$seleccion];
                echo "Ingrese destino: \n";
                $destino = trim(fgets(STDIN));
                echo "Cantidad maxima de pasajeros: \n";
                $cantMaxPasajeros = trim(fgets(STDIN));
                $otroViaje = new Viaje();
                echo "Ingrese coste del viaje: ";
                $costo = trim(fgets(STDIN));
                $misEmpresas=new Empresa();
                $colEmpre=$misEmpresas->listar();
                $laEmpresa=$colEmpre[0];
                $otroViaje->cargar(count($arrayViajes) + 1, $destino, $cantMaxPasajeros, $responsableSeleccionado, $laEmpresa, $costo);
                if ($otroViaje->insertar()) {
                    $arrayViajes[] = $otroViaje;
                    echo "Viaje correctamente insertado\n";
                    $colViajes = $otroViaje->listar();
                    foreach ($colViajes as $viaje) {
                        echo $viaje . "\n";
                    }
                }
            }
            ;break;
        case 3:
            echo "Ingrese el numero de documento del responsable del viaje\n";
            $numDoc = trim(fgets(STDIN));
            $nuevoResponsable = new ResponsableV();
            $responsableYacargado = $nuevoResponsable->Buscar($numDoc);
            
            
            if ($responsableYacargado) {
                echo "Ya se encuentra ese responsable\n";
            } else {
                echo "ingrese el nombre del responsable\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del responsable\n";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el numero de empleado\n";
                $numEmp = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia\n";
                $numLice = trim(fgets(STDIN));
                
                $nuevoResponsable->cargar($numDoc, $nombre, $apellido, $numEmp, $numLice);
                $nuevoResponsable->insertar();
                
                echo "Responsable cargado en la base de datos\n";
            };
            break;
        case 4:
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
        case 5:
            $misViajes = new Viaje();
            $arrayViajes = $misViajes->listar();
            if($arrayViajes==null){
                echo "No se hay cargado ningun viaje";
            }else{
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
                cambioViaje($opcionCambio, $viajeSeleccionado);
            }
            ;break;
        case 6:
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            if($arrResponsable==null){
                echo "No hay ningun responsable cargado\n";
            }else{
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                }
                echo "Seleccione cual responsable quiere cambiar: \n";
                $seleccion = trim(fgets(STDIN)) - 1;
                $responsableSeleccionado = $arrResponsable[$seleccion];
                menuResponsable();
                $opcionCambio = trim(fgets(STDIN));
                cambiarResponsable($responsableSeleccionado, $opcionCambio);
            }
            ;break;
        case 7:
            $emp = new Empresa();
            echo $emp->listar()[0] . "\n";
            echo "Desea cambiar dirección o nombre de la empresa?: \n";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 'direccion':
                    do {
                        $emp = new Empresa();
                        $empresa = $emp->listar()[0];
                        echo "Ingrese nueva dirección: \n";
                        $direccion = trim(fgets(STDIN));
                        $empresa->setDireccion($direccion);
                        if ($empresa->modificar()) {
                            echo "Direccion modificada correctamente\n";
                            echo $emp->listar()[0] . "\n";
                            $estado = true;
                        } else {
                            echo $emp->listar()[0] . "\n";
                            echo "No se pudo modificar la dirección\n";
                        }
                    } while (!$estado);
                    break;
                case 'nombre':
                    do {
                        echo "Ingrese nuevo nombre: \n";
                        $nombre = trim(fgets(STDIN));
                        $empresa->setNombre($nombre);
                        if ($empresa->modificar()) {
                            echo $emp->listar()[0] . "\n";
                            echo "Nombre modificada correctamente\n";
                            $estado = true;
                        } else {
                            echo $emp->listar()[0] . "\n";
                            echo "No se pudo modificar el nombre\n";
                        }
                    } while (!$estado);
                    break;
            };
            break;
        case 8:
            $losViajes = new Viaje();
            $arrayViajes = $losViajes->listar();
            if(count($arrayViajes) > 0){
                for ($i = 0; $i < count($arrayViajes); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrayViajes[$i];
                    echo "\n";
                }
                echo "Seleccione cual viaje quiere eliminar: ";
                $seleccion = trim(fgets(STDIN)) - 1;
                $viajeSeleccionado = $arrayViajes[$seleccion];
                if ($viajeSeleccionado->eliminar()) {
                    $col = $viaje->listar();
                    foreach ($col as $viaje) {
                        echo $viaje;
                    }
                    echo "Viaje correctamente borrado\n";
                } else {
                    echo "Hubo un error eliminando el viaje\n";
                };
            }else{
                echo "No hay viajes disponibles\n";
            }
            break;
        case 9:
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            if($arrResponsable==null){
                echo "no hay ningun responsable\n";
            }else{
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                }
                echo "Seleccione cual responsable quiere cambiar: ";
                $seleccion = trim(fgets(STDIN)) - 1;
                $responsableSeleccionado = $arrResponsable[$seleccion];
                
                echo "Seguro que quiere hacerlo, esta informacion puede ser cambiar en otros lados\nIngrese s/n para continuar";
                $rePregunta=trim(fgets(STDIN));
                if($rePregunta=='s'){    

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
                }else{
                    echo "la eliminacion se a parado";
                }
            }
        ;break;
        case 10:
            $lasEmpresas = new Empresa();
            $arrEmpresas = $lasEmpresas->listar();
            if($arrEmpresas==null){
                echo "La empresa ya fue eliminada";
            }else{
                for ($i = 0; $i < count($arrEmpresas); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrEmpresas[$i];
                    echo "\n";
                }
                echo "Seleccione cual empresa quiere eliminar: ";
                $seleccion = trim(fgets(STDIN)) - 1;
                $empresaSeleccionada = $arrEmpresas[$seleccion];

                echo "Seguro que quiere hacerlo, esta informacion puede ser cambiar en otros lados\nIngrese s/n para continuar";
                $rePregunta=trim(fgets(STDIN));
                if($rePregunta=='s'){
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
                    }
                }else{
                    echo "la eliminacion se a parado";
                }
            }
            ;break;
        case 11: 
            $losPasajeros = new Pasajero();
            $arrayPasajeros = $losPasajeros->listar();
            if($arrayPasajeros==null){
                echo "no hay passajeros cargados";
            }else{
                for ($i = 0; $i < count($arrayPasajeros); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrayPasajeros[$i];
                    echo "\n";
                }
                echo "Seleccione cual pasajero quiere eliminar: ";
                $seleccion = trim(fgets(STDIN)) - 1;
                $pasajeroSeleccionada = $arrayPasajeros[$seleccion];
                
                echo "Seguro que quiere hacerlo, esta informacion puede ser cambiar en otros lados\nIngrese s/n para continuar";
                $rePregunta=trim(fgets(STDIN));
                if($rePregunta=='s'){
                    if ($pasajeroSeleccionada->eliminar()) {
                        unset($arrayPasajeros[$seleccion]);
                        echo "Pasajero eliminado\n";
                        for ($i = 0; $i < count($arrayPasajeros); $i++) {
                            echo "---------" . $i + 1 . "------------";
                            echo $arrayPasajeros[$i];
                            echo "\n";
                        }
                    } else {
                        echo "Hubo un error eliminando al pasajero\n";
                    }
                }else{
                    echo "la eliminacion se a parado";
                }
                
            };
            break;
        case 12:
            $losPasajeros = new Pasajero();
            $arrayPas = $losPasajeros->listar();
            if(count($arrayPas) != 0){
                for ($i = 0; $i < count($arrayPas); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrayPas[$i];
                    echo "\n";
                };
            }else{
                echo "No hay pasajeros\n";
            }
            break;
        case 13:
            $col = $viaje->listar();
            if(count($col) > 0){
                foreach ($col as $viaje) {
                    echo $viaje;
                }
            }else{
                echo "No hay viajes disponibles\n";
            }
            break;
        case 14:
            $losResponsables = new ResponsableV();
            $arrResponsable = $losResponsables->listar();
            if(count($arrResponsable) != 0){
                for ($i = 0; $i < count($arrResponsable); $i++) {
                    echo "---------" . $i + 1 . "------------";
                    echo $arrResponsable[$i];
                    echo "\n";
                };
            }else{
                echo "No hay responsables que mostrar\n";
            }
        break;
        default:
            echo "\nOpcion Invalida";
            break;
    }
    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');
