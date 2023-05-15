<?php
    include './includes/templates/header.php';
?>

    <main class="contenedor seccion"> <!--NO SE PUEDEN TENER DOS MAIN-->
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt eius, 
                    beatae possimus ducimus voluptate mollitia quis nostrum obcaecati voluptates consectetur odit, 
                    temporibus, alias error nesciunt voluptatibus laboriosam optio qui vitae?</p>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt eius, 
                    beatae possimus ducimus voluptate mollitia quis nostrum obcaecati voluptates consectetur odit, 
                    temporibus, alias error nesciunt voluptatibus laboriosam optio qui vitae?</p>
            </div>
        </div>
    </main>


    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint quo ipsam esse earum sed veritatis ducimus eos? Cum, eligendi natus aliquid temporibus consequatur accusamus itaque nemo, dicta, at nisi minima!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio Justo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint quo ipsam esse earum sed veritatis ducimus eos? Cum, eligendi natus aliquid temporibus consequatur accusamus itaque nemo, dicta, at nisi minima!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint quo ipsam esse earum sed veritatis ducimus eos? Cum, eligendi natus aliquid temporibus consequatur accusamus itaque nemo, dicta, at nisi minima!</p>
            </div>
        </div>
    </section>

<?php 
    include './includes/templates/footer.php';
?>