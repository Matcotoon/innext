<?php

namespace Controllers;

use MVC\Router;
use Model\Productos;
use Model\Categorias;
use Classes\Paginacion;
use Model\TipoProducto;
use Model\Subcategorias;
use Intervention\Image\ImageManagerStatic as Image;


class ProductosController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/productos?page=1');
        }

        $registros_por_pagina = 10;
        $total = Productos::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/productos?page=1');
        }

        $productos = Productos::paginar($registros_por_pagina, $paginacion->offset());

    // Asignar la categoría asociada a cada producto
    foreach ($productos as $producto) {
        $categoria = Categorias::find($producto->categoria_id);
        $producto->categoria = $categoria ? $categoria->nombre : 'Sin categoría';
    }

    foreach ($productos as $producto) {
        $subcategoria = Subcategorias::find($producto->subcategoria_id);
        $producto->subcategoria = $subcategoria ? $subcategoria->nombre : 'Sin subcategoría';
    }

    $router->render('/admin/productos/index', [
        'titulo' => 'Productos Innext',
        'productos' => $productos,
        'paginacion' => $paginacion->paginacion()
    ]);
}

    public static function crear(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $producto = new Productos;
        $categorias = Categorias::all();
        $subcategoria = Subcategorias::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!is_admin()) {
            header('Location: /login');
        }

            //Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/build/img/productos';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                //Generar nombre unico para la imagen
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }

            $producto->sincronizar($_POST);

            //Validar alertas
            $alertas = $producto->validar();

            //Guardar el registro
            if(empty($alertas)){

                //Guardar las imagenes
                $imagen_png->save(($carpeta_imagenes . '/' . $nombre_imagen . '.png'));
                $imagen_webp->save(($carpeta_imagenes . '/' . $nombre_imagen . '.webp'));

                //Guardar en la base de datos
                $resultado = $producto->guardar();
                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }
        
        $router->render('/admin/productos/crear', [
            'titulo' => 'Crear Producto',
            'alertas' => $alertas,
            'productos' => $producto,
            'categorias' => $categorias,
            'subcategorias' => $subcategoria,
        ]);
    }

        public static function crearcat(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $categoria = new Categorias;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $resultado = $categoria->guardar();
                if ($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('/admin/productos/crearcat', [
            'titulo' => 'Crear Categoría',
            'alertas' => $alertas,
            'categoria' => $categoria
        ]);
    }

    public static function crearsub(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $subcategoria = new Subcategorias;

        // Obtener las categorías existentes para el select
        $categorias = Categorias::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subcategoria->sincronizar($_POST);
            $alertas = $subcategoria->validar();

            if (empty($alertas)) {
                $resultado = $subcategoria->guardar();
                if ($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('/admin/productos/crearsub', [
            'titulo' => 'Crear Subcategoría',
            'alertas' => $alertas,
            'subcategoria' => $subcategoria,
            'categorias' => $categorias
        ]);
    }

    public static function editar(Router $router) {

    if (!is_admin()) {
        header('Location: /login');
        return;
    }

    $alertas = [];

    // Validar ID
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin/productos');
        return;
    }

    // Obtener producto
    $producto = Productos::find($id);

    if (!$producto) {
        header('Location: /admin/productos');
        return;
    }

    $producto->imagen_actual = $producto->imagen;

    // Obtener categorías y subcategorías
    $categorias = Categorias::all();
    $subcategorias = Subcategorias::all();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!is_admin()) {
            header('Location: /login');
            return;
        }

        $carpeta_imagenes = '../public/build/img/productos';

        // Procesar imagen si hay nueva
        if (!empty($_FILES['imagen']['tmp_name'])) {

            if (!is_dir($carpeta_imagenes)) {
                mkdir($carpeta_imagenes, 0777, true);
            }

            // Eliminar imágenes anteriores
            if ($producto->imagen) {
                $archivo_png = $carpeta_imagenes . '/' . $producto->imagen . '.png';
                $archivo_webp = $carpeta_imagenes . '/' . $producto->imagen . '.webp';

                if (file_exists($archivo_png)) unlink($archivo_png);
                if (file_exists($archivo_webp)) unlink($archivo_webp);
            }

            // Nueva imagen
            $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(1000, 800)->encode('png', 80);
            $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(1000, 800)->encode('webp', 80);

            $nombre_imagen = md5(uniqid(rand(), true));
            $_POST['imagen'] = $nombre_imagen;
        } else {
            $_POST['imagen'] = $producto->imagen;
        }

        // Sincronizar y validar
        $producto->sincronizar($_POST);
        $alertas = $producto->validar();

        if (empty($alertas)) {
            if (isset($nombre_imagen)) {
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
            }

            $resultado = $producto->guardar();
            if ($resultado) {
                header('Location: /admin/productos');
                return;
            }
        }
    }

    $router->render('/admin/productos/editar', [
        'titulo' => 'Actualizar Producto',
        'alertas' => $alertas,
        'producto' => $producto,
        'categorias' => $categorias,
        'subcategorias' => $subcategorias
    ]);
}

public static function eliminar() {

        if(!is_admin()) {
            header('Location: /login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
            header('Location: /login');
        }
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // Obtener el servicio a eliminar
                $producto = Productos::find($id);

                if ($producto) {
                    // Eliminar imágenes del servidor
                    $carpeta_imagenes = '../public/build/img/productos';
                    $archivo_png = $carpeta_imagenes . '/' . $producto->imagen . '.png';
                    $archivo_webp = $carpeta_imagenes . '/' . $producto->imagen . '.webp';

                    if (file_exists($archivo_png)) {
                        unlink($archivo_png);
                    }
                    if (file_exists($archivo_webp)) {
                        unlink($archivo_webp);
                    }

                    // Eliminar el servicio de la base de datos
                    $resultado = $producto->eliminar();
                    if ($resultado) {
                        header('Location: /admin/productos');
                    }
                }
            }
        }
    }

}