<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/Empresa.php";
include_once "../Clases/Viaje.php";
include_once "../Clases/BaseDatos.php";
include_once "../Clases/Pasajero.php";

// si no tiene cargado a la persona antes de cargarlo en responsable,
$res = new Persona();
$res1 = new ResponsableV();
$res->cargar(44323057, "Lian", "Sinchez");
$res1->cargar(44323057, "Lian", "Sinchez", 22, 22);
$respuesta = $res->insertar();
$respuesta1 = $res1->insertar();

// prueba con empresa
$emp = new Empresa();
$emp->cargar(1, "koko", "Neuquen Capital");
$respuesta2 = $emp->insertar();

// prueba con viaje 
$viaje = new Viaje();
$viaje->cargar(1, "Cipolletti", 20, $res1, $emp, 1000);
$viaje->insertar();

$persona2 = new Persona();
$persona2->cargar(34534534, "Francisco", "Pandolfi");
$persona2->insertar();

$pasajero = new Pasajero(); 
$pasajero->cargar(34534534, "Francisco", "Pandolfi", 1, $viaje, 2995920034);
$pasajero->insertar();

/*echo "\nClase Persona 1";
echo $res;
echo "\nClase Persona 2";
echo $persona2;
echo "\nClase Persona Responsable";
echo $res1;
echo "\nClase Empresa";
echo $emp;
echo "\nClase Viaje";
echo $viaje;
echo "\nClase Pasajero";
echo $pasajero;

$pasajero->setTelefono("2995551234");

if ($pasajero->modificar()) {
    echo "\nDatos del pasajero modificados correctamente.\n";
} else {
    echo "\nError al modificar los datos del pasajero: " . $pasajero->getMensajeoperacion() . "\n";
}

echo "\nClase Pasajero modificada";
echo $pasajero;

if($pasajero->hayPasajesDisponibles()){
    echo "Hay pasajes disponibles";
}else{
    echo "No disponible";
}*/

//<-------------------------ACA ESTA--------------------->
/**
 * menu de opciones para hacer el test
 * @return string
 */
function menu(){
    echo"\nIngrese 1: Para ingresar un pasajero" . 
        "\nIngrese 2: Para modificar datos del pasajero".
        "\nIngrese 3: Para ingresar un viaje".
        "\nIngrese 4: Para modificar datos del viaje".
        "\nIngrese 5: Para ingresar a un responsable en realizar el viaje".
        "\nIngrese 6: Para modificar datos del responsable en realizar el viaje".
        "\nIngrese 7: Para ver los datos del viaje\n";
}

<<<<<<< HEAD

$emp->setDireccion("Neuquen");

if($emp->modificar()){
    echo "Datos de empresa cambiados correctamente";
}else{
    echo "Cambios no hechos";
}

print_r($emp->listar());

$res1->setdocumento(44323053);
$res1->setNumEmpleado(25);

if($res1->modificar()){
    echo "Datos de res cambiados correctamente";
}else{
    echo "Cambios no hechos";
}

print_r($viaje->Buscar(1));


// -------------------------Metodos a utilizar-----------------------------------------

// /**
//  * menu de opciones para hacer el test
//  * @return string
//  */
// function menu()
// {
//     echo"\nIngrese 1: Para ingresar un pasajero" . 
//         "\nIngrese 2: Para modificar datos del pasajero".
//         "\nIngrese 3: Para modificar datos del viaje".
//         "\nIngrese 4: Para modificar datos del responsable en realizar el viaje".
//         "\nIngrese 5: Para ver los datos del viaje\n";
// }


// /**
//  * menu general para preguntar el tipo de cambio
//  * @return String
//  */
// function menuGeneral(){
//     echo "que quiere cambiar?\n";
//     echo "Ingrese (nombre): Para cambiar el nombre del pasajero" .
//          "\nIngrese (apellido): Para cambiar el apellido del pasajero" .
//          "\nIngrese (telefono): Para cambiar el telefono del pasajero".
//          "\nIngrese (asiento): Para cambiar el numero de asiento".
//          "\nIngrese (todo): Para cambiar toda la informacion de un pasajero\n";
// }

// /**
//  * Cambia los datos que comparten todos los pasajero
//  * @param string
//  * @param Viaje
//  * @param int
//  * @return boolean
//  */
// function cambiarDato($opcionCambio,$unViaje,$dniPasajero){
//     $estado=false;
//     switch ($opcionCambio) {
//         case "nombre":
//             do {
//                 echo "ingrese otro nombre\n";
//                 $otroDato = trim(fgets(STDIN));
//                 $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
//                 if ($cumple) {
//                     echo "nombre cambiado";
//                     $estado = true;
//                 } else {
//                     echo "el nombre tiene que ser diferente\n";
//                 }
//             } while (!$estado);
//         break;

//         case "apellido":
//             do {
//                 echo "ingrese otro apellido\n";
//                 $otroDato = trim(fgets(STDIN));
//                 if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
//                     echo "apellido cambiado";
//                     $estado = true;
//                 } else {
//                     echo "el apellido tiene que ser diferente\n";
//                 }
//             } while (!$estado);
//             break;

//         case "telefono":
//             do {
//                 echo "ingrese otro telefono\n";
//                 $otroDato = trim(fgets(STDIN));
//                 if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
//                     echo "telefono cambiado";
//                     $estado = true;
//                 } else {
//                     echo "el telefono tiene que ser diferente\n";
//                 }
//             } while (!$estado);;
//             break;
//         case "asiento":
//             do {
//                 echo "ingrese otro asiento\n";
//                 $otroDato = trim(fgets(STDIN));
//                 if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
//                     echo "asiento cambiado";
//                     $estado = true;
//                 } else {
//                     echo "el asiento tiene que ser diferente\n";
//                 }
//             } while (!$estado);;
//             break;
//     }
//     return $estado;
// }
// --------------------------------------------------------------------------


// echo "\nInformacion del viaje: \n";
// echo "Ingrese el codigo\n";
// $idViaje = trim(fgets(STDIN));
// echo "Ingrese el destino\n";
// $destino = trim(fgets(STDIN));
// echo "Ingrese la cantidad maxima de pasajeros\n";
// $cantMaxPasajeros = trim(fgets(STDIN));
// echo "Ingrese el importe del viaje";
// $importe=trim(fgets(STDIN));

// echo "Informacion del responsable se ese viaje: \n";
// echo "Ingrese el numero de empleado\n";
// $numEmpleado= trim(fgets(STDIN));
// echo "Ingrese el numero de licencia\n";
// $numLicencia= trim(fgets(STDIN));
// echo "Ingrese el nombre del empleado\n";
// $nombreEmpleado= trim(fgets(STDIN));
// echo "Ingrese el apellido del empleado\n";
// $apellidoEmpleado= trim(fgets(STDIN));
// echo "Ingrese el DNI del empleado\n";
// $dniEmp = trim(fgets(STDIN));

// //CREAR PASAJERO PRIMERO ASI SE PUEDE CONSULTAR LA CANTIDAD DE PASAJEROS
// $unResponsableV= new ResponsableV($dniEmp,$nombreEmpleado,$apellidoEmpleado,$numEmpleado, $numLicencia);
// $unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros,$unResponsableV,$importe);

// $i=0;
// do {
//     echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
//     menu();
//     $opcion = trim(fgets(STDIN));

//     switch ($opcion) {
//         case 1:
//             if ($unViaje->hayPasajesDisponibles()) {
//                 echo "ingrese el nombre del pasajero\n";
//                 $nombre = trim(fgets(STDIN));
//                 echo "ingrese el apellido del pasajero\n";
//                 $apellido = trim(fgets(STDIN));
//                 echo "ingrese el numero de documento del pasajero\n";
//                 $numDoc = trim(fgets(STDIN));
//                 $pasajeroEncontrado = $unViaje->verificarViajaPasajero($numDoc);

//                 if ($pasajeroEncontrado) {
//                     echo "Ya se encuentra en ese viaje";

//                 } else {
//                     echo "ingrese el numero de telefono del pasajero\n";
//                     $numTele = trim(fgets(STDIN));
//                     echo "ingrese su numero de asiento\n";
//                     $numAsiento = trim(fgets(STDIN));
//                     $numTicket = random_int(1, 1000);

//                     echo "Es un pasajero comun, vip o especial?\n";
//                     $tipo = trim(fgets(STDIN));

//                     switch ($tipo) {
//                         case "comun":
//                             $unPasajero = new PasajeroComun($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket);
//                             break;
//                         case "vip":
//                             echo "Ingrese el numero de viajes frecuentes\n";
//                             $nroViajesFrecuentes = trim(fgets(STDIN));
//                             echo "Ingrese la cantidad de millas\n";
//                             $cantMillas = trim(fgets(STDIN));
//                             $unPasajero = new PasajeroVIP($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $nroViajesFrecuentes, $cantMillas);
//                             break;
//                         case "especial":
//                             echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
//                             "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
//                             "Si necesita mas de uno, ingrese todo\n";
//                             $necesidad = trim(fgets(STDIN));
//                             $unPasajero = new PasajerosEspeciales($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $necesidad);
//                             break;
//                     }
//                     $debePagar = $unViaje->venderPasaje($unPasajero);
//                     echo "El pasajero debe pagar por el viaje: $" . $debePagar;
//                     $arrPasajeros[$i]=$unPasajero;
//                     $i++;
//                 }
//             } else {
//                 echo "El cupo de pasajeros ya se encuentra lleno";
//             };
//             break;

//         case 2:
//             if(count($unViaje->getColPasajeros())==0){
//                 echo "no se ingresaron ningun pasajero";
//             }else{
//                 echo "ingrese el documento del pasajero a cambiar\n";
//                 $dniPasajero=trim(fgets(STDIN));
//                 $posPasajero=$unViaje->buscarPosPasajero($dniPasajero);
                
//                 if($posPasajero!=-1){
//                     echo "De que tipo es su pasajero?\ncomun,vip o especial\n";
//                     $tipo = trim(fgets(STDIN));
//                     menuCambio($tipo);
//                     $opcionCambio = trim(fgets(STDIN));
//                     switch ($tipo) {
//                         case "comun":
//                             $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
//                             if(!$estado){
//                                 echo "ingrese el nombre del pasajero\n";
//                                 $nombre = trim(fgets(STDIN));
//                                 echo "ingrese el apellido del pasajero\n";
//                                 $apellido = trim(fgets(STDIN));
//                                 echo "ingrese el numero de telefono del pasajero\n";
//                                 $numTele=trim(fgets(STDIN));
//                                 echo "ingrese su numero de asiento\n";
//                                 $numAsiento = trim(fgets(STDIN));
//                                 $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
//                                 $unPasajero = new PasajeroComun($nombre, $apellido, $dniPasajero,$numTele,$numAsiento,$numTicket);
//                                 $arrPasajeros[$posPasajero]=$unPasajero;
//                                 $unViaje->setColPasajeros($arrPasajeros);
//                                 ;break;
//                             }
//                             ;break;

//                         case "vip":
//                                 $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
//                                 if (!$estado) {
//                                     switch($opcionCambio){
//                                         case "frecuencia":
//                                             do {
//                                                 echo "ingrese otra cantidad de viajes frecuentes\n";
//                                                 $otroDato = trim(fgets(STDIN));
//                                                 $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
//                                                 if ($cumple) {
//                                                     echo "frecuencia cambiado";
//                                                     $estado = true;
//                                                 } else {
//                                                     echo "la cantidad tiene que ser diferente\n";
//                                                 }
//                                             } while (!$estado)
//                                             ;break;

//                                         case "millas":
//                                             do {
//                                                 echo "ingrese otra cantidad de millas\n";
//                                                 $otroDato = trim(fgets(STDIN));
//                                                 $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
//                                                 if ($cumple) {
//                                                     echo "cantidad cambiado";
//                                                     $estado = true;
//                                                 }else {
//                                                     echo "la cantidad tiene que ser diferente\n";
//                                                 }
//                                             } while (!$estado)    
//                                             ;break;

//                                         case "todo":
//                                             echo "ingrese el nombre del pasajero\n";
//                                             $nombre = trim(fgets(STDIN));
//                                             echo "ingrese el apellido del pasajero\n";
//                                             $apellido = trim(fgets(STDIN));
//                                             echo "ingrese el numero de telefono del pasajero\n";
//                                             $numTele=trim(fgets(STDIN));
//                                             echo "ingrese su numero de asiento\n";
//                                             $numAsiento = trim(fgets(STDIN));
//                                             $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
//                                             echo "Ingrese el numero de viajes frecuentes\n";
//                                             $nroViajesFrecuentes = trim(fgets(STDIN));
//                                             echo "Ingrese la cantidad de millas\n";
//                                             $cantMillas = trim(fgets(STDIN));
//                                             $unPasajero = new PasajeroVIP($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $nroViajesFrecuentes, $cantMillas);   
//                                             $arrPasajeros[$posPasajero]=$unPasajero;
//                                             $unViaje->setColPasajeros($arrPasajeros)
//                                             ;break;
//                                     }
//                                 }
//                             ;break;
//                         case "especial":
//                             $estado = cambiarDato($opcionCambio, $unViaje, $dniPasajero);
//                             if (!$estado) {
//                                 if(strcmp($opcionCambio, "necesidad") == 0){
//                                     do {
//                                         echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
//                                         "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
//                                         "Si necesita mas de uno, ingrese todo\n";
//                                         $otroDato = trim(fgets(STDIN));
//                                         $cumple = $unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero);
//                                         if ($cumple) {
//                                             echo "necesidad cambiada";
//                                             $estado = true;
//                                         } else {
//                                             echo "la necesidad tiene que ser diferente\n";
//                                         }
//                                     } while (!$estado);
//                                 }else{
//                                     echo "ingrese el nombre del pasajero\n";
//                                     $nombre = trim(fgets(STDIN));
//                                     echo "ingrese el apellido del pasajero\n";
//                                     $apellido = trim(fgets(STDIN));
//                                     echo "ingrese el numero de telefono del pasajero\n";
//                                     $numTele=trim(fgets(STDIN));
//                                     echo "ingrese su numero de asiento\n";
//                                     $numAsiento = trim(fgets(STDIN));
//                                     $numTicket=$unViaje->getColPasajeros()[$posPasajero]->getNroTicket();
//                                     echo "Para esas personas le podes ofrecer: sillas de ruedas, asistencia y comida especial\n" .
//                                     "Si necesita uno de esos servicios, ingrese el servicio a necesitar\n" .
//                                     "Si necesita mas de uno, ingrese todo\n";
//                                     $necesidad = trim(fgets(STDIN));
//                                     $unPasajero = new PasajerosEspeciales($nombre, $apellido, $numDoc, $numTele, $numAsiento, $numTicket, $necesidad);
//                                     $arrPasajeros[$posPasajero]=$unPasajero;
//                                     $unViaje->setColPasajeros($arrPasajeros);
//                                 }
//                             }
//                             ;break;
//                     }
//                 } else {
//                     echo "no existe ese pasajero";
//                 }
//             };break;
        
//         case 3:
//             echo "que quiere cambiar?\n";
//             echo "Ingrese (codigo): Para cambiar el codigo del viaje" .
//             "\nIngrese (destino): Para cambiar el destino del viaje" .
//             "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
//             "\nIngrese (importe): Para cambiar el importe del viaje".
//             "\nIngrese (abonado): PAra cambair el importe de abonados en el viaje".
//             "\nIngrese (todo): Para cambiar toda la informacion del viaje\n";
//             $opcionCambio = trim(fgets(STDIN));
//             $estado=false;
//             switch($opcionCambio){
//                 case 'codigo':
//                     do{
//                         echo "ingrese otro codigo\n";
//                         $otroDato=trim(fgets(STDIN));
//                         if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
//                             echo "valor cambiado";
//                             $estado=true;
//                         }else{
//                             echo "No se puede cambiar por el mismo valor\n";
//                         }
//                     }while(!$estado);break;
                
//                 case "destino":
//                         do{
//                             echo "ingrese otro destino\n";
//                             $otroDato=trim(fgets(STDIN));
//                             if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
//                                 echo "valor cambiado";
//                                 $estado=true;
//                             }else{
//                                 echo "No se puede cambiar por el mismo valor\n";
//                             }
//                         }while(!$estado);break;

//                 case "maximo";
//                     do{
//                         echo "ingrese otra capacidad maxima de pasajeros\n";
//                         $otroDato=trim(fgets(STDIN));
//                         if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
//                             echo "valor cambiado";
//                             $estado=true;
//                         }else{
//                             echo "No se puede cambiar por el mismo valor\n";
//                         }
//                     }while(!$estado);break;

//                 case "importe":
//                     do{
//                         echo "ingrese otro importe al viaje\n";
//                         $otroDato=trim(fgets(STDIN));
//                         if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
//                             echo "valor cambiado";
//                             $estado=true;
//                         }else{
//                             echo "No se puede cambiar por el mismo valor\n";
//                         }
//                     }while(!$estado);break;
                
//                 case "abonado":
//                     do{
//                         echo "ingrese otro importe abonado\n";
//                         $otroDato=trim(fgets(STDIN));
//                         if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
//                             echo "valor cambiado";
//                             $estado=true;
//                         }else{
//                             echo "No se puede cambiar por el mismo valor\n";
//                         }
//                     }while(!$estado);break;
                    
//                 case "todo":
//                     echo "Ingrese otro codigo\n";
//                     $codigo = trim(fgets(STDIN));
//                     echo "Ingrese otro destino\n";
//                     $destino = trim(fgets(STDIN));
//                     echo "Ingrese otra cantidad maxima de pasajeros\n";
//                     $cantMaxPasajeros = trim(fgets(STDIN));
//                     $colPasajero = array();
//                     echo "Ingrese otro importe del viaje\n";
//                     $importe=trim(fgets(STDIN));
//                     $unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $colPasajero,$unResponsableV,$importe,0);
//                     ;break;
//             }            
//             ;break;
        
//         case 4:
//             echo "que quiere cambiar?\n";
//             echo "Ingrese (numero): Para cambiar el numero del empleado" .
//             "\nIngrese (licencia): Para cambiar la licencia del empleado" .
//             "\nIngrese (nombre): Para cambiar el nombre del empleado" .
//             "\nIngrese (apellido): Para cambiar el apellido del empleado" .
//             "\nIngrese (todo): Para cambiar toda la informacion del empleado\n";
//             $opcionCambio = trim(fgets(STDIN));
//             switch($opcionCambio){
//                 case "numero":
//                     do{
//                         echo "ingrese otro numero\n";
//                         $otroDato=trim(fgets(STDIN));
//                         $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
//                         if ($cumple) {
//                             echo "numero cambiado";
//                             $estado = true;
//                         } else {
//                             echo "el numero tiene que ser diferente\n";
//                         }
//                     }while(!$cumple)
//                     ;break;

//                 case "licencia":
//                     do{
//                         echo "ingrese otro numero de licencia\n";
//                         $otroDato=trim(fgets(STDIN));
//                         $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
//                         if ($cumple) {
//                             echo "licencia cambiado";
//                             $estado = true;
//                         } else {
//                             echo "la licencia tiene que ser diferente\n";
//                         }        
//                     }while(!$cumple)
//                     ;break;

//                 case "nombre":
//                     do{
//                         echo "ingrese otro nombre\n";
//                         $otroDato=trim(fgets(STDIN));
//                         $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
//                         if ($cumple) {
//                             echo "nombre cambiado";
//                             $estado = true;
//                         } else {
//                             echo "el nombre tiene que ser diferente\n";
//                         }        
//                     }while(!$cumple)
//                     ;break;

//                 case "apellido":
//                     do{
//                         echo "ingrese otro apellido\n";
//                         $otroDato=trim(fgets(STDIN));
//                         $cumple=$unViaje->cambiarResponsableV($opcionCambio,$otroDato);
//                         if ($cumple) {
//                             echo "apellido cambiado";
//                             $estado = true;
//                         } else {
//                             echo "el apellido tiene que ser diferente\n";
//                         }        
//                     }while(!$cumple)
//                     ;break;

//                 case "todo":
//                     echo "Ingrese el numero de empleado\n";
//                     $numEmpleado = trim(fgets(STDIN));
//                     echo "Ingrese el numero de licencia\n";
//                     $numLicencia = trim(fgets(STDIN));
//                     echo "Ingrese el nombre del empleado\n";
//                     $nombreEmpleado = trim(fgets(STDIN));
//                     echo "Ingrese el apellido del empleado\n";
//                     $apellidoEmpleado = trim(fgets(STDIN));
//                     $unResponsableV = new ResponsableV($numEmpleado, $numLicencia, $nombreEmpleado, $apellidoEmpleado);
//                     $unViaje->setResponsableV($unResponsableV)
//                     ;break;
//                 }            
//             ;break;

//         case 5:
//             echo $unViaje->__toString()
//             ;break;        
//     }

//     echo "\nDesea hacer otra cosa? s/n\n";
//     $desicion = trim(fgets(STDIN));
// } while ($desicion == 's');



=======
/**
 * menu general para preguntar el tipo de cambio
 * @return String
 */
function menuGeneral(){
    echo "que quiere cambiar?\n";
    echo "Ingrese (nombre): Para cambiar el nombre del pasajero" .
         "\nIngrese (apellido): Para cambiar el apellido del pasajero" .
         "\nIngrese (telefono): Para cambiar el telefono del pasajero".
         "\nIngrese (todo): Para cambiar toda la informacion de un pasajero\n";
}

/**
 * Cambia los datos que comparten todos los pasajero
 * @param string
 * @param Viaje
 * @param int
 */
function cambiarDato($opcionCambio,$elPasajero){
    $estado=false;
    switch ($opcionCambio) {
        case "nombre":
            do {
                echo "ingrese otro nombre\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = strcmp($elPasajero->getNombre(),$otroDato);
                if ($cumple!=0) {
                    $elPasajero->setNombre($otroDato);
                    $elPasajero->modificar();
                    echo "nombre cambiado";
                    //echo $elPasajero; NO SE SI QUIEREN MOSTRARLE AL USUARIO EL CAMBIO QUE SE REALIZO?
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
                $cumple = strcmp($elPasajero->getApellido(),$otroDato);
                if ($cumple!=0) {
                    $elPasajero->setApellido($otroDato);
                    $elPasajero->modificar();
                    echo "apellido cambiado";
                    $estado = true;
                } else {
                    echo "el nombre tiene que ser diferente\n";
                }
            } while (!$estado)
            ;break;
        
        case "telefono":
            do {
                echo "ingrese otro telefono\n";
                $otroDato = trim(fgets(STDIN));
                $cumple = $elPasajero->getTelefono()!=$otroDato;
                if ($cumple) {
                    $elPasajero->setTelefono($otroDato);
                    $elPasajero->modificar();
                    echo "telefono cambiado";
                    $estado = true;
                } else {
                    echo "el telefono tiene que ser diferente\n";
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

            $elPasajero->setNombre($nombre);
            $elPasajero->setApellido($apellido);
            $elPasajero->setTelefono($numTele);
            $elPasajero->modificar();
            echo "datos cambiados";break;
    }
}

//<-------------EMPIEZA EL TEST----------------->
/*$emp = new Empresa();
$emp->cargar(1, "viaje feliz", "Neuquen Capital");
$emp->insertar();
$viaje=new Viaje();
$responsableV= new ResponsableV();
$perRespo=new Persona();

echo "\nInformacion del viaje: \n";
echo "Ingrese el destino\n";
$destino = trim(fgets(STDIN));
echo "Ingrese la cantidad maxima de pasajeros\n";
$cantMaxPasajeros = trim(fgets(STDIN));
echo "Ingrese el importe del viaje";
$importe=trim(fgets(STDIN));


echo "Informacion del responsable se ese viaje: \n";
echo "Ingrese el nombre del empleado\n";
$nombreEmpleado= trim(fgets(STDIN));
echo "Ingrese el apellido del empleado\n";
$apellidoEmpleado= trim(fgets(STDIN));
echo "ingrese el documento del empleado\n";
$docEmpleado=trim(fgets(STDIN));
echo "Ingrese el numero de empleado\n";
$numEmpleado= trim(fgets(STDIN));
echo "Ingrese el numero de licencia\n";
$numLicencia= trim(fgets(STDIN));

$perRespo->cargar($numEmpleado,$nombreEmpleado,$apellidoEmpleado);
$perRespo->insertar();
$responsableV->cargar($numEmpleado,$nombreEmpleado,$apellidoEmpleado,$numEmpleado,$numLicencia);
$responsableV->insertar();
$viaje->cargar(1,$destino,$cantMaxPasajeros,$responsableV,$emp,$importe);

*/
do{
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    $otroPersona=new Persona();
    $otroPasajero=new Pasajero();//hago esto para poder acceder a los metodos de pasajero
    switch($opcion){
        case 1:
            $listaPasajero=$otroPasajero->listar();
            if(count($listaPasajero)<$viaje->getCantMaxPasajeros()){
                echo "ingrese el nombre del pasajero\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del pasajero\n";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el numero de documento del pasajero\n";
                $numDoc = trim(fgets(STDIN));

                $pasajeroYacargado = $otroPasajero->Buscar($numDoc);
                $personaYaCargada = $otroPersona->Buscar($numDoc);
                if ($pasajeroYacargado) {
                    echo "Ya se encuentra en ese viaje";
                } else if($personaYaCargada){
                    echo "Esta persona ya fue cargada en la base de datos";
                }else{
                    echo "ingrese el numero de telefono del pasajero\n";
                    $numTele = trim(fgets(STDIN));
                    $nuevaPersona=new Persona();
                    $nuevaPersona->cargar($numDoc,$nombre,$apellido);
                    $otroPasajero->cargar($numDoc,$nombre,$apellido,20,$viaje,$numTele);
                    $nuevaPersona->insertar();
                    $otroPasajero->insertar();
                    echo "Pasajero cargado en la base de datos";
                }
            }else{
                echo "No disponible";
            }
            ;break;
        case 2:
            echo "Ingrese el documento del pasajero";
            $doc=trim(fgets(STDIN));
            $otroPasajero=new Pasajero();
            //si el pasajero existe, realizara el cambio
            if($otroPasajero->Buscar($doc)){
                $elPasajero=$otroPasajero->devuelveAlguien($doc);
                //echo $elPasajero;
                menuGeneral();
                $opcionCambio=trim(fgets(STDIN));
                cambiarDato($opcionCambio,$elPasajero);
            }else{
                echo "Ese pasajero no existe";
            }
            ;break;
    }
    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');
>>>>>>> a3e9299502f338c059acaeb000821e8f9d304c97

?>
