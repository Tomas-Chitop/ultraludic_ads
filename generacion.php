<?php include("template/header.php") ?>

<?php
//CONEXION A LA BASE DE DATOS
include("Admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
$sentenciaSQL->execute();
$listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-13">
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Anuncio</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaCampañas as $campaña) { ?>
            <tr>
                <td><?php echo $campaña['id']; ?></td>
                <td><?php echo $campaña['nombre_empresa']; ?></td>
                <td>
                  <textarea id="texto" class="form-control" rows="3"><center><a href="<?php echo $campaña['link']; ?>" target="_blank"><img style="display:inline-block;" height="350px" width="300px" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/<?php echo $campaña['imagen']; ?>" alt="¡Anuncio no disponible!"></a></center></textarea>
                </td>
                <td width="80px"><img class="img-thumbnail rounded" src="img/<?php echo $campaña['imagen']; ?>" width="60"></td>
                

                
                <td width="80px">
                  <button type="button" class="btn btn-danger" id="btn">
                     Copiar
                  </button>
                </td>
                <script src="copiar.js"></script>

              </tr>
        <?php } ?>
        </tbody>
    </table>
    <br><br>
</div>

<?php include("template/footer.php") ?>