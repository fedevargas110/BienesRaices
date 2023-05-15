<?php
    include './includes/templates/header.php';
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoracíon de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span> 30/03/23</span> por: <span> Fede Vargas</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Adipisci inventore non, nisi quia asperiores optio nemo laudantium quos debitis quam 
                 repellendus enim quis eius corrupti maxime iure nesciunt voluptatem dignissimos?</p>
                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Adipisci inventore non, nisi quia asperiores optio nemo laudantium quos debitis quam 
                    repellendus enim quis eius corrupti maxime iure nesciunt voluptatem dignissimos?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Adipisci inventore non, nisi quia asperiores optio nemo laudantium quos debitis quam 
                        repellendus enim quis eius corrupti maxime iure nesciunt voluptatem dignissimos?</p>
        </div>
    </main>

<?php 
    include './includes/templates/footer.php';
?>