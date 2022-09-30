<?php

include ("../Admin/config/bdVistas.php");
date_default_timezone_set("America/Guatemala");

$ip = $_SERVER['REMOTE_ADDR'];

$sqlConsultar = $con->query("SELECT * FROM vistas WHERE ip = '$ip' ORDER BY id desc");
$contarConsultar = $sqlConsultar->num_rows;

if($contarConsultar == 0) {
    $sqlInsertar = $con->query("INSERT INTO vistas (ip,fecha) VALUES ('$ip',now())");
} else {
    $row = $sqlConsultar->fetch_array();
    $fechaRegistro = $row['fecha'];
    $fechaActual = date("Y-m-d H:i:s");
    $nuevaFecha = strtotime($fechaRegistro."+ 1 minute");
    $nuevaFecha = date("Y-m-d H:i:s",$nuevaFecha);

    if($fechaActual >= $nuevaFecha) {
        $sqlInsertar = $con->query("INSERT INTO vistas(ip,fecha) VALUES ('$ip',now())");
    }
}

$visitas = $con->query("SELECT * FROM vistas");
$contar = $visitas->num_rows;

echo $contar;

?>