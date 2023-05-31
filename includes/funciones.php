<?php

define('TEMPLATES_URL', __DIR__ . '/templates'); //Lo que hace dir es que php busque automaticamnte la ruta del archivo
define('FUNCIONES_URL', __DIR__ .  'funciones.php');
define('CARPETAS_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTempate ($nombre, $inicio=false) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAuthenticado() : bool {
    session_start();

    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}

function debugear($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

//Escapa el HTML 
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}