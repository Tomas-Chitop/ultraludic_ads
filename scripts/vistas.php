<?php

include ("Admin/config/bdVistas.php");
include("Admin/config/bd.php");

date_default_timezone_set("America/Guatemala");
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$id_con = $_SESSION['variable'];

$sqlConsultar = $con->query("SELECT * FROM vistas WHERE ip = '$ip' ORDER BY id desc");
$contarConsultar = $sqlConsultar->num_rows;

if($contarConsultar == 0) {
    $sqlInsertar = $con->query("INSERT INTO vistas (ip,fecha,id_vistas) VALUES ('$ip',now(),'$id_con')");
} else {
    $row = $sqlConsultar->fetch_array();
    $fechaRegistro = $row['fecha'];
    $fechaActual = date("Y-m-d H:i:s");
    $nuevaFecha = strtotime($fechaRegistro."+ 3 seconds");
    $nuevaFecha = date("Y-m-d H:i:s",$nuevaFecha);

    if($fechaActual >= $nuevaFecha) {
        $sqlInsertar = $con->query("INSERT INTO vistas (ip,fecha,id_vistas) VALUES ('$ip',now(),'$id_con')");
    }
}

$visitas = $con->query("SELECT * FROM vistas");
$contar = $visitas->num_rows;

?>