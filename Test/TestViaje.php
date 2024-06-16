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
$respuesta3 = $viaje->insertar();

if ($respuesta) {
    echo "\nFuncionando\n";
} else {
    echo "\nNo funciona :(\n";
}

$persona2 = new Persona();
$persona2->cargar(34534534, "Francisco", "Pandolfi");
$persona2->insertar();

$pasajero = new Pasajero(); 
$pasajero->cargar(34534534, "Francisco", "Pandolfi", 1, $viaje, 2995920034);
$pasajero->insertar();

echo "\nClase Persona 1";
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
}

?>
