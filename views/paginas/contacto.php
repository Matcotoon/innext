<main class="contacto">
    <h2 class="contacto__heading"><?php echo $titulo; ?></h2>
  <div class="contacto__contenedor">
    <form class="contacto__formulario" action="/contacto" method="POST">

      <div class="contacto__campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="contacto[nombre]" required/>
      </div>

      <div class="contacto__campo">
        <label for="telefono">Número de teléfono</label>
        <input 
          type="tel" 
          id="telefono" 
          name="contacto[telefono]"  
          pattern="[0-9]{10}" 
          maxlength="10" 
          required
          placeholder="Ej: 0987654321"
        />
      </div> 

      <div class="contacto__campo">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="contacto[correo]"  required/>
      </div>




      <div class="contacto__campo">
        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="contacto[mensaje]" rows="5" required></textarea>
      </div>

      <button type="submit" class="contacto__boton">Enviar mensaje</button>
    </form>

    <div class="contacto__mapa">
      <a href="https://www.google.com/maps/place/Cuenca,+Ecuador" target="_blank" rel="noopener">
        <img src="../build/img/ubicacion.png" alt="Ver ubicación en Google Maps" />
      </a>
    </div>
  </div>
</main>
