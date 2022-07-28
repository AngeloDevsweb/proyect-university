<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
//metodo para recuperar todos los registros y poder almacenarlos en una variable 
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- aqui empieza la seccion para la cabecera de nuestros productos -->
<div class="fondo-cabecera">
    <br><br><br><br>
    <h2 class="titulo-cabecera">Nuestros productos</h2>
</div>
<br><br><br><br>
<div class="container">
    <div class="row">
    <?php foreach ($listaProductos as $producto) { ?>
    
        
    <div class="col-md-3">
        <div class="card" style="width:18rem;">
            <img src="./img/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $producto['nombre']; ?></h5>

                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>


            </div>
        </div>
    </div>


<?php } ?>
    </div>
</div>



<?php include("template/pie.php"); ?>