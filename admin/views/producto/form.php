<div class="container">
    <form action="producto.php?action=<?php echo($action=='update')?'change&id_producto='.$datos['id_producto']:'save'; ?>" method="post">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Producto</h2>
        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="form-control" id="producto" name="producto" placeholder="Captura el producto" required="required" value="<?php echo (isset($datos["producto"])) ? $datos["producto"]:'';?>">
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" placeholder="Captura el precio" required="required" value="<?php echo (isset($datos["precio"])) ? $datos["precio"]:'';?>">
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" placeholder="Captura la marca" required="required" value="<?php echo (isset($datos["marca"])) ? $datos["marca"]:'';?>">
        </div>
        
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>