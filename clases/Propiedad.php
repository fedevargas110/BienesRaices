<?php

namespace App;

class Propiedad extends ActiveRecords{
    
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    //Definiendo Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    //Definiendo el constructor que accede a los atributos
    public function __construct($args=[])
{
    $this->id = $args['id'] ?? NULL;
    $this->titulo = $args['titulo'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->creado = date('Y/m/d');
    $this->vendedores_id = $args['vendedor'] ?? '';
}

public function validar() {
    if(!$this->titulo) {
        self::$errores[] = "Debes añadir un titulo";
    }

    if(!$this->precio) {
        self::$errores[] = "El Precio es Obligatorio";
    }

    if(!$this->descripcion) {
        self::$errores[] = "Debes añadir una descripcion";
    }

    if(!$this->habitaciones) {
        self::$errores[] = "Debes añadir un numero de habitaciones";
    }

    if(!$this->wc) {
        self::$errores[] = "Debes añadir un numero de baños";
    }

    if(!$this->estacionamiento) {
        self::$errores[] = "Debes añadir un numero de estacionamientos";
    }

    if(!$this->vendedores_id) {
        self::$errores[] = "Debes elejir un vendedor";
    }

    if(!$this->imagen) {
        self::$errores[] = "La imagen es obligatoria";
    }
    return self::$errores;
}
}