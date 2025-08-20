<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php  echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>

        <a href="/admin/productos" class="dashboard__enlace <?php  echo pagina_actual('/productos') ? 'dashboard__enlace--actual' : ''?>">
            <i class="fa-solid fa-box dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Productos
            </span>
        </a>

        <a href="/admin/servicios" class="dashboard__enlace <?php  echo pagina_actual('/servicios') ? 'dashboard__enlace--actual' : ''?>">
            <i class="fa-solid fa-hand-holding dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Servicios
            </span>
        </a>

        <a href="/admin/proyectos" class="dashboard__enlace <?php  echo pagina_actual('/proyectos') ? 'dashboard__enlace--actual' : ''?>">
            <i class="fa-solid fa-industry dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Proyectos
            </span>
        </a>
    </nav>
</aside>