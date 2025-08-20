<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Servicio</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Servicio</label>
        <input 
            type="text" 
            class="formulario__input"
            name="nombre" 
            id="nombre"
            placeholder="Nombre del Servicio"
            value="<?php echo htmlspecialchars($servicios->nombre ?? '', ENT_QUOTES); ?>"
        >
    </div>

    <label class="formulario__label" for="descripcion">Descripción del Servicio:</label>
    <textarea 
        id="descripcion" 
        name="descripcion" 
        rows="15" 
        cols="40" 
        class="formulario__textarea"
    ><?php echo htmlspecialchars($servicios->descripcion ?? '', ENT_QUOTES); ?></textarea>

    <div class="formulario__campo">
        <label for="imagen1" class="formulario__label">Imagen del Servicio</label>
        <input 
            type="file" 
            class="formulario__input"
            name="imagen1" 
            id="imagen1"
        >
    </div>

    <?php if(isset($servicios->imagen_actual)) { ?>

        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/servicios/' . $servicios->imagen1;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/servicios/' . $servicios->imagen1;?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/servicios/' . $servicios->imagen1;?>.png" alt="Imagen Servicio">
            </picture>
        </div>

    <?php } ?>
</fieldset>
