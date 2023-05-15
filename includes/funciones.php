<?php

require 'app.php';

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