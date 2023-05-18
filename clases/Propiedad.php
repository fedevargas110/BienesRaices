<?php

namespace App;

class Propiedad {
    
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

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


    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedor'] ?? '';
    }

    public function guardar() {
        //Sanitizar los Atributos
        $atributos = $this->sanitizarAtributos();
        debugear($atributos);


        //Insertando los valores mediante SQL 

        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$this->titulo', '$this->precio','$this->imagen' , '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id'); ";

       $resultado = self::$db->query($query);

       debugear($resultado);
    }

    //Recorrer el objeto, identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columnas) {
            if($columnas === 'id') continue;//Lo que hace es que saltee el primer elemento del foreach
            $atributos[$columnas] = $this->$columnas;
        }
        return $atributos;
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

}