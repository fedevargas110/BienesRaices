<?php 


namespace App;

class ActiveRecords {
//Bases de Datos
protected static $db;
protected static $columnasDB = [];
protected static $tabla = '';

//Error
protected static $errores = [];



public function guardar() {
    if(!is_null($this->id)) {
        $this->actualizar();
    }else {
        $this->crear();
    }
}

public function actualizar() {
    //Sanitizar los valores
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach($atributos as $key => $value) {
        $valores[] = "{$key}='{$value}'";
    }
    

    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores); //JOin convierte el array llave valor en un string todo junto
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'; ";

    
    $resultado = self::$db->query($query);

    if ($resultado) {
        //Redireccionar al usuario
        header('Location: /bienesraices_inicio/admin/index.php?resultado=2');
       // echo 'Insertado Correctamente';
    }
}

public function crear() {
    //Sanitizar los Atributos
    $atributos = $this->sanitizarAtributos();

    //Insertando los valores ya sanitizados mediante SQL 
    $query = "INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " '); ";

   $resultado = self::$db->query($query);

    //Mensaje de Exito
    if ($resultado) {
        //Redireccionar al usuario
        header('Location: /bienesraices_inicio/admin/index.php?resultado=1');
       // echo 'Insertado Correctamente';
    }
}

//Metodo para eliminar un registro
public function eliminar() {
    //Eliminar Registro
    $consulta = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
    $result = self::$db->query($consulta);

    if($result) {
        $this->eliminarImagen();
        header('location: /bienesraices_inicio/admin/index.php?resultado=3');
    }

}

//Recorrer el objeto, identificar y unir los atributos de la BD
public function atributos() {
    $atributos = [];
    foreach(static::$columnasDB as $columnas) {
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

//Subida de Archivos
public function setImagen($imagen) {
    //Elimina la imagen anterior
    if(isset($this->id)){
        //Comprobar que el archivo existe
      $this->eliminarImagen(); 
    }

    //Asignar al atributo de la imagen el nombre de la imagen
    if($imagen) {
        $this->imagen = $imagen;
    }
}

//Eliminar Imagen
public function eliminarImagen() {
    $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);

    if($existeArchivo) {
        unlink(CARPETAS_IMAGENES . $this->imagen);//Unlink es para eliminar archivo
    }
}


//Validar Errores
public static function getError() {
    return static::$errores;
}

public function validar() {
    static::$errores = [];
    return static::$errores;
}

//Listar todos los registros
public static function all() {
    $query = "SELECT * FROM " . static::$tabla;

    $resultado = self::constultarSQL($query); //Haciendo la consulta a la BD

    return $resultado;
}

//Listar un numero determinado de props
public static function get($cant) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " .  $cant;

    $resultado = self::constultarSQL($query); //Haciendo la consulta a la BD

    return $resultado;
}

//Busca un registro por su id
public static function find($id) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

    $resultado = self::constultarSQL($query);

    return array_shift($resultado);
}

//
public static function constultarSQL($query) {
    //Consutar la BD
    $resultado = self::$db->query($query);

    //Iterar los resultados
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
        $array[] = static::crearObjeto($registro);
    }

    //Liberar la memoria
    $resultado->free();

    //Return los resultados ya formateados
    return $array;
}

protected static function crearObjeto($registro){
    $objeto = new static;

    foreach($registro as $key => $value) { //este codigo esta tomando un arreglo y esta creando un objeto en memoria que es un espejo de lo que hay en la BD
        if( property_exists( $objeto, $key) ) {
            $objeto->$key = $value;
        }
    }

    return $objeto;
}

//Sincroniza el objeto en memoria
public function sincronizar( $args=[] ) {
    foreach($args as $key => $value){
        if(property_exists($this, $key) && !is_null($value)) {
            $this->$key=$value;
        }
    }
}

}