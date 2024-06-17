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
do{
    //solo existe un tipo viaje, para cambiar los valores de pasajero tengo que primero cambiar el valor del padre y despues darselo al hijo
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));
    switch($opcion){
        case 1:
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

?>
