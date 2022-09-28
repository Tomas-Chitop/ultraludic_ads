<!--iniciar la variable-->
<?
ob_start();
?>
<?php
//CONEXION A LA BASE DE DATOS
require '../Admin/config/bdReportes.php';
require '../Admin/config/config.php';

$db = new Database();
$con = $db->conectar();

$id=isset($_GET['id']) ? $_GET['id']:"";
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
    echo 'error al procesar la información';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

    $sql = $con->prepare("SELECT count(id) FROM campañas WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if ($sql->fetchColumn() > 0) {
        
        $sql = $con->prepare("SELECT nombre_empresa, link, titulo_uno, titulo_dos, descripcion, imagen FROM campañas WHERE id=? AND activo=1 LIMIT 1");
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $nombreEmpresa = $row['nombre_empresa'];
        $anuncio = $row['imagen'];
        $nombre = $row['nombre_empresa'];
        $titulo_uno = $row['titulo_uno'];
        $titulo_dos = $row['titulo_dos'];
        $descripcion = $row['descripcion'];

    }

    } else {
        echo 'Error al procesar la información';
        exit;
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/1055/1055644.png">
    <title>Reportes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="col-md-13">
    <br><br>

<!--PRIMERA HOJA-->
<center><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/img_report/logo_ultraludic_h90.png"></center>
<br><br>
<div>
    <p style="text-align: justify;">
        Transformamos contenidos en juegos o aplicaciones con fines sociales, culturales, educativos o comerciales. Con creatividad, tecnología y entretenimiento bien aplicados ayudamos a aumentar el compromiso con los usuarios y consumidores.
    </p>
</div>
<br>
<center><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/img_report/post_img_buss.png" width="720px"></center>
<br><br><br><br>
<center><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/img_report/objet_empre.png" width="720px"></center>

<!--SEGUNDA HOJA-->
<h1 style="text-align: center;">Informe de anuncios</h1>
<br>
<h1 style="text-align: center;">A:</h1>
<br>
<h1 style="text-align: center;"><?php echo $nombreEmpresa; ?></h1>

<div>
    <p style="text-align: justify;">
        Gracias por confiar en nosotros, es un gusto poder servirle y ayudarle a que su empresa pueda tener reconocimiento a nivel de ventas, un mayor alcance, aumentar las ganancias, entre otros tantos veneficios que usted adquiere al confiar en nosotros.
    </p>
</div>

<!-- Anuncio -->
<div style="background-color: #222831; border: black solid 2px; border-radius: 10px;" width="500px">
<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/img_report/logo_ultraludic_h90.png" width="150px">
<br>
<center><img width="240px" height="320" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/ultraludic_ADS/img/<?php echo $anuncio; ?>" class="img-fluid rounded-start" alt="#"></center>
<div class="card-body">
    <h3 style="text-align: center; color: #00ADB5;" class="card-title"><?php echo $nombre; ?></h3>
    <p style="text-align: center; color: white;" class="card-text"><?php echo $titulo_uno; ?></p>
    <p style="text-align: center; color: white;" class="card-text"><?php echo $titulo_dos; ?></p>
    <p style="text-align: center; color: white;" class="card-text"><?php echo $descripcion; ?></p>
</div>
</div>
<br>

<!-- Clics y vistas -->
<div>
  <h5 style="text-align: center;">Vistas 0</h5>
  <br>
  <h5 style="text-align: center;">Clics 0</h5>
</div>

</div>
    
</body>
</html>

<?php
//guardar el contenido del html en una variable
$html=ob_get_clean();
//echo $html;

//incluir la libreria dompdf
require_once '../Admin/libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//carta
$dompdf->setPaper('letter');
//esta linea es por si se desea imprimir en horintación horizontal
//oficio
//$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

//false = no descargar el archivo
//true = descargar el archivo
$dompdf->stream("reporte_campañas_.pdf", array("Attachment" => false));

?>