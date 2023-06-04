<?php

namespace App;

class Vendedores extends ActiveRecords{

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    //Definiendo Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //Definiendo el constructor que accede a los atributos
    public function __construct($args=[])
{
    $this->id = $args['id'] ?? NULL;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
}
   
}