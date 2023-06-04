<?php
require '../../includes/app.php';
$auth = estaAuthenticado();

if(!$auth) {
    header('Location: ../../index.php');
}

  //Validando id seleccionado
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if(!$id) {
      header('Location: ../admin/index.php');
  }


include '../../includes/templates/header.php';


    //Importando los namespace 
    use App\Vendedores;

    //Obtener el arreglo del vendedor desde BD
    $vendedor = Vendedores::find($id);

    //Arreglo con mensajes de errores
    $errores = Vendedores::getError();

    //Printeando los valores en el servidor
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignando los atributos
        $args = $_POST['vendedores'];

        //Aplicando el metodo de sincronizar en memoria
        $vendedor->sincronizar($args);

        //Validando que haya llenado bien las cosas
        $errores = $vendedor->validar();

        //Si no hay errores
        if(empty($errores)) {
            //Guarda en la BD
            $vendedor->guardar();
        }
    }

?>


<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>
        <a href="/bienesraices_inicio/admin/index.php" class="boton boton-verde">Volver al Admin</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST">
             
            <!--Los agrego desde Templates-->
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

<?php 
    include '../../includes/templates/footer.php';
?>