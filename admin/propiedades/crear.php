<?php
    require '../../includes/app.php';
    $auth = estaAuthenticado();

    if(!$auth) {
        header('Location: ../../index.php');
    }

    include '../../includes/templates/header.php';

    use App\Propiedad;


    //Base de Datos
    $db = conectarDB();

//Mostrar los vendedores desde la base de datos
$consulta = "SELECT * FROM vendedores;";

$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];

//Definimos las variables vacias para que guarde lo que se asigna despues del if
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';



//Printeando los valores en el servidor
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Creanod instancia de Propiedad cuando se manda el POST
        $propiedad = new Propiedad($_POST);

        $propiedad->guardar();

        debugear($propiedad);

        //echo '<pre>';
       // var_dump($_POST);
        //echo '</pre>';


        //Accediendo a los valores
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']) ;
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $creado = mysqli_real_escape_string($db, date('Y/m/d'));
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedor']);
        $imagen = $_FILES['imagen'];
        
        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "El Precio es Obligatorio";
        }

        if(strlen(!$descripcion) > 50 ) {
            $errores[] = "Debes añadir una descripcion y que contenga 50 caracteres minimo";
        }

        if(!$habitaciones) {
            $errores[] = "Debes añadir un numero de habitaciones";
        }

        if(!$wc) {
            $errores[] = "Debes añadir un numero de baños";
        }

        if(!$estacionamiento) {
            $errores[] = "Debes añadir un numero de estacionamientos";
        }

        if(!$vendedores_id) {
            $errores[] = "Debes elejir un vendedor";
        }

        if(!$imagen['name']) {
            $errores[] = "La imagen es obligatoria";
        }

       // echo '<pre>';
        //    var_dump($errores);
       // echo '</pre>';
        
        //Revisar que el arrelgo de errores este vacio asi se procede a insertar en BD

        if(empty($errores)) {

            //Creando carpeta donde se guardaran las imagenes

            $carpetaImagenes = "../../imagenes/";

            //Crendo nombres unicos y random a nuestras imagenes
            $nombreImagen = md5(uniqid(rand(), true));

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            
            //Subiendo la imagen a la carpeta ya creada anteriormente
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");

            //echo $query;

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //Redireccionar al usuario
                header('Location: /bienesraices_inicio/admin/index.php?resultado=1');
               // echo 'Insertado Correctamente';
            }
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Nombre:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Nombre de la Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
            </fieldset>
              
            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="" disabled selected>>----Seleccionar----<</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'];?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    include '../../includes/templates/footer.php';
?>