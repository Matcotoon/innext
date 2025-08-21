<?php

namespace Controllers;

use MVC\Router;
use Model\Proyectos;
use Intervention\Image\ImageManagerStatic as Image;

class ProyectosController {

    public static function index(Router $router) {

         $proyectos = Proyectos::all(); // Asegúrate que el modelo tenga este método
        // Render a la vista 
        $router->render('/admin/proyectos/index', [
            'titulo' => 'Proyectos Innext',
            'proyectos' => $proyectos
        ]);
    }

     public static function crear(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $proyecto = new Proyectos;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!is_admin()) {
            header('Location: /login');
        }

            //Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/build/img/proyectos';

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

            $proyecto->sincronizar($_POST);

            //Validar alertas
            $alertas = $proyecto->validar();

            //Guardar el registro
            if(empty($alertas)){

                //Guardar las imagenes
                $imagen_png->save(($carpeta_imagenes . '/' . $nombre_imagen . '.png'));
                $imagen_webp->save(($carpeta_imagenes . '/' . $nombre_imagen . '.webp'));

                //Guardar en la base de datos
                $resultado = $proyecto->guardar();
                if($resultado) {
                    header('Location: /admin/proyectos');
                }
            }
        }
        
        $router->render('/admin/proyectos/crear', [
            'titulo' => 'Registrar Proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto

        ]);
    }

    public static function editar(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
            return;
        }

        $alertas = [];

        // Validar ID
        $id = $_GET['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/proyectos');
            return;
        }

        // Obtener proyecto
        $proyecto = Proyectos::find($id);

        if (!$proyecto) {
            header('Location: /admin/proyectos');
            return;
        }

        $proyecto->imagen_actual = $proyecto->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
                header('Location: /login');
                return;
            }

            $carpeta_imagenes = '../public/build/img/proyectos';

            // Leer nueva imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {

                // Crear carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                // Eliminar imágenes anteriores
                if ($proyecto->imagen) {
                    $archivo_png = $carpeta_imagenes . '/' . $proyecto->imagen . '.png';
                    $archivo_webp = $carpeta_imagenes . '/' . $proyecto->imagen . '.webp';

                    if (file_exists($archivo_png)) unlink($archivo_png);
                    if (file_exists($archivo_webp)) unlink($archivo_webp);
                }

                // Generar nueva imagen
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(1000, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(1000, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $proyecto->imagen;
            }

            // Sincronizar y validar
            $proyecto->sincronizar($_POST);
            $alertas = $proyecto->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }

                $resultado = $proyecto->guardar();
                if ($resultado) {
                    header('Location: /admin/proyectos');
                    return;
                }
            }
        }

        $router->render('/admin/proyectos/editar', [
            'titulo' => 'Actualizar Proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }

    public static function eliminar() {

    if(!is_admin()) {
        header('Location: /login');
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $proyecto = Proyectos::find($id);

            if ($proyecto) {
                $carpeta_imagenes = '../public/build/img/proyectos';
                $archivo_png = $carpeta_imagenes . '/' . $proyecto->imagen . '.png';
                $archivo_webp = $carpeta_imagenes . '/' . $proyecto->imagen . '.webp';

                if (file_exists($archivo_png)) unlink($archivo_png);
                if (file_exists($archivo_webp)) unlink($archivo_webp);

                $resultado = $proyecto->eliminar();
                if ($resultado) {
                    header('Location: /admin/proyectos');
                    return;
                }
            }
        }
    }
}


}