<?php include("../template/header.php") ?>

<?php

//validando que los datos no estén vacios
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombreEmpresa=(isset($_POST['txtNombreEmpresa']))?$_POST['txtNombreEmpresa']:"";
$txtLink=(isset($_POST['txtLink']))?$_POST['txtLink']:"";
$txtTitulo1=(isset($_POST['txtTitulo1']))?$_POST['txtTitulo1']:"";
$txtTitulo2=(isset($_POST['txtTitulo2']))?$_POST['txtTitulo2']:"";
$txtDescrip=(isset($_POST['txtDescrip']))?$_POST['txtDescrip']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//CONEXION A LA BASE DE DATOS
include("../config/bd.php");


switch($accion) {

    //********************************************/
    //agregar
    case "Agregar":

        //INSERTANDO DATOS A LA DB
        $sentenciaSQL = $conexion->prepare("INSERT INTO campañas (nombre_empresa, link, titulo_uno, titulo_dos, descripcion, telefono, imagen) VALUES (:nombre_empresa, :link, :titulo_uno, :titulo_dos, :descripcion, :telefono, :imagen);");
        $sentenciaSQL->bindParam(':nombre_empresa',$txtNombreEmpresa);
        $sentenciaSQL->bindParam(':link',$txtLink);
        $sentenciaSQL->bindParam(':titulo_uno',$txtTitulo1);
        $sentenciaSQL->bindParam(':titulo_dos',$txtTitulo2);
        $sentenciaSQL->bindParam(':descripcion',$txtDescrip);
        $sentenciaSQL->bindParam(':telefono',$txtTelefono);

        //evitar que dos nombres iguales coincidan en las imagenes
        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        //validar si tmpImagen tiene algo
        if($tmpImagen!="") {
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header('Location:campanias.php');
        break;



    //********************************************/
    //modificar
    case "Modificar":

        if($txtNombreEmpresa!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET nombre_empresa=:nombre_empresa WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre_empresa',$txtNombreEmpresa);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtLink!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET link=:link WHERE id=:id");
            $sentenciaSQL->bindParam(':link',$txtLink);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtTitulo1!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET titulo_uno=:titulo_uno WHERE id=:id");
            $sentenciaSQL->bindParam(':titulo_uno',$txtTitulo1);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtTitulo2!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET titulo_dos=:titulo_dos WHERE id=:id");
            $sentenciaSQL->bindParam(':titulo_dos',$txtTitulo2);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtDescrip!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET descripcion=:descripcion WHERE id=:id");
            $sentenciaSQL->bindParam(':descripcion',$txtDescrip);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtTelefono!="") {
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET telefono=:telefono WHERE id=:id");
            $sentenciaSQL->bindParam(':telefono',$txtTelefono);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        if($txtImagen!="") {

            //Buscar imagen
            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM campañas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $campania=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($campania["imagen"]) && ($campania["imagen"]!="imagen.jpg") ) {
                if(file_exists("../../img/".$campania["imagen"])) {
                    unlink("../../img/".$campania["imagen"]);
                }
            }

            //actualizar imagen nueva
            $sentenciaSQL = $conexion->prepare("UPDATE campañas SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        header('Location:campanias.php');
        break;



    //********************************************/
    //cancelar
    case "Cancelar":

        header('Location:campanias.php');

        break;




    //********************************************/
    //seleccionar
    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM campañas WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $campania=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombreEmpresa = $campania['nombre_empresa'];
        $txtLink = $campania['link'];
        $txtTitulo1 = $campania['titulo_uno'];
        $txtTitulo2 = $campania['titulo_dos'];
        $txtDescrip = $campania['descripcion'];
        $txtTelefono = $campania['telefono'];
        $txtImagen = $campania['imagen'];

        //echo "Presionado boton Seleccionar";
        break;




    //********************************************/
    //borrar
    case "Borrar":

        //borrar imagen en carpeta img
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM campañas WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $campania=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($campania["imagen"]) && ($campania["imagen"]!="imagen.jpg") ) {
            if(file_exists("../../img/".$campania["imagen"])) {
                unlink("../../img/".$campania["imagen"]);
            }
        }

        //ELIMINANDO EL FORMULARIO
        $sentenciaSQL = $conexion->prepare("DELETE FROM campañas WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        //echo "Presionado boton Borrar";
        
        header('Location:campanias.php');
        break;

    

}

$sentenciaSQL = $conexion->prepare("SELECT * FROM campañas");
$sentenciaSQL->execute();
$listaCampañas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-3">
</div>
<div class="col-md-5">
    
    <div class="card">

        <div class="card-header">
            Datos de Libro
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombreEmpresa">*Nombre de la empresa:</label>
            <input type="text" required class="form-control" value="<?php echo $txtNombreEmpresa ?>" name="txtNombreEmpresa" id="txtNombreEmpresa" placeholder="Nombre de la empresa">
            </div>

            <div class = "form-group">
            <label for="txtLink">*Link:</label>
            <input type="text" required class="form-control" value="<?php echo $txtLink; ?>" name="txtLink" id="txtLink" placeholder="Link de la empresa">
            </div>
            
            <div class = "form-group">
            <label for="txtTitulo1">Titulo 1:</label>
            <input type="text" class="form-control" value="<?php echo $txtTitulo1; ?>" name="txtTitulo1" id="txtTitulo1" placeholder="Eje: Fasstom">
            </div>

            <div class = "form-group">
            <label for="txtTitulo2">Titulo 2:</label>
            <input type="text" class="form-control" value="<?php echo $txtTitulo2; ?>" name="txtTitulo2" id="txtTitulo2" placeholder="Eje: ¡Triunfa con nosotros!">
            </div>

            <div class = "form-group">
            <label for="txtDescrip">Descripción:</label>
            <input type="text" class="form-control" value="<?php echo $txtDescrip; ?>" name="txtDescrip" id="txtDescrip" placeholder="Eje: Somos una empresa dedicada al desarrollo web">
            </div>

            <div class = "form-group">
            <label for="txtTelefono">Teléfono:</label>
            <input type="text" class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Eje: +502 0000-0000">
            </div>

            <div class = "form-group">
            <label for="txtImagen">*Imagen:</label>
            <!--mostrar imagen-->
            <br>
            <?php if($txtImagen!="") { ?>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="60">
            <?php }?>

            <input type="file" class="form-control" name="txtImagen" id="txtImagen">
            </div>

            <!--BOTONES-->
            <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

            </form>
        </div>
    </div>
</div>

<div class="col-md-13">
    <br><br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Web</th>
                <th>Titulo 1</th>
                <th>Titulo 2</th>
                <th>Descripción</th>
                <th>Teléfono</th>
                <th>Imagen</th>
                <th>Accion</th>
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
                <td><?php echo $campaña['telefono']; ?></td>

                <td><img class="img-thumbnail rounded" src="../../img/<?php echo $campaña['imagen']; ?>" width="60"></td>

                <td>

                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $campaña['id']; ?>">

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    </form>

                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/footer.php") ?>