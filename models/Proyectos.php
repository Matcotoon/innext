<?php 

namespace Model;

class Proyectos extends ActiveRecord {
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'imagen'];

    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }


    public function validar() {
    if(!$this->nombre) {
        self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->descripcion) {
        self::$alertas['error'][] = 'La Descripcion del Proyecto es Obligatoria';
    }
    if(!$this->imagen) {
        self::$alertas['error'][] = 'La imagen es obligatoria';
    }


    return self::$alertas;
}
}