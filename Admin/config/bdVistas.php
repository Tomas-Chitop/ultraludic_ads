<?php
$Userver = "localhost";
$Uuser = "root";
$Upass = "";
$Udb = "ultraludic_ads";

$con = new mysqli($Userver,$Uuser,$Upass,$Udb);

if($con->connect_errno) {
    echo "Ha ocurrido un error";
}

?>