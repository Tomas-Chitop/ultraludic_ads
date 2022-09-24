<?php include("template/header.php") ?>

<?php

session_start();

$id = $_GET['id'];

?>

<!-- conexion a la base de datos -->
<?php
    include("Admin/config/bd.php");

    $sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
    $sentenciaSQL->execute();
    $listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- Informacion principal -->
<?php foreach($listaCampañas as $campaña) { ?>
<div class="jumbotron text-center">
<div class="container">
  <br>
  <div class="row">
      <div class="col-md-6">
            
      <div class="card mb-3">
      <h1 class="card-header"><?php echo $campaña['nombre_empresa']; ?></h1>
      <div class="card-body">
        <h2 class="card-title"><?php echo $campaña['titulo_uno']; ?></h2>
        <h4 class="card-subtitle text-muted"><?php echo $campaña['titulo_dos']; ?></h4>
        <h5 class="card-subtitle text-muted">
        <?php echo $campaña['descripcion']; ?>
        </h5>
      </div>
      <div>
      <img width="350" height="420" src="./img/<?php echo $campaña['imagen']; ?>" alt="img-anuncio">
      </div>
      <div class="card-body">
        <p class="card-text"><?php echo $campaña['telefono']; ?></p>
      </div>
      <div>
        <a href="<?php echo $campaña['link']; ?>" target="_blank">Web del anunciante</a>
      </div>
      <br>
      <div>
      <div class="card-footer text-muted">
      </div>
        
  </div>
</div>
</div>


<!-- Informacion de la derecha -->
<div style="max-width: 550px;">
  <div class="row g-0">

    <div class="col-md-4">
      <br>
      <img src="https://images.pexels.com/photos/34600/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <br>
        <p class="card-text">Clics 80</p>
        <p class="card-text">Vistas 230</p>
      </div>
    </div>

    <div class="col-md-4">
      <br>
      <img src="https://images.pexels.com/photos/624015/pexels-photo-624015.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <br>
        <p class="card-text">Clics 80</p>
        <p class="card-text">Vistas 230</p>
      </div>
    </div>

    <div class="col-md-4">
      <br>
      <img src="https://images.pexels.com/photos/34107/milky-way-stars-night-sky.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <br>
        <p class="card-text">Clics 80</p>
        <p class="card-text">Vistas 230</p>
      </div>
    </div>

    <div class="col-md-4">
      <br>
      <img src="https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <br>
        <p class="card-text">Clics 80</p>
        <p class="card-text">Vistas 230</p>
      </div>
    </div>

  </div>
</div>


<?php }?>






<?php include("template/footer.php") ?>