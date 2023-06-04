<?php
    require './includes/app.php';
    include './includes/templates/header.php';

    use App\Propiedad;

    //Seleccionando id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: ./index.php');
    }

    $propiedad = Propiedad::find($id);
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo ?></h1>

            <img loading="lazy" src="./imagenes/<?php echo $propiedad->imagen?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <div class="precio"><?php  echo  '$' . $propiedad->precio?></div>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                    <p><?php echo $propiedad->wc ?></p>
                </li>
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                    <p><?php echo $propiedad->estacionamiento ?></p>
                </li>
                <li>
                    <img class="i-card" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                    <p><?php echo $propiedad->habitaciones ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad->descripcion ?></p>
        </div>
    </main>

<?php 
    mysqli_close($db);
    include './includes/templates/footer.php';
?>