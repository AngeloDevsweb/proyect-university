<?php include("template/cabecera.php"); ?>

<div>
    <!-- seccion carrusel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://cdn.pixabay.com/photo/2022/03/13/15/45/coffee-7066308_960_720.jpg" class="tamaño w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2013/08/11/19/46/coffee-171653_960_720.jpg" class="tamaño w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2015/06/24/01/15/coffee-819362_960_720.jpg" class="tamaño w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- final de la seccion del carrusel -->
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-bg-dark">
                    <img src="https://cdn.pixabay.com/photo/2016/07/23/03/56/love-1536226_960_720.jpg" class="tamano-imagen" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">titulo 1</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card text-bg-dark">
                    <img src="https://cdn.pixabay.com/photo/2017/07/26/02/55/coffe-2540278_960_720.jpg" class="tamano-imagen" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">titulo 2</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- final de los 2 cards -->
    <br><br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="padre">
                    <article>
                        <h3 class="text-center">CAFE CLASICO</h3>

                        <p class="parrafo-tercer">
                            El inconfundible sabor y aroma que todos conocemos y amamos sigue siendo tan bueno como siempre. 
                            Nuestro café de autor tiene un tostado medio oscuro que le da un sabor completo y un sabor maravillosamente vigorizante.</p>
                    </article>
                </div>
            </div>

            <div class="col-md-8">
                <img src="https://cdn.pixabay.com/photo/2015/04/30/23/21/coffee-747601_960_720.jpg" class="rounded" alt="">
            </div>
        </div>
    </div>

    <!-- final de la 3ra seccion -->
    <br><br><br>

    <div class="fondo-down">
        <br><br><br><br><br><br>
        <h2 class="titulo-fondo">El café cultivado respetuosamente sabe mejor</h2>
        <p class="parrafo-fondo">Descubre por qué CAFE es la marca de café más sostenible del mundo</p>
        <p class="text-center mt-4"><a href="productos.php" class="ancla-fondo">Descubre nuestros productos</a></p>
    </div>


    <br><br><br>

    <div class="bg-dark p-5">
        <footer class="text-center text-white">Todos los derechos reservados - Cafe</footer>
    </div>

</div>

<?php include("template/pie.php"); ?>