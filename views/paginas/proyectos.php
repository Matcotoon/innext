<h2 class="proyectos__heading"><?php echo $titulo; ?></h2>

<div class="lista-proyectos">
    <?php foreach ($proyectos as $proyecto): ?>
        <div class="proyecto-card">
            <div class="proyecto-imagen">
                <img class="proyecto__imagen" 
                src="/build/img/proyectos/<?php echo $proyecto->imagen; ?>.webp"
                srcset="/build/img/proyectos/<?php echo $proyecto->imagen; ?>.webp"
                alt="Imagen de <?php echo $proyecto->nombre; ?>">
            </div>
            <div class="proyecto-info">
                <h2><?php echo htmlspecialchars($proyecto->nombre); ?></h2>
                <ul>
                    <?php 
                    $lineas = explode("\n", $proyecto->descripcion); // dividir por salto de línea
                    foreach ($lineas as $linea) {
                        $linea = trim($linea); // quitar espacios extra
                        if ($linea !== '') {   // evitar líneas vacías
                            echo '<li>' . htmlspecialchars($linea) . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>