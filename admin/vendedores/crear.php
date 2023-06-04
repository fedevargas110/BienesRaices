<?php
require '../../includes/app.php';
$auth = estaAuthenticado();

if(!$auth) {
    header('Location: ../../index.php');
}

include '../../includes/templates/header.php';


    //Importando los namespace 
    use App\Vendedores;

    //Definiendo la nueva Instancia de la clase Vendedores
    $vendedor = new Vendedores;

    //Arreglo con mensajes de errores
    $errores = Vendedores::getError();

    //Printeando los valores en el servidor
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

         //Creanodo instancia de Vendedores cuando se manda el POST
         $vendedor = new Vendedores($_POST['vendedores']);

        //Validando
        $errores = $vendedor->validar();

        //Revisar que el arrelgo de errores este vacio asi se procede a insertar en BD
        if(empty($errores)) {
            //Guarda en la BD
           $vendedor->guardar();
        }
    }

?>


<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        <a href="/bienesraices_inicio/admin/index.php" class="boton boton-verde">Volver al Admin</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" action="../vendedores/crear.php">
             
            <!--Los agrego desde Templates-->
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

<?php 
    include '../../includes/templates/footer.php';
?>