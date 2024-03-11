<h1>Tiendas</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="tienda.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Tienda</th>
            <th scope="col">Fotografia</th>
            <th scope="col">Latitud</th>
            <th scope="col">Longitud</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_tienda']; ?></th>
                <td><?php echo $dato['tienda']; ?></td>
                <td><?php echo $dato['fotografia']; ?></td>
                <td><?php echo $dato['latitud']; ?></td>
                <td><?php echo $dato['longitud']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="tienda.php?action=update&id_tienda=<?php echo $dato['id_tienda']; ?>"
                        class="btn btn-info">Actualizar</a>
                        <a href="tienda.php?action=delete&id_tienda=<?php echo $dato['id_tienda']; ?>"
                         class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<P>Se encontraron <?php echo $app->getCount();?> tiendas</P>