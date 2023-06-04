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
   
    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "Debes añadir el nombre";
        }
        if(!$this->apellido) {
            self::$errores[] = "Debes añadir el apellido";
        }
        if(!$this->telefono) {
            self::$errores[] = "Debes añadir el telefono";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {//Extencion fija por los //, de 10 dijitos y acepta numeros del 0 al 9
            self::$errores[] = "Debes añadir un telefono que sea de argentina y sea valido";
        }

        return self::$errores;
    }   

}