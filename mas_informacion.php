<?php include("template/header.php") ?>


<!-- evitar que el id de la url sea editado -->
<?php
include('Admin/config/config.php');
$id_con = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id_con == '' || $token == '') {
    echo 'error al procesar la información';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id_con, KEY_TOKEN);

    if ($token == $token_tmp) {
    } else {
        echo 'Error al procesar la información';
        exit;
    }

}

?>

<?php
//CONEXION A LA BASE DE DATOS
include("Admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
$sentenciaSQL->execute();
$listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-13">
    <br><br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <a href="reporte/reportes.php">Generar reporte</a>
            </tr>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Web</th>
                <th>Titulo 1</th>
                <th>Titulo 2</th>
                <th>Descripción</th>
                <th>Clics</th>
                <th>Vistas</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaCampañas as $campaña) { ?>
            <tr>
                <td><?php echo $campaña['id']; ?></td>
                <td><?php echo $campaña['nombre_empresa']; ?></td>
                <td><?php echo $campaña['link']; ?></td>
                <td><?php echo $campaña['titulo_uno']; ?></td>
                <td><?php echo $campaña['titulo_dos']; ?></td>
                <td><?php echo $campaña['descripcion']; ?></td>
                <td></td>
                <td></td>
                <td><img class="img-thumbnail rounded" src="img/<?php echo $campaña['imagen']; ?>" width="60"></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("template/footer.php") ?>