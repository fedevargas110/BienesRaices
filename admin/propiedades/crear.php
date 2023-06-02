<?php
    require '../../includes/app.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../../index.php');
    }

    include '../../includes/templates/header.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;


    //Base de Datos
    $db = conectarDB();

    $propiedad = new Propiedad;

//Mostrar los vendedores desde la base de datos
$consulta = "SELECT * FROM vendedores;";

$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getError();


//Printeando los valores en el servidor
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Creanodo instancia de Propiedad cuando se manda el POST
        $propiedad = new Propiedad($_POST['propiedad']);
        
        //Crendo nombres unicos y random a nuestras imagenes
        $nombreImagen = md5(uniqid(rand(), true)) . '.png';
       
        //Setear la imagen
        //Relaizando un resize a la imagen
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        
        //Validando
        $errores = $propiedad->validar();
        
        //Revisar que el arrelgo de errores este vacio asi se procede a insertar en BD
        if(empty($errores)) {
           
            //Crear la carpeta
            if(!is_dir(CARPETAS_IMAGENES)) {
                mkdir(CARPETAS_IMAGENES);
            }
            
            //Guarda la imagen en el servidor
            $image->save(CARPETAS_IMAGENES . $nombreImagen);

            //Guarda en la BD
           $propiedad->guardar();
        }
    }

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/bienesraices_inicio/admin/index.php" class="boton boton-verde">Volver al Admin</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
             
            <!--Los agrego desde Templates-->
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    include '../../includes/templates/footer.php';
?>