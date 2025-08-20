<?php

namespace Controllers;

use MVC\Router;
use Model\Servicios;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class ServiciosController {

    public static function index(Router $router) {

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/servicios?page=1');
        }

        $registros_por_pagina = 6;
        $total = Servicios::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/servicios?page=1');
        }

        $servicios = Servicios::paginar($registros_por_pagina, $paginacion->offset());


        if(!is_admin()) {
            header('Location: /login');
        }
        
        //debuguear($servicios); 
        // Render a la vista 
        $router->render('/admin/servicios/index', [
            'titulo' => 'Servicios Innext',
            'servicios' => $servicios,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $servicio = new Servicios;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!is_admin()) {
            header('Location: /login');
        }

            //Leer imagen
            if(!empty($_FILES['imagen1']['tmp_name'])){
                $carpeta_imagenes = '../public/img/servicios';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                //Generar nombre unico para la imagen
                $imagen_png = Image::make($_FILES['imagen1']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen1']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen1'] = $nombre_imagen;
            }

            $servicio->sincronizar($_POST);

            //Validar alertas
            $alertas = $servicio->validar();

            //Guardar el registro
            if(empty($alertas)){

                //Guardar las imagenes
                $imagen_png->save(($carpeta_imagenes . '/' . $nombre_imagen . '.png'));
                $imagen_webp->save(($carpeta_imagenes . '/' . $nombre_imagen . '.webp'));

                //Guardar en la base de datos
                $resultado = $servicio->guardar();
                if($resultado) {
                    header('Location: /admin/servicios');
                }
            }
        }
        
        $router->render('/admin/servicios/crear', [
            'titulo' => 'Registrar Servicio',
            'alertas' => $alertas,
            'servicios' => $servicio
        ]);
    }

    public static function editar(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];

        // Validar el id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/servicios');
        }

        // Obtener el servicio a editar
        $servicio = Servicios::find($id);

        if (!$servicio) {
            header('Location: /admin/servicios');
        }

        $servicio->imagen_actual = $servicio->imagen1;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
            header('Location: /login');
        }

            $carpeta_imagenes = '../public/img/servicios';

            // Leer nueva imagen
            if (!empty($_FILES['imagen1']['tmp_name'])) {

                // Crear carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                // Eliminar imágenes anteriores
                if ($servicio->imagen1) {
                    $archivo_png = $carpeta_imagenes . '/' . $servicio->imagen1 . '.png';
                    $archivo_webp = $carpeta_imagenes . '/' . $servicio->imagen1 . '.webp';

                    if (file_exists($archivo_png)) {
                        unlink($archivo_png);
                    }
                    if (file_exists($archivo_webp)) {
                        unlink($archivo_webp);
                    }
                }

                // Generar nueva imagen
                $imagen_png = Image::make($_FILES['imagen1']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen1']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen1'] = $nombre_imagen;

            } else {
                // No se cargó una nueva imagen, se mantiene la anterior
                $_POST['imagen1'] = $servicio->imagen1;
            }

            // Sincronizar y validar
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {

                // Guardar nuevas imágenes si se cargaron
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }

                $resultado = $servicio->guardar();
                if ($resultado) {
                    header('Location: /admin/servicios');
                }
            }
        }

        $router->render('/admin/servicios/editar', [
            'titulo' => 'Actualizar Servicio',
            'alertas' => $alertas,
            'servicios' => $servicio
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
                $servicio = Servicios::find($id);

                if ($servicio) {
                    // Eliminar imágenes del servidor
                    $carpeta_imagenes = '../public/img/servicios';
                    $archivo_png = $carpeta_imagenes . '/' . $servicio->imagen1 . '.png';
                    $archivo_webp = $carpeta_imagenes . '/' . $servicio->imagen1 . '.webp';

                    if (file_exists($archivo_png)) {
                        unlink($archivo_png);
                    }
                    if (file_exists($archivo_webp)) {
                        unlink($archivo_webp);
                    }

                    // Eliminar el servicio de la base de datos
                    $resultado = $servicio->eliminar();
                    if ($resultado) {
                        header('Location: /admin/servicios');
                    }
                }
            }
        }
    }
    

}