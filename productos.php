<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
//metodo para recuperar todos los registros y poder almacenarlos en una variable 
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<h2 class="text-center mt-5 mb-5">Nuestros productos</h2>
<?php foreach($listaProductos as $producto) { ?>
<div class="container">
<div class="row">
<div class="col-md-4">
    <div class="card" style="width:18rem;">
        <img src="./img/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>

            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            <button class="btn btn-primary">Ver mas</button>
        </div>
    </div>
</div>
</div>
</div>
<?php } ?>


<?php include("template/pie.php"); ?>