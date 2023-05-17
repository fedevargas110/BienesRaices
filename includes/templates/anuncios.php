<?php
//Importar la conexion con BD
$db = conectarDB();

//Consultar
$query = "SELECT * FROM propiedades LIMIT ${limite}";

//Obtener resultados
$resultado = mysqli_query($db, $query);

?>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <div class="contenedor-anuncios">
        <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="card">
            
            <img class="foto-anuncio" loading="lazy" src="../../../bienesraices_inicio/imagenes/<?php echo $propiedad['imagen'] . '.jpg' ?>" alt="anuncio">
                                                
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']?></h3>
                <p><?php echo $propiedad['descripcion']?></p>
                <p class="precio"><?php echo $propiedad['precio']?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                        <p><?php echo $propiedad['wc']?></p>
                    </li>
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                        <p><?php echo $propiedad['estacionamiento']?></p>
                    </li>
                    <li>
                        <img class="i-card" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                        <p><?php echo $propiedad['habitaciones']?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad['id']?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div><!--contenido-anuncios-->
        </div> <!--card-->
        <?php endwhile; ?>
    </div> <!--contenedor-anuncios-->

<?php mysqli_close($db); ?>
