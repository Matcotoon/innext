<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Subcategoría</legend>

    <!-- Nombre de la Subcategoría -->
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre de la Subcategoría</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre"
            placeholder="Ej: Bombillos LED, Herramientas, etc."
            value="<?php echo htmlspecialchars($subcategoria->nombre ?? '', ENT_QUOTES); ?>"
        >
    </div>


    <!-- Select de Categoría -->
    <div class="formulario__campo">
        <label for="categoria_id" class="formulario__label">Categoría Principal</label>
        <select name="categoria_id" id="categoria_id" class="formulario__select">
            <option value="">-- Selecciona una categoría --</option>
            <?php foreach($categorias as $categoria): ?>
                <option 
                    value="<?php echo $categoria->id; ?>"
                    <?php echo ($categoria->id == $subcategoria->categoria_id) ? 'selected' : ''; ?>
                >
                    <?php echo htmlspecialchars($categoria->nombre); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>
