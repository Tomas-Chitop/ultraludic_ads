<?php

session_start();
  if(!isset($_SESSION['usuario'])) {
    header('Location:../index.php');
  }else {
    if($_SESSION['usuario']=="ok"){
      $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }

?>

<!doctype html>
<html lang="es">
  <head>
    <link rel="shortcut icon" href="https://www.lansweeper.com/wp-content/uploads/2018/05/ASSET-USER-ADMIN.png">
    <title>Administrador del sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <!-- Redireccionar usuario -->
    <?php $url="http://".$_SERVER['HTTP_HOST']."/ultraludic_ADS" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/section/campanias.php">Crear campañas</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/section/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href=" <?php echo $url ?> ">Ver sitio web</a>
        </div>
    </nav>

    <div class="container">
        <br>
        <div class="row">