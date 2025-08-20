<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Categoría</legend>

    <!-- Nombre de la Categoría -->
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre de la Categoría</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre"
            placeholder="Ej: Eléctricos, Mecánicos, etc."
            value="<?php echo htmlspecialchars($categoria->nombre ?? '', ENT_QUOTES); ?>"
        >
    </div>
</fieldset>
