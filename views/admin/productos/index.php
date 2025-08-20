<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<!-- Contenedor que agrupa filtro y botones alineados -->
<div class="dashboard__filtro-boton-container">

  <!-- Filtro por Categoría -->
  <div class="dashboard__filtro" style="margin: 0;">
    <label for="filtro-categoria" class="formulario__label">Filtrar por Categoría:</label>
    <select id="filtro-categoria" class="formulario__select">
      <option value="todas">Todas</option>
      <?php 
        $categorias_unicas = [];
        foreach($productos as $producto) {
          if (!empty($producto->categoria) && !in_array($producto->categoria, $categorias_unicas)) {
            $categorias_unicas[] = $producto->categoria;
            echo '<option value="' . htmlspecialchars($producto->categoria) . '">' . htmlspecialchars($producto->categoria) . '</option>';
          }
        }
      ?>
    </select>
  </div>

  <!-- Botones de acción -->
  <div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/productos/crear">
      <i class="fa-solid fa-circle-plus"></i>
      Crear Producto
    </a>
    <a class="dashboard__boton" href="/admin/productos/crearsub">
      <i class="fa-solid fa-circle-plus"></i>
      Crear Subcategoría
    </a>
    <a class="dashboard__boton" href="/admin/productos/crearcat">
      <i class="fa-solid fa-circle-plus"></i>
      Crear Categoría
    </a>
  </div>

</div>

<div class="dashboard__contenedor">
  <?php if(!empty($productos)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Imagen</th>
          <th scope="col" class="table__th">Categoría</th>
          <th scope="col" class="table__th">Subcategoría</th>
          <th scope="col" class="table__th">Nombre</th>
          <th scope="col" class="table__th">Descripción</th>
          <th scope="col" class="table__th">Acciones</th>
        </tr>
      </thead>

      <tbody class="table__tbody">
        <?php foreach($productos as $producto) { ?>
          <tr class="table__tr" data-categoria="<?php echo htmlspecialchars($producto->categoria ?? ''); ?>">

            <!-- Imagen -->
            <td class="table__td">
              <?php if($producto->imagen): ?>
                <picture>
                  <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.webp" type="image/webp">
                  <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" type="image/png">
                  <img src="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" class="table__imagen" alt="Imagen producto">
                </picture>
              <?php else: ?>
                <p>Sin imagen</p>
              <?php endif; ?>
            </td>
                        <!-- Categoría asociada -->
            <td class="table__td">
              <?php echo htmlspecialchars($producto->categoria ?? 'Sin categoría'); ?>
            </td>

              
            <!-- Subcategoría asociada -->
            <td class="table__td">
              <?php echo htmlspecialchars($producto->subcategoria ?? 'Sin subcategoría'); ?>
            </td>

            <!-- Nombre -->
            <td class="table__td table__td--nombre">
              <?php echo htmlspecialchars($producto->nombre); ?>
            </td>

            <!-- Descripción -->
            <td class="table__td table__td--descripcion">
              <?php echo htmlspecialchars($producto->descripcion); ?>
            </td>


            <!-- Acciones -->
            <td class="table__td--acciones">
              <a class="table__accion table__accion--editar" href="/admin/productos/editar?id=<?php echo $producto->id; ?>">
                <i class="fa-solid fa-pen"></i>
                Editar
              </a>

              <form method="POST" action="/admin/productos/eliminar" class="table__formulario">
                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                <button class="table__accion table__accion--eliminar" type="submit">
                  <i class="fa-solid fa-trash"></i>
                  Eliminar
                </button>
              </form>
            </td>

          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p class="text-center">No hay productos aún</p>
  <?php } ?>
</div>


<?php
  echo $paginacion; // Mostrar la paginación
?>