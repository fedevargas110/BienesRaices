<?php

    require '../includes/app.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../index.php');
    }

    use App\Propiedad;
    use App\Vendedores;

//Implementar un metodo para obtener todas las propiedades
$propiedad = Propiedad::all();
$vendedores = Vendedores::all();


$resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
        
        $propiedad = Propiedad::find($id);
        
        $propiedad->eliminar();

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
                <?php foreach( $propiedad as $prop ) : ?>
                <tr>
                    <td><?php echo $prop->id; ?></td>
                    <td><?php echo $prop->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $prop->imagen; ?>" alt="Imagen Propiedad" class="Imagen-tabla"></td>
                    <td>$ <?php echo $prop->precio; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $prop->id; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">       
                        </form>
                        
                        <a href="propiedades/actualizar.php?id=<?php echo $prop->id; ?>" class="boton-verde-block">Actulizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
//Cerrar la conexion

mysqli_close($db);
    include '../includes/templates/footer.php';
?>