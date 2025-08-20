<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Proyecto</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Proyecto</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre"
            placeholder="Nombre del Proyecto"
            value="<?php echo htmlspecialchars($proyecto->nombre ?? '', ENT_QUOTES); ?>"
        >
    </div>

    <label class="formulario__label" for="descripcion">Descripción del Proyecto:</label>
    <textarea 
        id="descripcion" 
        name="descripcion" 
        rows="15" 
        cols="40" 
        class="formulario__textarea"
    ><?php echo htmlspecialchars($proyecto->descripcion ?? '', ENT_QUOTES); ?></textarea>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen del Proyecto</label>
        <input 
            type="file" 
            class="formulario__input"
            name="imagen" 
            id="imagen"
        >
    </div>

    <?php if(isset($proyecto->imagen_actual)) { ?>

        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/proyectos/' . $proyecto->imagen;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/proyectos/' . $proyecto->imagen;?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/proyectos/' . $proyecto->imagen;?>.png" alt="Imagen Proyecto">
            </picture>
        </div>

    <?php } ?>
</fieldset>
