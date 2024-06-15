<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/Pasajero.php";
include_once "../Clases/Empresa.php";
include_once "../Clases/Viaje.php";
include_once "../Clases/BaseDatos.php";

//si no tiene cargado a la persona antes de cargarlo en responsable, no funciona
$res = new Persona();
$res1 = new ResponsableV();
$res->cargar(44323057, "Lian", "Sinchez");
$res1->cargar(44323057, "Lian", "Sinchez",22,22);
$respuesta = $res->insertar();
$respuesta1 = $res1->insertar();

//prueba con empresa
$emp = new Empresa();
$emp->cargar(1, "koko", "Neuquen Capital");
$respuesta2 = $emp->insertar();

//prueba con viaje 
$viaje = new Viaje();
$viaje->cargar(1, "Cipolletti", 20, $res1, $emp, 1000);
$respuesta3 = $viaje->insertar();

if($respuesta){
    echo "\nFuncionando\n";
}else{
    echo "\nNo funciona :(\n";
}

echo "\nClase Persona";
echo $res;
echo "\nClase Persona Responsable";
echo $res1;
echo "\nClase Empresa";
echo $emp;
echo "\nClase Viaje";
echo $viaje;