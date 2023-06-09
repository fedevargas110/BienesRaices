<?php

    require '../includes/app.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../index.php');
    }
    
    //Importar clases
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

        $tipo = $_POST['tipo'];
        
        if(validandoTipo($tipo)) {
            //Comparar lo que vamos a eliminar
            if($tipo === 'vendedor') {
                $vendedores = Vendedores::find($id);
                $vendedores->eliminar();
            }else if($tipo === 'propiedad') {
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            }
        }
    }
}


  include '../includes/templates/header.php';
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
       
        <?php 
            $mensaje = mostrarMensajes( intval($resultado) ); //El intval es para el resultado convertirlo en int 
            if($mensaje) { ?> 
                <p class="alerta exito"> <?php echo s($mensaje) ?></p>
           <?php } ?> 

        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="vendedores/crear.php" class="boton boton-amarillo">Registrar Vendedor(a)</a>

            <h2>Propiedades</h2>

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
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">       
                        </form>
                        
                        <a href="propiedades/actualizar.php?id=<?php echo $prop->id; ?>" class="boton-verde-block">Actulizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!--Mostrar los resultados-->
                <?php foreach( $vendedores as $vendedor ) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">       
                        </form>
                        
                        <a href="vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-verde-block">Actulizar</a>
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