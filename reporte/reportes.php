<!--iniciar la variable-->
<?
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
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

<?php
//CONEXION A LA BASE DE DATOS
include("../Admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
$sentenciaSQL->execute();
$listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-13">
    <br><br><br>
<h1>Reporte de libros</h1>
<table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Web</th>
                <th>Titulo 1</th>
                <th>Titulo 2</th>
                <th>Descripción</th>
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
                <td><img class="img-thumbnail rounded" src="../img/<?php echo $campaña['imagen']; ?>" width="60"></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
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
//$dompdf->setPaper('letter');
//esta linea es por si se desea imprimir en horintación horizontal
//oficio
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

//false = no descargar el archivo
//true = descargar el archivo
$dompdf->stream("reporte_campañas_.pdf", array("Attachment" => false));

?>