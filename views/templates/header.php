<!-- Barra de navegación principal: primero -->
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <img src="../build/img/Innext_Logo.svg" alt="Logo INNEXT" class="barra__logo-imagen">
        </a>
        <button id="menu-toggle" class="barra__toggle" aria-label="Abrir menú">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <nav class="navegacion">
            <a href="/nosotros" class="navegacion__enlace <?php echo pagina_actual('/nosotros') ? 'navegacion__enlace--actual' : ''; ?>">Nosotros</a>
            <a href="/productos" class="navegacion__enlace <?php echo pagina_actual('/productos') ? 'navegacion__enlace--actual' : ''; ?>">Productos</a>
            <a href="/servicios" class="navegacion__enlace <?php echo pagina_actual('/servicios') ? 'navegacion__enlace--actual' : ''; ?>">Servicios</a>
            <a href="/proyectos" class="navegacion__enlace <?php echo pagina_actual('/proyectos') ? 'navegacion__enlace--actual' : ''; ?>">Proyectos</a>
            <a href="/contacto" class="navegacion__enlace <?php echo pagina_actual('/contacto') ? 'navegacion__enlace--actual' : ''; ?>">Contacto</a>
        </nav>
    </div>
</div>
<nav class="sidebar" id="sidebar">
  <ul class="sidebar__menu">
    <li><a href="/nosotros">Nosotros</a></li>
    <li><a href="/productos">Productos</a></li>
    <li><a href="/servicios">Servicios</a></li>
    <li><a href="/proyectos">Proyectos</a></li>
    <li><a href="/contacto">Contacto</a></li>
  </ul>
</nav>

<!-- Header con imagen y texto: después -->
<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(is_auth())  {?>
            <a href="<?php echo is_admin() ? '/admin/dashboard' : '/'?>" class="header__enlace">Administrar</a>
            <form method="POST" action="/logout" class="header__form">
                <input type="submit" name="" id="" value="Cerrar Sesión" class="header__submit">
            </form>

            <?php } else { ?>
            <!-- <a href="/registro" class="header__enlace">Registro</a>  -->
            <a href="/login" class="header__enlace">Iniciar Sesion</a>
            <?php } ?>
        </nav>

        <div class="header__contenido">
            <p class="header__texto">
                SOMOS 
            </p>
            <span class="typed-text"></span><span class="escribiendo">|</span>
            <p class="header__texto">
                <span class="texto-adicional"></span>
            </p>
            <a href="/servicios" class="header__boton">Ver Servicios</a>
            <a href="/productos" class="header__boton">Ver Productos</a>
            

        </div>
    </div>
</header>

            


