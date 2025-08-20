<?php

namespace Model;
class Productos extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'categoria_id', 'subcategoria_id', 'nombre', 'descripcion', 'imagen', 'estado', 'fecha_creacion'];

    public $id;
    public $categoria_id;
    public $subcategoria_id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $estado;
    public $fecha_creacion;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->categoria_id = $args['categoria_id'] ?? '';
        $this->subcategoria_id = $args['subcategoria_id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->estado = $args['estado'] ?? 1;
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
