<?php

include_once "../Clases/Persona.php";
include_once "../Clases/ResponsableV.php";
include_once "../Clases/BaseDatos.php";

$res = new ResponsableV();

$res->cargar(123, 23423423, "Lian", "Sinchez", 4534534534, 34534543543);

$respuesta = $res->insertar();

if($respuesta){
    echo "Funcionando";
}else{
    echo "No funciona :(";
}

echo $res;