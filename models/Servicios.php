<?php 

namespace Model;

class Servicios extends ActiveRecord {
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'imagen1'];

    public $id;
    public $nombre;
    public $descripcion;
    public $imagen1;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen1 = $args['imagen1'] ?? '';
    }


    public function validar() {
    if(!$this->nombre) {
        self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->descripcion) {
        self::$alertas['error'][] = 'La Descripcion del Servicio es Obligatoria';
    }
    if(!$this->imagen1) {
        self::$alertas['error'][] = 'La imagen es obligatoria';
    }


    return self::$alertas;
}
}