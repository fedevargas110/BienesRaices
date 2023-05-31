<?php

use App\Propiedad;

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

        debugear($propiedad);
        
        $errores = $propiedad->validar();
        
        //Revisar que el arrelgo de errores este vacio asi se procede a insertar en BD

        if(empty($errores)) {

            //Creando carpeta donde se guardaran las imagenes

            $carpetaImagenes = "../../imagenes/";

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }


            //Creando $nombreImagen vacio para que no elimine en caso de no actualizar imagen
            $nombreImagen = '';

            //Eliminando imagen previa
            if($imagen['name']) {
                unlink($carpetaImagenes . $propiedadn['imagen']);

                //Crendo nombres unicos y random a nuestras imagenes
                $nombreImagen = md5(uniqid(rand(), true));  

                //Subiendo la imagen a la carpeta ya creada anteriormente
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");
            }else {
                $nombreImagen = $propiedadn['imagen'];
            }
            
            //Insertando los valores mediante SQL 

            $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedores_id = ${vendedores_id} WHERE id = ${id}";

            //echo $query;

            $resultado = mysqli_query($db, $query);

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