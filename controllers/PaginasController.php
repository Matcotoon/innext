<?php

namespace Controllers;

use MVC\Router;
use Model\Productos;
use Model\Proyectos;
use Model\Servicios;
use Model\Categorias;
use Classes\Paginacion;
use Model\Subcategorias;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {

        $servicios = Servicios::porIds([9, 8, 10]);
        $productos = Productos::all();

        $router->render('paginas/index', [
            'titulo' => 'Bienvenido a Innext',
            'servicios' => $servicios,
            'productos' => $productos
        ]);

    }

    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros', [
            'titulo' => 'Sobre Nosotros',
        ]);

    }

    public static function productos(Router $router) {

    $productos = Productos::all();
    $categorias = Categorias::all();
    $subcategorias = Subcategorias::all();

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /productos?page=1');
        }

        $registros_por_pagina = 12;
        $total = Productos::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /productos?page=1');
        }

        $productos = Productos::paginar($registros_por_pagina, $paginacion->offset());

    // Mapear subcategorías por ID para acceso rápido
    $mapaSubcategorias = [];
    foreach ($subcategorias as $sub) {
        $mapaSubcategorias[$sub->id] = $sub;
    }

    // Añadir la subcategoría correspondiente a cada producto
    foreach ($productos as $producto) {
        $producto->subcategoria = $mapaSubcategorias[$producto->subcategoria_id] ?? null;
    }

    $router->render('paginas/productos', [
        'titulo' => 'Catalogo de Productos INNEXT',
        'productos' => $productos,
        'categorias' => $categorias,
        'subcategorias' => $subcategorias,
        'paginacion' => $paginacion
    ]);
}


    public static function servicios(Router $router) {

        $servicios = Servicios::all();


        $router->render('paginas/servicios', [
            'titulo' => 'Nuestros Servicios',
            'servicios' => $servicios
        ]);

    }

    public static function proyectos(Router $router) {
        $proyectos = Proyectos::all();
        $router->render('paginas/proyectos', [
            'titulo' => 'Proyectos Realizados',
            'proyectos' => $proyectos
        ]);

    }

    public static function contacto(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $respuestas = $_POST['contacto'];

        // Validar campos mínimos
        $nombre   = trim($respuestas['nombre'] ?? '');
        $email    = trim($respuestas['correo'] ?? '');  // Ajustado al nombre del input
        $telefono = trim($respuestas['telefono'] ?? '');
        $mensaje  = trim($respuestas['mensaje'] ?? '');

        // Crear PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host       = $_ENV['EMAIL_HOST'];        // smtp.hostinger.com
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['EMAIL_USER'];        // tu correo
            $mail->Password   = $_ENV['EMAIL_PASS'];        // contraseña del correo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
            $mail->Port       = $_ENV['EMAIL_PORT'];        // 465

            // Remitente y destinatario
            $mail->setFrom($_ENV['EMAIL_USER'], 'Formulario Web');
            $mail->addAddress($_ENV['EMAIL_USER'], 'Innext-ec.com');

            // Contenido HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = '📩 Nuevo mensaje desde el formulario de contacto';

            $contenido = '<html><body>';
            $contenido .= '<div style="font-family:Arial,sans-serif; color:#333; padding:15px; border:1px solid #ddd; border-radius:8px; background:#f9f9f9;">';
            $contenido .= '<h2 style="color:#0f5138;">📩 Nuevo mensaje desde el formulario</h2>';
            $contenido .= '<p><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</p>';
            $contenido .= '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
            $contenido .= '<p><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</p>';
            $contenido .= '<p><strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($mensaje)) . '</p>';
            $contenido .= '</div></body></html>';

            $mail->Body = $contenido;
            $mail->AltBody = "Nuevo mensaje desde el formulario:\nNombre: $nombre\nEmail: $email\nTeléfono: $telefono\nMensaje: $mensaje";

            // Enviar email
            $mail->send();
            //echo "✅ Mensaje enviado correctamente";

        } catch (\PHPMailer\PHPMailer\Exception $e) {
            //echo "❌ Error al enviar el mensaje: " . $mail->ErrorInfo;
        }
    }

    // Renderizar la vista del formulario
    $router->render('paginas/contacto', [
        'titulo' => 'Contáctanos',
    ]);
}


}