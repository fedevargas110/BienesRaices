<?php

    require '../includes/funciones.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../index.php');
    }

// Importar la conexion
require '../includes/config/database.php';
$db = conectarDB();

//Escribir la query
$query = 'SELECT * FROM propiedades';

//Consutar la BD
$resultadoConsulta = mysqli_query($db, $query);


  $resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
        
        //ELiminar archivo
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";

        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen'] . '.jpg');

        //Eliminar propiedad

        $consulta = "DELETE FROM propiedades WHERE id = ${id};";
        $result = mysqli_query($db, $consulta);

        if($result) {
            header('location: /bienesraices_inicio/admin/index.php?resultado=3');
        }
    }
}


  include '../includes/templates/header.php';
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado == 1): ?>
            <p class="alerta exito">La Propiedad ha sido creada correctamente</p>
        <?php elseif($resultado == 2): ?>
            <p class="alerta exito">La Propiedad ha sido actualizada con exito</p>
        <?php elseif($resultado == 3): ?>
            <p class="alerta exito">La Propiedad ha sido eliminada con exito</p>
        <?php endif;  ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!--Mostrar los resultados-->
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad['imagen']; ?>.jpg" alt="Imagen Propiedad" class="Imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">       
                        </form>
                        
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actulizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php 
//Cerrar la conexion

mysqli_close($db);
    include '../includes/templates/footer.php';
?>