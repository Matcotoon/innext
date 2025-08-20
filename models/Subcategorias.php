<?php 

namespace Model;

class Subcategorias extends ActiveRecord {
    protected static $tabla = 'subcategorias';
    protected static $columnasDB = ['id', 'categoria_id', 'nombre', 'descripcion', 'estado', 'fecha_creacion'];

    public $id;
    public $categoria_id;
    public $nombre;
    public $descripcion;
    public $estado;
    public $fecha_creacion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->categoria_id = $args['categoria_id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estado = $args['estado'] ?? 1; // Activo por defecto
        $this->fecha_creacion = $args['fecha_creacion'] ?? date('Y-m-d'); // Fecha actual por defecto
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es obligatorio';
        }

        if (!$this->categoria_id) {
            self::$alertas['error'][] = 'Debe seleccionar una categoría';
        }
        return self::$alertas;
    }
}
