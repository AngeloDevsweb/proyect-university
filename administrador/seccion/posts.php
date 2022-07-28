<?php include('../template/cabecera.php') ?>

<!-- logica de la ui -->
<?php

// validacion de la informacion
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

//incluimos  la conexion  a la base de datos
include("../config/bd.php");


//evaluar las acciones
switch ($accion) {
    case 'Agregar':
        # code...
        $sentenciaSQL = $conexion->prepare("INSERT INTO posts (titulo,descripcion,imagen) VALUES (:titulo,:descripcion,:imagen);");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);

        // a partir de aqui se genera una instruccion de subida de la imagen
        $fecha = new DateTime();
        // capturamos la fecha para poder añadirla junto a la imagen 
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        // luego de almacenarla la capturamos en un archivo temporal
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        // y por ultimo le decimos a que destino la va a subir en este caso la carpeta img de mi estructura de archivos
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();

        // hacermos una redireccion 
        header("Location:posts.php");

        break;
    case 'Borrar':

        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM posts WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        //metodo para recuperar el registro y almacenarlo en una variable 
        $post = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($post["imagen"]) && ($post["imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $post["imagen"])) {
                // con esta instruccion borrar el archivo de nuestra carpeta img
                unlink("../../img/" . $post["imagen"]);
            }
        }

        // y con este bloque eliminamos el registro de la base de datos para que ambos reflejen lo mismo
        $sentenciaSQL = $conexion->prepare("DELETE FROM posts WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location:posts.php");

        break;
    case 'Cancelar':
        # code...
        header("Location:posts.php");
        break;
    default:
        # code...
        break;
}


// pintar la informacion de la base de datos 
//HACEMOS LA CONSULTA  A LA BASE DE DATOS
$sentenciaSQL = $conexion->prepare("SELECT * FROM posts");
$sentenciaSQL->execute();
//metodo para recuperar todos los registros y poder almacenarlos en una variable 
$listaPosts = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- estructura de la UI  -->

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h2>Datos del post</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" required name="txtTitulo" class="form-control" placeholder="ingresar titulo">
                <textarea name="txtDescripcion" required id="" rows="10" placeholder="ingresar contenido" class="form-control mt-3"></textarea>
                <input type="file" required class="form-control mt-3" name="txtImagen">

                <div class="btn-group mt-3" role="group">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">Agregar </button>
                    <!-- <button type="submit" name="accion"  value="Modificar" class="btn btn-secondary">modificar </button> -->
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-warning">Cancelar </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="col-md-8">
    <h4 class="text-center">Vista del post</h4>
    <br>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($listaPosts as $post) { ?>
            <div class="carousel-item active">
                <form method="POST">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $post['id'];  ?>">
                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                </form>

                <h5 class="mt-2"><?php echo $post['titulo'] ?></h5>
                <img src="../../img/<?php echo $post['imagen']; ?>" width="600" height="500" alt="">
                <p class="mt-2 "><?php echo $post['descripcion'] ?></p>
            </div>

            <?php } ?>
            
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button> -->
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


</div>




<?php include('../template/pie.php') ?>