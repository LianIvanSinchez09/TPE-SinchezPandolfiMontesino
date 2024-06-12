<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/BaseDatos.php";

$res = new ResponsableV();

$res->cargar(21312312312, "Lian", "Sinchez", 123, 456);

$respuesta = $res->insertar();

if($respuesta){
    echo "Funcionando";
}else{
    echo "No funciona :(";
}

echo $res;