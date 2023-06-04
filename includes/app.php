<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ .  './../vendor/autoload.php';

//Conectar a la BD
$db = conectarDB();

use App\ActiveRecords;

ActiveRecords::setDB($db);

