<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/servicios/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Agregar Servicio
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($servicios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Descripcion</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>

            <tdoby class="table__tbody">
                <?php foreach($servicios as $servicios) {?>
                    <tr class="table__tr">
                        <td class="table__td table__td--nombre">
                            <?php echo $servicios->nombre; ?>
                        </td>

                        <td class="table__td table__td--descripcion">
                            <?php echo $servicios->descripcion; ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/servicios/editar?id=<?php echo $servicios->id ?>">
                                <i class="fa-solid fa-pen"></i>
                                Editar
                            </a>

                            <form method="POST"action="/admin/servicios/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $servicios->id; ?>">
                                <button class="table__accion table__accion--eliminar"type="submit">
                                    <i class="fa-solid fa-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tdoby>
        </table>

        <?php } else { ?>
            <p class="text-center">No hay servicios aun</p>
        <?php } ?>
</div>


<?php
  echo $paginacion; // Mostrar la paginación
?>