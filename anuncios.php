<?php include("template/header.php") ?>

<?php

include("Admin/config/config.php");

?>

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
    <div class="card">
        <img class="card-img-top" height="350" src="./img/<?php echo $campaña['imagen']; ?>" alt="">
        <div class="card-body">
            <h2 style="font-weight: bold" class="card-title"><?php echo $campaña['nombre_empresa']; ?></h2>
            <!-- En esta parte se cifra el id -->
            <a class="btn btn-primary" href="mas_informacion.php?id=<?php print $campaña['id'] ?>&token=<?php echo hash_hmac('sha1', $campaña['id'], KEY_TOKEN); ?>" role="button">Más información</a>
            <br><br>
            <a class="btn btn-success" href="generacion.php?id=<?php print $campaña['id'] ?>&token=<?php echo hash_hmac('sha1', $campaña['id'], KEY_TOKEN); ?>" role="button">Generar anuncio</a>
        </div>
    </div>
</div>
</div>
<?php }?>

<?php include("template/footer.php") ?>