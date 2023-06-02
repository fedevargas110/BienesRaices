<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../../index.php');
    }

    include '../../includes/templates/header.php';

    //Validando el id seleccionado
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: ../admin/index.php');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);


//Mostrar los vendedores desde la base de datos
$consulta = "SELECT * FROM vendedores;";

$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getError();

//Printeando los valores en el servidor
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //Asignando los atributos
        $args = $_POST['propiedad'];

        //Aplicando el metodo
        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();
        
        //Subida de archivos

        //Crendo nombres unicos y random a nuestras imagenes
        $nombreImagen = md5(uniqid(rand(), true)) . '.png';

        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el arrelgo de errores este vacio asi se procede a insertar en BD
        if(empty($errores)) {
            //Almacenar IMG nueva
            $image->save(CARPETAS_IMAGENES . $nombreImagen);

            //Guarda en la BD
            $resultado = $propiedad->guardar();

            if ($resultado) {
                //Redireccionar al usuario
                header('Location: /bienesraices_inicio/admin/index.php?resultado=2');
               // echo 'Insertado Correctamente';
            }
        }
    }

?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/bienesraices_inicio/admin/index.php" class="boton boton-verde">Volver al Admin</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    include '../../includes/templates/footer.php';
?>