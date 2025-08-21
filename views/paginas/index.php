<main class="index">

    <section class="index__servicios">
        <h2 class="index__servicios-titulo">Servicios</h2>

        <?php foreach ($servicios as $servicio): ?>
            <?php if (!empty($servicio->imagen1)): ?>
                <div class="servicio">

                <div class="servicio__contenido">
                        <h3 class="index__servicios-titulo--tarjeta"><?php echo $servicio->nombre; ?></h3>
                        <p class="index__servicios-descripcion"><?php echo $servicio->descripcion; ?></p>
                    </div>
                    <img src="../build/img/servicios/<?php echo $servicio->imagen1; ?>.webp"
                         srcset="../build/img/servicios/<?php echo $servicio->imagen1; ?> 
                         alt="<?php echo $servicio->nombre; ?>" 
                         class="servicio__imagen">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="index__servicios-boton">
            <a href="/servicios" class="boton boton--primario">Ver servicios</a>
        </div>
    </section>

    <section class="index__marcas">
        <h3 class="index__marcas-titulo">Marcas con las que trabajamos</h3>

        <div class="swiper marcas__swiper swiper1">
            <div class="swiper-wrapper" id="swiper1-wrapper"></div>
        </div>

        <div class="swiper marcas__swiper swiper2">
            <div class="swiper-wrapper" id="swiper2-wrapper"></div>
        </div>
    </section>

    <div class="index__imagen">
            <div class="index__frase">
                Automatizamos tu industria, optimizamos tu futuro
            </div>
    </div>

    <section class="productos">
    <h2 class="index__productos-titulo">Productos</h2>

    <div class="productos__grid">
        <!-- Columna izquierda -->
        <div class="productos__columna">
        <div class="categoria">
            <div class="categoria__icono">
                <a href="/productos">
                    <img src="../build/img/icono1.svg" alt="Electrico">
                </a>
            </div>
            <a href="/productos">
            <h3 class="categoria__titulo">Linea Eléctrica</h3>
            <p class="categoria__descripcion">Soluciones confiables para distribución, control y protección de sistemas eléctricos industriales.</p>
            </a>
        </div>

        <div class="categoria">
            <div class="categoria__icono">
            <a href="/productos">
            <img src="../build/img/icono2.svg" alt="Automatizacion">
            </a>
            </div>
            <a href="/productos">
            <h3 class="categoria__titulo">Linea de Automatizacion</h3>
            <p class="categoria__descripcion">Control y optimizacion de procesos, mejorando la eficiencia, seguridad y productividad de tu empresa.</p>
            </a>
        </div>

        <div class="categoria">
            <div class="categoria__icono">
            <a href="/productos">
            <img src="../build/img/icono3.svg" alt="TI">
            </a>
            </div>
            <a href="/productos">
            <h3 class="categoria__titulo">Línea TI</h3>
            <p class="categoria__descripcion">Soluciones digitales para optimizar la gestión, comunicación y seguridad en tu empresa.</p>
            </a>
        </div>
        </div>

        <!-- Columna derecha -->
        <div class="productos__columna">
        <div class="categoria">
            <div class="categoria__icono">
                <a href="/productos">
                <img src="../build/img/icono4.svg" alt="Lean Manufacturing">    
                </a>

            </div>
            <a href="/productos">
            <h3 class="categoria__titulo">Lean Manufacturing</h3>
            <p class="categoria__descripcion">Optimizacion de procesos, reduccion de desperdicios y aumento de productividad en tu industria.</p>
            </a>
        </div>

        <div class="categoria">
            <div class="categoria__icono">
                <a href="/productos">
                    <img src="../build/img/icono5.svg" alt="Linea Mecanica">
                </a>
            </div>
            <a href="/producto">
            <h3 class="categoria__titulo">Línea Mecánica</h3>
            <p class="categoria__descripcion">Soluciones para la transmisión de movimiento, soporte estructural y ensamblaje industrial eficiente.</p>
            </a>
        </div>

        <div class="categoria">
            <div class="categoria__icono">
                <a href="/productos">
                    <img src="../build/img/icono6.svg" alt="Softwarws y licencias">
                </a>
            </div>
            <a href="/productos">
            <h3 class="categoria__titulo">Softwares y Licencias</h3>
            <p class="categoria__descripcion">Herramientas digitales automatizar, diseñar y gestionar procesos de forma segura y eficiente.</p>
            </a>
        </div>
        </div>
    </div>

    <div class="index__productos-boton">
        <a href="/productos" class="boton boton--primario">Ver productos</a>
    </div>
    </section>

    <h2 class="index__contacto-titulo">Solicita tu asesoría</h2>
    <div class="index__contacto">
    <div class="index__contacto-contenido">
        <div class="index__contacto-formulario">
        <form action="/contacto" method="POST">
            <input type="text" placeholder="Nombre" name="contacto[nombre]" required>
                <input 
                type="tel" 
                id="telefono"
                name="contacto[telefono]"  
                pattern="[0-9]{10}" 
                maxlength="10" 
                required
                placeholder="Telefono - Ej: 0987654321"
                />
            <input type="email" placeholder="Correo electrónico"name="contacto[correo]" required>
            <textarea placeholder="Mensaje" required rows="14" name="contacto[mensaje]"></textarea>
            <button type="submit">Enviar</button>
        </form>
        </div>
        <div class="index__contacto-mapa">
        <a href="https://www.google.com/maps/place/2%C2%B054'47.8%22S+79%C2%B000'27.2%22W/@-2.9132107,-79.007593,17.5z/data=!4m4!3m3!8m2!3d-2.9132731!4d-79.0075531?entry=ttu&g_ep=EgoyMDI1MDczMC4wIKXMDSoASAFQAw%3D%3D" target="blank">
        <img src="../build/img/ubicacion.png" alt="Ubicación">
        </a>
        </div>
    </div>
    </div>


</main>
