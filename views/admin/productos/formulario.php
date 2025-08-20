<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Producto</legend>

    <!-- Select de Categoría -->
    <div class="formulario__campo">
        <label for="categoria_id" class="formulario__label">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="formulario__select">
            <option value="">-- Selecciona --</option>
            <?php foreach($categorias as $categoria): ?>
                <option 
                    value="<?php echo $categoria->id; ?>"
                    <?php echo ($categoria->id == $producto->categoria_id) ? 'selected' : ''; ?>
                >
                    <?php echo htmlspecialchars($categoria->nombre); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Select de Subcategoría -->
    <div class="formulario__campo">
        <label for="subcategoria_id" class="formulario__label">Subcategoría</label>
        <select name="subcategoria_id" id="subcategoria_id" class="formulario__select">
            <option value="">-- Selecciona --</option>
            <?php foreach($subcategorias as $sub): ?>
                <option 
                    value="<?php echo $sub->id; ?>" 
                    data-categoria="<?php echo $sub->categoria_id; ?>"
                    <?php echo ($sub->id == $producto->subcategoria_id) ? 'selected' : ''; ?>
                >
                    <?php echo htmlspecialchars($sub->nombre); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Nombre del Producto -->
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Producto</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre"
            placeholder="Nombre del Producto"
            value="<?php echo htmlspecialchars($producto->nombre ?? '', ENT_QUOTES); ?>"
        >
    </div>

    <!-- Descripción -->
    <label class="formulario__label" for="descripcion">Descripción del Producto:</label>
    <textarea 
        id="descripcion" 
        name="descripcion" 
        rows="10" 
        class="formulario__textarea"
    ><?php echo htmlspecialchars($producto->descripcion ?? '', ENT_QUOTES); ?></textarea>

    <!-- Imagen -->
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen del Producto</label>
        <input 
            type="file" 
            class="formulario__input"
            name="imagen" 
            id="imagen"
        >
    </div>

    <!-- Imagen actual si existe -->
    <?php if(isset($producto->imagen)): ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" alt="Imagen Producto">
            </picture>
        </div>
    <?php endif; ?>
</fieldset>
