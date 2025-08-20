<?php 

namespace Model;

class TipoProducto extends ActiveRecord {
    protected static $tabla = 'tipos_producto';
    protected static $columnasDB = ['id', 'producto_id', 'nombre', 'descripcion', 'estado'];

    public $id;
    public $producto_id;
    public $nombre;
    public $descripcion;
    public $estado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estado = $args['estado'] ?? 1; // Activo por defecto
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es obligatorio';
        }

        if (!$this->producto_id) {
            self::$alertas['error'][] = 'Debe seleccionar un producto';
        }

        return self::$alertas;
    }
}
