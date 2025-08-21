<main class="servicios">
    <h2 class="servicios__heading"><?php echo $titulo; ?></h2>
    <!-- <p class="servicios__descripcion">Conoce todo lo que INNEXT puede hacer por tu industria</p> -->

    <div class="servicios__listado">
        <?php foreach ($servicios as $servicio): ?>
            <?php if (!empty($servicio->imagen1)): ?>
                <div class="servicios__card">
                    
                    <div class="servicios__flip">
                        <!-- Cara frontal con imagen de fondo -->
                        <div class="servicios__front" style="background-image: url('/build/img/servicios/<?php echo $servicio->imagen1; ?>.webp');">
                            <div class="servicios__front-contenido">
                                <h3 class="servicios__nombre"><?php echo $servicio->nombre; ?></h3>
                                <button class="servicios__boton">Ver más</button>
                            </div>
                        </div>

                        <!-- Cara trasera con descripción -->
                        <div class="servicios__back">
                            <p class="servicios__descripcion--texto"><?php echo $servicio->descripcion; ?></p>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</main>
