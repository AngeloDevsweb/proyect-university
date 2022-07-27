<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location:../index.php");
    }

    else{
        if($_SESSION['usuario']=="ok"){
            $nombreUsuario = $_SESSION["nombreUsuario"];
        }
    }
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <!-- recuperando informacion para poder redireccionar -->

    <?php $url = "http://".$_SERVER['HTTP_HOST']."/proyecto" ?>
    <!-- cierrre -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url; ?>/administrador/seccion/productos.php">productos</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar sesion</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url ?>">sitio web</a>
                </li> -->
                
            </ul>
            
        </div>
    </nav>



    <div class="container">
        <br>
        <div class="row">