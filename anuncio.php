<?php
    require './includes/app.php';
    include './includes/templates/header.php';

    //conectando base
    $db = conectarDB();

    //Seleccionando id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: ./index.php');
    }


    //consulta
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    //resultado
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows) {
        header('Location: ./index.php');
    }
    
?>

    <main class="contenedor seccion contenido-centrado">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <h1><?php echo $propiedad['titulo'] ?></h1>

            <img loading="lazy" src="./imagenes/<?php echo $propiedad['imagen'] . '.jpg' ?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <div class="precio"><?php  echo  '$' . $propiedad['precio']?></div>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                    <p><?php echo $propiedad['wc'] ?></p>
                </li>
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                    <p><?php echo $propiedad['estacionamiento'] ?></p>
                </li>
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                    <p><?php echo $propiedad['habitaciones'] ?></p>
                </li>
            </ul>

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
    <?php endwhile; ?>
    </main>

<?php 
    mysqli_close($db);
    include './includes/templates/footer.php';
?>