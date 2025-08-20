  (function() {
  document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modal-producto');
  const cerrar = modal.querySelector('.modal__cerrar');
  const nombreModal = document.getElementById('modal-nombre');
  const imagenModal = document.getElementById('modal-imagen');
  const descripcionModal = document.getElementById('modal-descripcion');

  const botones = document.querySelectorAll('.catalogo__boton');
  botones.forEach(boton => {
    boton.onclick = () => {
      // Leer datos del botón
      const nombre = boton.getAttribute('data-nombre');
      const imagen = boton.getAttribute('data-imagen');
      const descripcion = boton.getAttribute('data-descripcion');

      // Setear contenido modal
      nombreModal.textContent = nombre;
      imagenModal.src = imagen;
      imagenModal.alt = `Imagen de ${nombre}`;
      descripcionModal.textContent = descripcion;

      // Mostrar modal
      modal.style.display = 'flex';
    };
  });

  // Cerrar modal al hacer clic en el botón cerrar
  cerrar.onclick = () => {
    modal.style.display = 'none';
  };

  // Cerrar modal si haces clic fuera del contenido
  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  };

  // Cerrar modal con Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      modal.style.display = 'none';
    }
  });
});
})();
