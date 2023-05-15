<?php 
//Hacer la conexion con la base de datos
require './includes/config/database.php';
$db = conectarDB();

//Definir variables
$email = 'correo@correo.com';
$password = '123456';

//Hashear password

$passwordHasheada = password_hash($password, PASSWORD_DEFAULT);

//Insertar variables a la tabla usuarios
$consulta = "INSERT INTO usuarios (email, contrasena) VALUES ('${email}', '${passwordHasheada}');";


mysqli_query($db, $consulta);
