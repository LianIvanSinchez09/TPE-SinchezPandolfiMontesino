<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/Empresa.php";
include_once "../Clases/Viaje.php";
include_once "../Clases/BaseDatos.php";
include_once "../Clases/Pasajero.php";

// si no tiene cargado a la persona antes de cargarlo en responsable,
// $res = new Persona();
// $res1 = new ResponsableV();
// $res->cargar(44323057, "Lian", "Sinchez");
// $res1->cargar(44323057, "Lian", "Sinchez", 22, 22);
// $respuesta = $res->insertar();
// $respuesta1 = $res1->insertar();

// prueba con empresa
// $emp = new Empresa();
// $emp->cargar(1, "koko", "Neuquen Capital");
// $respuesta2 = $emp->insertar();

// prueba con viaje 
// $viaje = new Viaje();
// $viaje->cargar(1, "Cipolletti", 20, $res1, $emp, 1000);
// $respuesta3 = $viaje->insertar();

// if ($respuesta) {
//     echo "\nFuncionando\n";
// } else {
//     echo "\nNo funciona :(\n";
// }

// $persona2 = new Persona();
// $persona2->cargar(34534534, "Francisco", "Pandolfi");
// $persona2->insertar();

// $pasajero = new Pasajero(); 
// $pasajero->cargar(34534534, "Francisco", "Pandolfi", 1, $viaje, 2995920034);
// $pasajero->insertar();

// echo "\nClase Persona 1";
// echo $res;
// echo "\nClase Persona 2";
// echo $persona2;
// echo "\nClase Persona Responsable";
// echo $res1;
// echo "\nClase Empresa";
// echo $emp;
// echo "\nClase Viaje";
// echo $viaje;
// echo "\nClase Pasajero";
// echo $pasajero;

// $pasajero->setTelefono("2995551234");

// if ($pasajero->modificar()) {
//     echo "\nDatos del pasajero modificados correctamente.\n";
// } else {
//     echo "\nError al modificar los datos del pasajero: " . $pasajero->getMensajeoperacion() . "\n";
// }

// echo "\nClase Pasajero modificada";
// echo $pasajero;

//-------------------------Metodos a utilizar-----------------------------------------

/**
 * menu de opciones para hacer el test
 * @return string
 */
function menu()
{
    echo"\nIngrese 1: Para ingresar un pasajero" . 
        "\nIngrese 2: Para modificar datos del pasajero".
        "\nIngrese 3: Para modificar datos del viaje".
        "\nIngrese 4: Para modificar datos del responsable en realizar el viaje".
        "\nIngrese 5: Para ver los datos del viaje\n";
}

/**
 * menu de opciones para el cambio segun el tipo de pasajero
 * @param String
 * @return String
 */
function menuCambio($tipo){
    switch($tipo){
        case "comun":
            menuGeneral();break;
        case "vip":
            menuGeneral();
            echo "Ingrese (frecuencia): Para cambiar la frecuencia de viajes del pasajero".
            "\nIngrese (millas): Para cambiar la cantidad de millas recorridas del pasajero\n";break;
        case "especial":
            menuGeneral();
            echo "Ingrese (necesidad): Para cambiar la necesidad del pasajero\n";break;
    }
}

/**
 * menu general para preguntar el tipo de cambio
 * @return String
 */
function menuGeneral(){
    echo "que quiere cambiar?\n";
    echo "Ingrese (nombre): Para cambiar el nombre del pasajero" .
         "\nIngrese (apellido): Para cambiar el apellido del pasajero" .
         "\nIngrese (telefono): Para cambiar el telefono del pasajero".
         "\nIngrese (asiento): Para cambiar el numero de asiento".
         "\nIngrese (todo): Para cambiar toda la informacion de un pasajero\n";
}

/**
 * Cambia los datos que comparten todos los pasajero
 * @param string
 * @param Viaje
 * @param int
 * @return boolean
 */
function cambiarDato($opcionCambio,$unViaje,$dniPasajero){
    $estado=false;
    switch ($opcionCambio) {
        case "nombre":
            do {
                echo "ingrese otro nombre\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
                if ($cumple) {
                    echo "nombre cambiado";
                    $estado = true;
                } else {
                    echo "el nombre tiene que ser diferente\n";
                }
            } while (!$estado)
            ;break;

        case "apellido":
            do {
                echo "ingrese otro apellido\n";
                $otroDato = trim(fgets(STDIN));
                if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
                    echo "apellido cambiado";
                    $estado = true;
                } else {
                    echo "el apellido tiene que ser diferente\n";
                }
            } while (!$estado);
            break;

        case "telefono":
            do {
                echo "ingrese otro telefono\n";
                $otroDato = trim(fgets(STDIN));
                if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
                    echo "telefono cambiado";
                    $estado = true;
                } else {
                    echo "el telefono tiene que ser diferente\n";
                }
            } while (!$estado);;
            break;
        case "asiento":
            do {
                echo "ingrese otro asiento\n";
                $otroDato = trim(fgets(STDIN));
                if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
                    echo "asiento cambiado";
                    $estado = true;
                } else {
                    echo "el asiento tiene que ser diferente\n";
                }
            } while (!$estado);;
            break;
    }
    return $estado;
}
//--------------------------------------------------------------------------


echo "\nInformacion del viaje: \n";
echo "Ingrese el codigo\n";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino\n";
$destino = trim(fgets(STDIN));
echo "Ingrese la cantidad maxima de pasajeros\n";
$cantMaxPasajeros = trim(fgets(STDIN));
$colPasajero = array(); //la coleccion de pasajeros va a iniciar sin datos
echo "Ingrese el costo del viaje";
$costo=trim(fgets(STDIN));

echo "Informacion del responsable se ese viaje: \n";
echo "Ingrese el numero de empleado\n";
$numEmpleado= trim(fgets(STDIN));
echo "Ingrese el numero de licencia\n";
$numLicencia= trim(fgets(STDIN));
echo "Ingrese el nombre del empleado\n";
$nombreEmpleado= trim(fgets(STDIN));
echo "Ingrese el apellido del empleado\n";
$apellidoEmpleado= trim(fgets(STDIN));

$unResponsableV= new ResponsableV($numEmpleado,$numLicencia,$nombreEmpleado,$apellidoEmpleado);
$unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $colPasajero,$unResponsableV,$costo,0);

$i=0;
do {
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            if ($unViaje->hayPasajesDisponibles()) {
                echo "ingrese el nombre del pasajero\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del pasajero\n";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el numero de documento del pasajero\n";
                $numDoc = trim(fgets(STDIN));

                $pasajeroEncontrado = $unViaje->verificarViajaPasajero($numDoc);

                if ($pasajeroEncontrado) {
                    echo "Ya se encuentra en ese viaje";

                } else {
                    echo "ingrese el numero de telefono del pasajero\n";
                    $numTele = trim(fgets(STDIN));
                    echo "ingrese su numero de asiento\n";
                    $numAsiento = trim(fgets(STDIN));
                    $numTicket = random_int(1, 1000);

                    echo "Es un pasajero comun, vip o especial?\n";
                    $tipo = trim(fgets(STDIN));

                    switch ($tipo) {
                        case "comun":
                            $unPasajero = new PasajeroComun($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket);
                            break;
                        case "vip":
                            echo "Ingrese el numero de viajes frecuentes\n";
                            $nroViajesFrecuentes = trim(fgets(STDIN));
                            echo "Ingrese la cantidad de millas\n";
                            $cantMillas = trim(fgets(STDIN));
                            $unPasajero = new PasajeroVIP($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $nroViajesFrecuentes, $cantMillas);
                            break;
                        case "especial":
                            echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
                            "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
                            "Si necesita mas de uno, ingrese todo\n";
                            $necesidad = trim(fgets(STDIN));
                            $unPasajero = new PasajerosEspeciales($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $necesidad);
                            break;
                    }
                    $debePagar = $unViaje->venderPasaje($unPasajero);
                    echo "El pasajero debe pagar por el viaje: $" . $debePagar;
                    $arrPasajeros[$i]=$unPasajero;
                    $i++;
                }
            } else {
                echo "El cupo de pasajeros ya se encuentra lleno";
            };
            break;

        case 2:
            if(count($unViaje->getColPasajeros())==0){
                echo "no se ingresaron ningun pasajero";
            }else{
                echo "ingrese el documento del pasajero a cambiar\n";
                $dniPasajero=trim(fgets(STDIN));
                $posPasajero=$unViaje->buscarPosPasajero($dniPasajero);
                
                if($posPasajero!=-1){
                    echo "De que tipo es su pasajero?\ncomun,vip o especial\n";
                    $tipo = trim(fgets(STDIN));
                    menuCambio($tipo);
                    $opcionCambio = trim(fgets(STDIN));
                    switch ($tipo) {
                        case "comun":
                            $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
                            if(!$estado){
                                echo "ingrese el nombre del pasajero\n";
                                $nombre = trim(fgets(STDIN));
                                echo "ingrese el apellido del pasajero\n";
                                $apellido = trim(fgets(STDIN));
                                echo "ingrese el numero de telefono del pasajero\n";
                                $numTele=trim(fgets(STDIN));
                                echo "ingrese su numero de asiento\n";
                                $numAsiento = trim(fgets(STDIN));
                                $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
                                $unPasajero = new PasajeroComun($nombre, $apellido, $dniPasajero,$numTele,$numAsiento,$numTicket);
                                $arrPasajeros[$posPasajero]=$unPasajero;
                                $unViaje->setColPasajeros($arrPasajeros);
                                ;break;
                            }
                            ;break;

                        case "vip":
                                $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
                                if (!$estado) {
                                    switch($opcionCambio){
                                        case "frecuencia":
                                            do {
                                                echo "ingrese otra cantidad de viajes frecuentes\n";
                                                $otroDato = trim(fgets(STDIN));
                                                $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
                                                if ($cumple) {
                                                    echo "frecuencia cambiado";
                                                    $estado = true;
                                                } else {
                                                    echo "la cantidad tiene que ser diferente\n";
                                                }
                                            } while (!$estado)
                                            ;break;

                                        case "millas":
                                            do {
                                                echo "ingrese otra cantidad de millas\n";
                                                $otroDato = trim(fgets(STDIN));
                                                $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
                                                if ($cumple) {
                                                    echo "cantidad cambiado";
                                                    $estado = true;
                                                }else {
                                                    echo "la cantidad tiene que ser diferente\n";
                                                }
                                            } while (!$estado)    
                                            ;break;

                                        case "todo":
                                            echo "ingrese el nombre del pasajero\n";
                                            $nombre = trim(fgets(STDIN));
                                            echo "ingrese el apellido del pasajero\n";
                                            $apellido = trim(fgets(STDIN));
                                            echo "ingrese el numero de telefono del pasajero\n";
                                            $numTele=trim(fgets(STDIN));
                                            echo "ingrese su numero de asiento\n";
                                            $numAsiento = trim(fgets(STDIN));
                                            $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
                                            echo "Ingrese el numero de viajes frecuentes\n";
                                            $nroViajesFrecuentes = trim(fgets(STDIN));
                                            echo "Ingrese la cantidad de millas\n";
                                            $cantMillas = trim(fgets(STDIN));
                                            $unPasajero = new PasajeroVIP($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $nroViajesFrecuentes, $cantMillas);   
                                            $arrPasajeros[$posPasajero]=$unPasajero;
                                            $unViaje->setColPasajeros($arrPasajeros)
                                            ;break;
                                    }
                                }
                            ;break;
                        case "especial":
                            $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
                            if (!$estado) {
                                if(strcmp($opcionCambio, "necesidad") == 0){
                                    do {
                                        echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
                                        "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
                                        "Si necesita mas de uno, ingrese todo\n";
                                        $otroDato = trim(fgets(STDIN));
                                        $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
                                        if ($cumple) {
                                            echo "necesidad cambiada";
                                            $estado = true;
                                        } else {
                                            echo "la necesidad tiene que ser diferente\n";
                                        }
                                    } while (!$estado);
                                }else{
                                    echo "ingrese el nombre del pasajero\n";
                                    $nombre = trim(fgets(STDIN));
                                    echo "ingrese el apellido del pasajero\n";
                                    $apellido = trim(fgets(STDIN));
                                    echo "ingrese el numero de telefono del pasajero\n";
                                    $numTele=trim(fgets(STDIN));
                                    echo "ingrese su numero de asiento\n";
                                    $numAsiento = trim(fgets(STDIN));
                                    $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
                                    echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
                                    "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
                                    "Si necesita mas de uno, ingrese todo\n";
                                    $necesidad = trim(fgets(STDIN));
                                    $unPasajero = new PasajerosEspeciales($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $necesidad);
                                    $arrPasajeros[$posPasajero]=$unPasajero;
                                    $unViaje->setColPasajeros($arrPasajeros);
                                }
                            }
                            ;break;
                    }
                } else {
                    echo "no existe ese pasajero";
                }
            };break;
        
        case 3:
            echo "que quiere cambiar?\n";
            echo "Ingrese (codigo): Para cambiar el codigo del viaje" .
            "\nIngrese (destino): Para cambiar el destino del viaje" .
            "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
            "\nIngrese (costo): Para cambiar el costo del viaje".
            "\nIngrese (abonado): PAra cambair el costo de abonados en el viaje".
            "\nIngrese (todo): Para cambiar toda la informacion del viaje\n";
            $opcionCambio = trim(fgets(STDIN));
            $estado=false;
            switch($opcionCambio){
                case 'codigo':
                    do{
                        echo "ingrese otro codigo\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;
                
                case "destino":
                        do{
                            echo "ingrese otro destino\n";
                            $otroDato=trim(fgets(STDIN));
                            if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                                echo "valor cambiado";
                                $estado=true;
                            }else{
                                echo "No se puede cambiar por el mismo valor\n";
                            }
                        }while(!$estado);break;

                case "maximo";
                    do{
                        echo "ingrese otra capacidad maxima de pasajeros\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;

                case "costo":
                    do{
                        echo "ingrese otro costo al viaje\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;
                
                case "abonado":
                    do{
                        echo "ingrese otro costo abonado\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;
                    
                case "todo":
                    echo "Ingrese otro codigo\n";
                    $codigo = trim(fgets(STDIN));
                    echo "Ingrese otro destino\n";
                    $destino = trim(fgets(STDIN));
                    echo "Ingrese otra cantidad maxima de pasajeros\n";
                    $cantMaxPasajeros = trim(fgets(STDIN));
                    $colPasajero = array();
                    echo "Ingrese otro costo del viaje\n";
                    $costo=trim(fgets(STDIN));
                    $unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $colPasajero,$unResponsableV,$costo,0);
                    ;break;
            }            
            ;break;
        
        case 4:
            echo "que quiere cambiar?\n";
            echo "Ingrese (numero): Para cambiar el numero del empleado" .
            "\nIngrese (licencia): Para cambiar la licencia del empleado" .
            "\nIngrese (nombre): Para cambiar el nombre del empleado" .
            "\nIngrese (apellido): Para cambiar el apellido del empleado" .
            "\nIngrese (todo): Para cambiar toda la informacion del empleado\n";
            $opcionCambio = trim(fgets(STDIN));
            switch($opcionCambio){
                case "numero":
                    do{
                        echo "ingrese otro numero\n";
                        $otroDato=trim(fgets(STDIN));
                        $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
                        if ($cumple) {
                            echo "numero cambiado";
                            $estado = true;
                        } else {
                            echo "el numero tiene que ser diferente\n";
                        }
                    }while(!$cumple)
                    ;break;

                case "licencia":
                    do{
                        echo "ingrese otro numero de licencia\n";
                        $otroDato=trim(fgets(STDIN));
                        $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
                        if ($cumple) {
                            echo "licencia cambiado";
                            $estado = true;
                        } else {
                            echo "la licencia tiene que ser diferente\n";
                        }        
                    }while(!$cumple)
                    ;break;

                case "nombre":
                    do{
                        echo "ingrese otro nombre\n";
                        $otroDato=trim(fgets(STDIN));
                        $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
                        if ($cumple) {
                            echo "nombre cambiado";
                            $estado = true;
                        } else {
                            echo "el nombre tiene que ser diferente\n";
                        }        
                    }while(!$cumple)
                    ;break;

                case "apellido":
                    do{
                        echo "ingrese otro apellido\n";
                        $otroDato=trim(fgets(STDIN));
                        $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
                        if ($cumple) {
                            echo "apellido cambiado";
                            $estado = true;
                        } else {
                            echo "el apellido tiene que ser diferente\n";
                        }        
                    }while(!$cumple)
                    ;break;

                case "todo":
                    echo "Ingrese el numero de empleado\n";
                    $numEmpleado = trim(fgets(STDIN));
                    echo "Ingrese el numero de licencia\n";
                    $numLicencia = trim(fgets(STDIN));
                    echo "Ingrese el nombre del empleado\n";
                    $nombreEmpleado = trim(fgets(STDIN));
                    echo "Ingrese el apellido del empleado\n";
                    $apellidoEmpleado = trim(fgets(STDIN));
                    $unResponsableV = new ResponsableV($numEmpleado, $numLicencia, $nombreEmpleado, $apellidoEmpleado);
                    $unViaje->setResponsableV($unResponsableV)
                    ;break;
                }            
            ;break;

        case 5:
            echo $unViaje->__toString()
            ;break;        
    }

    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');




?>
