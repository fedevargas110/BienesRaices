<?php
//BD
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

//Authenticar usuario

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        if(!$email) {
            $errores[] = 'El email es incorrecto o no es válido';
        }

        if(!$password) {
            $errores[] = 'Es obligatoria una contraseña';
        }

        if(empty($errores)) {
            //Revisar si el usuario existe

            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);


            if( $resultado->num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['contrasena']);

                if($auth == true) {
                    //SI todo es correcto
                    session_start();

                    //Llenar el arreglo de session
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: ./admin/index.php');

                }else {
                    $errores[] = 'La contraseña es incorrecta';
                }

            }else {
                $errores[] = 'El usuario no existe.';
            }
        }
    }


    include './includes/templates/header.php';
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php if($auth) : ?>
            <div class="alerta exito">Iniciaste Sesión con exito</div>
        <?php endif; ?>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>    

        <form method="POST" class="formulario">
        <fieldset>
                <legend>E-Mail y Password</legend>

                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" placeholder="Email">

                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Contraseña">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php 
    include './includes/templates/footer.php';
?>