<main class="catalogo">
    <h2 class="catalogo__heading"><?php echo $titulo; ?></h2>

    <!-- Barra de filtros horizontal -->
    <div class="catalogo__barra-filtros">
        <div class="catalogo__filtro">
            <label for="filtro-categoria">Categoría:</label>
            <select id="filtro-categoria" class="catalogo__select">
                <option value="">-- Todas --</option>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="catalogo__filtro">
            <label for="filtro-subcategoria">Subcategoría:</label>
            <select id="filtro-subcategoria" class="catalogo__select">
                <option value="">-- Todas --</option>
                <?php foreach($subcategorias as $subcategoria): ?>
                    <option value="<?php echo $subcategoria->id; ?>" data-categoria="<?php echo $subcategoria->categoria_id; ?>">
                        <?php echo $subcategoria->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Contenedor de productos -->
    <section class="catalogo__producto" id="lista-productos">
        <?php foreach($productos as $producto): ?>
            <div class="producto"
                data-categoria="<?php echo $producto->categoria_id; ?>"
                data-subcategoria="<?php echo $producto->subcategoria_id; ?>">

                <h4 class="catalogo__subcategoria"><?php echo $producto->subcategoria->nombre; ?></h4>
                <h3 class="catalogo__nombre"><?php echo $producto->nombre; ?></h3>

                <img class="catalogo__imagen" 
                src="/build/img/productos/<?php echo $producto->imagen; ?>.webp"
                srcset="/build/img/productos/<?php echo $producto->imagen; ?>.webp"
                alt="Imagen de <?php echo $producto->nombre; ?>">



                <button 
                    class="catalogo__boton" 
                    type="button" 
                    data-producto-id="<?php echo $producto->id; ?>"
                    data-nombre="<?php echo htmlspecialchars($producto->nombre, ENT_QUOTES); ?>"
                    data-imagen="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.webp"
                    data-descripcion="<?php echo htmlspecialchars($producto->descripcion, ENT_QUOTES); ?>"
                    >
                    Ver Producto
                    </button>

                <!-- Descripción oculta para el modal -->
                <p class="producto-descripcion" style="display: none;">
                    <?php echo $producto->descripcion; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </section>
    </main>

<?php if($paginacion->total_paginas() > 1): ?>
    <div class="paginado">
        <?php if($paginacion->pagina_actual > 1): ?>
            <a class="paginado__enlace" href="?page=<?php echo $paginacion->pagina_actual - 1; ?>">&laquo; Anterior</a>
        <?php endif; ?>

        <?php for($i = 1; $i <= $paginacion->total_paginas(); $i++): ?>
            <a 
                class="paginado__enlace paginado__numero <?php echo $i === $paginacion->pagina_actual ? 'activo' : ''; ?>" 
                href="?page=<?php echo $i; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if($paginacion->pagina_actual < $paginacion->total_paginas()): ?>
            <a class="paginado__enlace" href="?page=<?php echo $paginacion->pagina_actual + 1; ?>">Siguiente &raquo;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>


<div id="modal-producto" class="modal" style="display:none;">
  <div class="modal__contenido">
    <button class="modal__cerrar" aria-label="Cerrar modal">&times;</button>
    <h2 id="modal-nombre" class="modal__nombre"></h2>
    <img id="modal-imagen" src="" alt="" class="modal__imagen"/>
    <p id="modal-descripcion" class="modal__descripcion"></p>
  </div>
</div>


