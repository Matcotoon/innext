(function() {
    document.addEventListener('DOMContentLoaded', function () {
    const productos = document.querySelectorAll('.producto');
    const filtroCategoria = document.querySelector('#filtro-categoria');
    const filtroSubcategoria = document.querySelector('#filtro-subcategoria');

    // Ocultar subcategorías que no pertenecen a la categoría seleccionada
    filtroCategoria.addEventListener('change', function () {
        const selectedCategoria = this.value;

        // Mostrar solo las subcategorías correspondientes
        Array.from(filtroSubcategoria.options).forEach(option => {
            const catId = option.dataset.categoria;
            if (!catId || selectedCategoria === "" || catId === selectedCategoria) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });

        // Reiniciar selección de subcategoría si ya no corresponde
        const selectedSub = filtroSubcategoria.options[filtroSubcategoria.selectedIndex];
        if (selectedSub && selectedSub.style.display === 'none') {
            filtroSubcategoria.value = "";
        }

        filtrarProductos();
    });

    filtroSubcategoria.addEventListener('change', filtrarProductos);

    function filtrarProductos() {
        const categoria = filtroCategoria.value;
        const subcategoria = filtroSubcategoria.value;

        productos.forEach(producto => {
            const cat = producto.dataset.categoria;
            const sub = producto.dataset.subcategoria;

            const mostrar =
                (categoria === "" || cat === categoria) &&
                (subcategoria === "" || sub === subcategoria);

            producto.style.display = mostrar ? '' : 'none';
        });
    }
});
})();
