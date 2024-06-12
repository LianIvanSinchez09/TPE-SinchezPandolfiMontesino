<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/BaseDatos.php";

//si no tiene cargado a la persona antes de cargarlo en responsable, no funciona
$res = new Persona();
$res1 = new ResponsableV();
$res->cargar(44323057, "Lian", "Sinchez");
$res1->cargar(44323057, "Lian", "Sinchez",22,22);
$respuesta = $res->insertar();
$respuesta1 = $res1->insertar();

if($respuesta){
    echo "Funcionando";
}else{
    echo "No funciona :(";
}

echo $res;