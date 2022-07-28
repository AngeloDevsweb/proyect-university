<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM posts");
$sentenciaSQL->execute();
//metodo para recuperar todos los registros y poder almacenarlos en una variable 
$listaPost = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- empieza la seccion de la ui -->
<!-- aqui empieza la seccion para la cabecera de nuestros productos -->
<div class="fondo-cabecera">
    <br><br><br><br>
    <h2 class="titulo-cabecera">El mejor momento para compartir un cafe</h2>
    <p class="text-center text-white">Comparte tus momentos de cafe con nosotros</p>
</div>
<br><br><br><br>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($listaPost as $post) { ?>

            <div class="col">
                <div class="card">

                    <h5 class="card-title p-2"><?php echo $post['titulo'] ?></h5>

                    <img src="./img/<?php echo $post['imagen'] ?>" class="card-img-top" alt="...">

                    <div class="card-body">
                        <p class="card-text"><?php echo $post['descripcion'] ?></p>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<br><br><br>
<div class="bg-dark p-5">
        <footer class="text-center text-white">Todos los derechos reservados - Cafe</footer>
    </div>

<?php include("template/pie.php"); ?>