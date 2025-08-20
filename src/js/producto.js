 (function() {
  document.addEventListener('DOMContentLoaded', () => {
  const categoriaSelect = document.getElementById('filtro-categoria');
  const subcategoriaSelect = document.getElementById('filtro-subcategoria');
  const productos = document.querySelectorAll('.catalogo__producto .producto');

  // Obtener categorías y subcategorías presentes en los productos
  const categoriasPresentes = new Set();
  const subcategoriasPresentes = new Set();

  productos.forEach(producto => {
    categoriasPresentes.add(producto.getAttribute('data-categoria'));
    subcategoriasPresentes.add(producto.getAttribute('data-subcategoria'));
  });

  // Función para filtrar opciones del select según un set de valores válidos
  function filtrarOpciones(select, validValues) {
    Array.from(select.options).forEach(option => {
      if (option.value === "") {
        // Opción "todas" siempre visible
        option.style.display = '';
        option.disabled = false;
      } else if (validValues.has(option.value)) {
        option.style.display = '';
        option.disabled = false;
      } else {
        option.style.display = 'none';
        option.disabled = true;
      }
    });
  }

  // Filtrar categorías y subcategorías visibles
  filtrarOpciones(categoriaSelect, categoriasPresentes);
  filtrarOpciones(subcategoriaSelect, subcategoriasPresentes);
});
})();
