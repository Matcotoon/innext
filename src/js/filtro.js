(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const filtro = document.getElementById('filtro-categoria');
        const filas = document.querySelectorAll('.table__tr');

        filtro.addEventListener('change', e => {
            const categoriaSeleccionada = e.target.value;
            filas.forEach(fila => {
                const categoria = fila.getAttribute('data-categoria');
                const mostrar = categoriaSeleccionada === 'todas' || categoria === categoriaSeleccionada;
                fila.style.display = mostrar ? '' : 'none';
            });
        });
    });
})();
