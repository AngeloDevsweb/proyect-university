<?php include('../template/cabecera.php') ?>

<?php
// print_r($_POST);
// print_r($_FILES);

// validacion de la informacion que llega
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

// echo $txtID;
// echo $txtNombre;
// echo $txtImagen;
// echo $accion;

//incluimos  la conexion  a la base de datos
include("../config/bd.php");
// evaluar las acciones 

switch ($accion) {
    case 'Agregar':
        # code...
        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (nombre,imagen) VALUES (:nombre,:imagen);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
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

        header("Location:productos.php");
        break;

    case 'Modificar':
        # code...
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET nombre=:nombre WHERE id = :id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $fecha = new DateTime();
            //
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // luego debemos eliminar la imagen antigua 
            // con las mismas intruccion de borrado
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM producto WHERE id = :id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            //metodo para recuperar todos los registros y poder almacenarlos en una variable 
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $producto["imagen"])) {
                    // con esta instruccion borrar el archivo de nuestra carpeta img
                    unlink("../../img/" . $producto["imagen"]);
                }
            }


            $sentenciaSQL = $conexion->prepare("UPDATE producto SET imagen=:imagen WHERE id = :id");
            $sentenciaSQL->bindParam(':imagen', $txtImagen);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header("Location:productos.php");
            
        }

        break;

    case 'Cancelar':
        # code...
        header("Location:productos.php");
        break;

    case 'Seleccionar':
        # code...
        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        //metodo para recuperar todos los registros y poder almacenarlos en una variable 
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre = $producto['nombre'];
        $txtImagen = $producto['imagen'];
        break;

    case 'Borrar':
        # code...
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM producto WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        //metodo para recuperar todos los registros y poder almacenarlos en una variable 
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $producto["imagen"])) {
                // con esta instruccion borrar el archivo de nuestra carpeta img
                unlink("../../img/" . $producto["imagen"]);
            }
        }
        // y con este bloque eliminamos el registro de la base de datos para que ambos reflejen lo mismo
        $sentenciaSQL = $conexion->prepare("DELETE FROM producto WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location:productos.php");

        break;

    default:
        # code...
        break;
}
// pintar la informacion de la base de datos 
//HACEMOS LA CONSULTA  A LA BASE DE DATOS
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
//metodo para recuperar todos los registros y poder almacenarlos en una variable 
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h4>datos del producto</h4>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" readonly disabled  class="form-control" value="<?php echo $txtID; ?>" name="txtID" placeholder="Enter ID">

                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" placeholder="Enter Nombre">

                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Imagen</label>
                    <?php echo $txtImagen; ?>
                    <input type="file" class="form-control" name="txtImagen">

                </div>


                <div class="btn-group mt-3" role="group">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")? "disabled":""; ?> value="Agregar" class="btn btn-primary">Agregar </button>
                    <!-- <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")? "disabled":"";?> value="Modificar" class="btn btn-secondary">modificar </button> -->
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")? "disabled":"";?> value="Cancelar" class="btn btn-warning">Cancelar </button>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="col-md-7">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $Libro) { ?>
                <tr>

                    <td><?php echo $Libro['id']; ?></td>
                    <td><?php echo $Libro['nombre']; ?></td>
                    <td>
                        <img src="../../img/<?php echo $Libro['imagen']; ?>" width="50" height="50" alt="">
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $Libro['id'];  ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-success">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include('../template/pie.php') ?>