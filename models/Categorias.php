<?php 

namespace Model;

class Categorias extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'estado', 'fecha_creacion'];

    public $id;
    public $nombre;
    public $descripcion;
    public $estado;
    public $fecha_creacion;

    public function __construct($args = [])
{
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->estado = $args['estado'] ?? 1;
    $this->fecha_creacion = $args['fecha_creacion'] ?? date('Y-m-d'); // Fecha actual por defecto
}


    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es obligatorio';
        }
        return self::$alertas;
    }
}
