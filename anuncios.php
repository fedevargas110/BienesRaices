<?php
require 'includes/app.php';
include './includes/templates/header.php';
?>
<main class="contenedor seccion">
    <?php
    $limite = 10;
    include './includes/templates/anuncios.php';
    ?>
</main>

<?php
include './includes/templates/footer.php';
?>