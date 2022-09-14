<?php 

    session_start();
    if($_POST) {

        if(($_POST['usuario']=="tomas") && ($_POST['contrasenia']=="tom123")){
            $_SESSION['usuario']='ok';
            $_SESSION['nombreUsuario']='tomas';
            header('Location:inicio.php');
        }else {
            $mensaje = "Error: El usuario o contraseña son incorrectos";
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="https://www.iconpacks.net/icons/1/free-user-login-icon-305-thumb.png">
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                
            </div>

            <div class="col-md-4">
            <br><br><br><br><br><br><br><br>
                <!-- TARGET -->
                <div class="card">

                    <div class="card-header">
                        Login
                    </div>
                    
                    <!-- BODY -->
                    <div class="card-body">

                        <!-- ALERTA -->
                        <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>

                        <form method="POST">

                        <!-- USER -->
                        <div class = "form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="exampleInputEmail1" placeholder="Ingresa tu usuario">
                        </div>
                        <!-- PASSWORD -->
                        <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña:</label>
                        <input type="password" class="form-control" name="contrasenia" id="exampleInputPassword1" placeholder="Ingresa tu contraseña">
                        </div>
                        <!-- BUTTON LOGIN -->
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                        
                        </form>
                        
                    </div>
                </div>

            </div>
            
        </div>
    </div>

  </body>
</html>