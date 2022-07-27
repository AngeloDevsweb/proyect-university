<?php
session_start();
    if($_POST){
        if(($_POST['usuario']=="admin") && ($_POST['contraseña']=="12345")){
            $_SESSION['usuario']="ok";
            $_SESSION['nombreUsuario']="admin";
            header('Location:inicio.php');
        }
        else{
            $mensaje ="Error: El usuario o contraseña son incorrectos";
        }
        
    }
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            
            <div class="col-md-4">
            <br><br><br>
            <?php if(isset($mensaje)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>
                <form class="card card-body" method="POST">
                    <div class="form-group">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control"  name="usuario" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control"  name="contraseña" placeholder="Ingresar Password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Ingresar al administrador</button>
                </form>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>