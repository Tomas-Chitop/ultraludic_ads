<?php

$host="localhost";
$bd="ultraludic_ads";
$usuario="root";
$contrasenia="";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>