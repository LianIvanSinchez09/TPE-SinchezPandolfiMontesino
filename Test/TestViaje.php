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

function menuViaje(){
    echo "que quiere cambiar?\n";
    echo "\nIngrese (destino): Para cambiar el destino del viaje" .
         "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
         "\nIngrese (costo): Para cambiar el costo del viaje".
         "\nIngrese (todo): Para cambiar toda la informacion del viaje\n";
}

/**
 * Cambia los datos que comparten todos los pasajero
 * @param string
 * @param Viaje
 * @param int
 * @return boolean
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
                echo $elPasajero;
                echo "datos cambiados";break;
    }
    return $estado;
}

//--------------------------------------------------------------------------
$res = new Persona();
$res1 = new ResponsableV();
$res->cargar(44323057, "Lian", "Sinchez");
$res1->cargar(44323057, "Lian", "Sinchez", 22, 22);
$res->insertar();
$res1->insertar();

$empresa=new Empresa();
$empresa->cargar(1,"Viaje Feliz","Buenos Aires 1800");
$viaje = new Viaje();
$viaje->cargar(1, "Cipolletti", 20, $res1, $empresa, 1000);
$empresa->insertar();
$viaje->insertar();

$res = new Persona();
$res1 = new Pasajero();
$res->cargar(22222222, "matias", "peña");
$res1->cargar(22222222, "matias", "peña", 22, $viaje,2994130513);
$res->insertar();
$res1->insertar();

do{
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    $otroPasajero=new Pasajero();
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

                if ($pasajeroYacargado) {
                    echo "Ya se encuentra en ese viaje";
                } else {
                    echo "ingrese el numero de telefono del pasajero\n";
                    $numTele = trim(fgets(STDIN));
                    $nuevaPersona=new Persona();
                    $nuevoPasajero= new Pasajero();
                    $nuevaPersona->cargar($numDoc,$nombre,$apellido);
                    $nuevoPasajero->cargar($numDoc,$nombre,$apellido,20,$viaje,$numTele);
                    $nuevaPersona->insertar();
                    $nuevoPasajero->insertar();
                    echo "Pasajero cargado en la base de datos";
                }
            }else{
                echo "No disponible";
            }
            ;break;
        case 2:
            echo "Ingrese el documento del pasajero";
            $doc=trim(fgets(STDIN));
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
                /*menuViaje();
                $opcionCambio=trim(fgets(STDIN));
                switch($opcionCambio){
                    case 'destino':
                        do{
                            echo "ingrese otro destino\n";
                            $otroDato=trim(fgets(STDIN));
                            if(strcmp($viaje->getDestino(),$otroDato)!=0){
                                echo "destino cambiado";
                                $viaje->setDestino($otroDato);
                                $viaje->modificar();
                                echo $viaje;
                                $estado=true;
                            }else{
                                echo "No se puede cambiar por el mismo destino\n";
                            }
                        }while(!$estado);break;
                        
                    case 'maximo':
                        do{
                            echo "ingrese otra capacidad maxima de personas\n";
                            $otroDato=trim(fgets(STDIN));
                            if($viaje->getCantMaxPasajeros()!=$otroDato){
                                echo "capacidad cambiado";
                                $viaje->setCantMaxPasajeros($otroDato);
                                $viaje->modificar();
                                echo $viaje;
                                $estado=true;
                            }else{
                                echo "No se puede cambiar por el misma capacidad\n";
                            }
                    }while(!$estado);break;
    
                    case 'importe':
                        do{
                            echo "ingrese otra valor de importe\n";
                            $otroDato=trim(fgets(STDIN));
                            if($viaje->getImporte()!=$otroDato){
                                echo "importe cambiado";
                                $viaje->setImporte($otroDato);
                                $viaje->modificar();
                                echo $viaje;
                                $estado=true;
                            }else{
                                echo "No se puede cambiar por el misma importe\n";
                            }
                        }while(!$estado);break;

                    case 'todo':
                        echo "ingrese otro destino\n";
                        $destino=trim(fgets(STDIN));
                        echo "ingrese otra capacidad maxima de personas\n";
                        $maximo=trim(fgets(STDIN));
                        echo "ingrese otra valor de importe\n";
                        $importe=trim(fgets(STDIN));
                        $viaje->setDestino($destino);
                        $viaje->setCantMaxPasajeros($maximo);
                        $viaje->setImporte($importe);
                        $viaje->modificar();
                        echo "datos cambiados";
                        echo $viaje;
                    break;
                }*/

        case 4://ingresar un nuevo responsable, no esta terminado
            echo "Ingrese el documento del responsable";
            $numDoc=trim(fgets(STDIN));
            $responsableYacargado = $otroResponsable->Buscar($numDoc);
            $personaYaCargada = $otroPersona->Buscar($numDoc);
            if($responsableYacargado){
                echo "este responsable ya existe";
            } else if($personaYaCargada){
                echo "Esta persona ya fue cargada en la base de datos";
            }else{
                echo "ingrese el nombre";
                $nombre=trim(fgets(STDIN));
                echo "ingrese el apellido";
                $apellido=trim(fgets(STDIN));
                echo "ingrese el numero de licencia";
                $numLicencia=trim(fgets(STDIN));

            }   
            ;break;
        case 6:;break;
        case 7:
            echo "Desea cambiar dirección o nombre de la empresa?: ";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 'direccion':
                        do {
                            echo "Ingrese nueva dirección: \n";
                            $direccion = trim(fgets(STDIN));
                            $empresa->setDireccion($direccion);
                            if($empresa->modificar()){
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
                        $empresa->setNombre($nombre);
                        if($empresa->modificar()){
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
