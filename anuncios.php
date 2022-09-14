<?php include("template/header.php") ?>

<!-- conexion a la base de datos -->
<?php
    include("Admin/config/bd.php");

    $sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
    $sentenciaSQL->execute();
    $listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($listaCampañas as $campaña) { ?>
<div class="col-md-3">
<div class="jumbotron text-center">
    <br>
    <div class="card" >
        <img class="card-img-top" height="350" src="./img/<?php echo $campaña['imagen']; ?>" alt="">
        <div class="card-body">
            <h2 style="font-weight: bold" class="card-title"><?php echo $campaña['nombre_empresa']; ?></h2>
            <a style="font-weight: bold"><?php echo $campaña['titulo_uno']; ?></a><br>
            <a style="font-weight: bold"><?php echo $campaña['titulo_dos']; ?></a><br>
            <a><?php echo $campaña['link']; ?></a>
            <p><?php echo $campaña['telefono']; ?></p>
            <a class="btn btn-primary" href="#" role="button">Más información</a>
        </div>
    </div>
</div>
</div>
<?php }?>

<?php include("template/footer.php") ?>