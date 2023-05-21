<?php

namespace App;

class Propiedad {
    
    //Bases de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    //Error
    protected static $errores = [];


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


        //Insertando los valores ya sanitizados mediante SQL 

        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " '); ";

       $resultado = self::$db->query($query);
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

    //Validar Errores
    public static function getError() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "El Precio es Obligatorio";
        }

        if(strlen(!$this->descripcion) < 50 ) {
            self::$errores[] = "Debes añadir una descripcion y que contenga 50 caracteres minimo";
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

//        if(!$this->imagen['name']) {
//            self::$errores[] = "La imagen es obligatoria";
//        }
        return self::$errores;
    }

}