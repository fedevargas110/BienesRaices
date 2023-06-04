<?php
 use App\Propiedad;

 if($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $propiedad = Propiedad::all();
 }else {
    $propiedad = Propiedad::get(3);
 }

?>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <div class="contenedor-anuncios">
        <?php foreach($propiedad as $prop) { ?>
        <div class="card">
            
            <img class="foto-anuncio" loading="lazy" src="../../../bienesraices_inicio/imagenes/<?php echo $prop->imagen?>" alt="anuncio">
                                                
            <div class="contenido-anuncio">
                <h3><?php echo $prop->titulo?></h3>
                <p><?php echo $prop->descripcion?></p>
                <p class="precio"><?php echo $prop->precio?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                        <p><?php echo $prop->wc?></p>
                    </li>
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                        <p><?php echo $prop->estacionamiento?></p>
                    </li>
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                        <p><?php echo $prop->habitaciones?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $prop->id?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div><!--contenido-anuncios-->
        </div> <!--card-->
        <?php } ?>
    </div> <!--contenedor-anuncios-->

