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

//<-------------------------METODOS UTILIZADOS--------------------->
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
        "\nIngrese 7: Modificar empresa\n";
        "\nIngrese 8: Mostrar detalles del viaje\n";
}

/*
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
                    echo $elPasajero;
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
                    echo $elPasajero;
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
                    echo $elPasajero;
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
            echo "datos cambiados";
            echo $elPasajero;
            ;break;
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
*/
// prueba con empresa
$emp = new Empresa();
$emp->cargar(1, "koko", "Neuquen Capital");
$respuesta2 = $emp->insertar();
do{
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    $otroPersona=new Persona();
    $otroPasajero=new Pasajero();//hago esto para poder acceder a los metodos de pasajero
    $otroResponsable=new ResponsableV();
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
        case 3:
            echo "Ingrese destino: \n";
            $destino = trim(fgets(STDIN));
            echo "Ingrese cantidad maxima de pasajeros: \n";
            $cantMaxPasajeros = trim(fgets(STDIN));
            echo "Inserte importe a pagar del pasaje: \n";
            $viaje->cargar(1,$destino,$cantMaxPasajeros,$responsableV,$emp,$importe);
            $viaje->insertar();
        break;
        case 4:
            echo "que quiere cambiar?\n";
            echo "\nIngrese (destino): Para cambiar el destino del viaje" .
            "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
            "\nIngrese (costo): Para cambiar el costo del viaje".
            $opcionCambio = trim(fgets(STDIN));
            $estado=false;
            switch($opcionCambio){
                case "destino":
                    do{
                        echo "ingrese otro destino\n";
                        $otroDato=trim(fgets(STDIN));
                        $unViaje->setDestino($otroDato);
                        if($unViaje->modificar()){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);
                    break;
                case "maximo";
                    do{
                        echo "ingrese otra capacidad maxima de pasajeros\n";
                        $otroDato=trim(fgets(STDIN));
                        $unViaje->setCantMaxPasajeros($otroDato);
                        if($unViaje->modificar()){
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
                        $unViaje->setImporte($otroDato);
                        if($unViaje->modificar()){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);
                    break;
                }   
                default:
                    echo "Opcion no existente";
                break;
        case 7:
            echo "Desea cambiar dirección o nombre de la empresa?: ";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 'direccion':
                        do {
                            echo "Ingrese nueva dirección: \n";
                            $direccion = trim(fgets(STDIN));
                            $emp->setDireccion($direccion);
                            if($emp->modificar()){
                                echo "Direccion modificada correctamente\n";
                                $estado = true;
                            }else{
                                echo "No se pudo modificar la dirección";
                            }
                        } while (!$estado);
                    break;
                case 'nombre':
                    do {
                        echo "Ingrese nueva nombre: \n";
                        $nombre = trim(fgets(STDIN));
                        $emp->setNombre($nombre);
                        if($emp->modificar()){
                            echo "Nombre modificada correctamente\n";
                            $estado = true;
                        }else{
                            echo "No se pudo modificar el nombre";
                        }
                    } while (!$estado);
                break;
                default:
                    # code...
                    break;
            }
        break;
    }
    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');
// case 7:
//     echo $unViaje;

?>
