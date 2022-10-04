<?php include("template/header.php") ?>

<?php
//CONEXION A LA BASE DE DATOS
session_start();
$_SESSION['variable']=isset($_GET['id']) ? $_GET['id'] : '';
include("Admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
$sentenciaSQL->execute();
$listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

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

$refer = "<?php include('scripts/vistas.php'); ?>"

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
                <!-- SCRIPT DEL ANUNCIO -->
                <td>
                    <textarea id="texto" class="form-control" rows="3">
<center><a href="<?php echo $campaña['link']; ?>" target="_blank"><img onclick="coutingClicks()" style="display:inline-block;" height="350px" width="300px" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/<?php echo $campaña['imagen']; ?>" alt="¡Anuncio no disponible!"></a></center>
<?php echo $refer; ?><br>
<script src="scripts/clicks.js"></script></textarea>
                </td>
                <td width="80px"><img class="img-thumbnail rounded" src="img/<?php echo $campaña['imagen']; ?>" width="60"></td>
                <td width="80px">
                  <button  type="button" class="btn btn-danger" id="btn">
                     Copiar
                  </button>
                  <script src="scripts/copiar.js"></script>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <br><br>
</div>

<?php include("template/footer.php") ?>