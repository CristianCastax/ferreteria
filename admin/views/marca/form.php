<div class="container">
    <form action="marca.php?action=<?php echo($action=='update')?'change&id_marca='.$datos['id_marca']:'save'; ?>" method="post">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nueva'; ?> Marca</h2>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" placeholder="Captura la marca" required="required" value="<?php echo (isset($datos["marca"])) ? $datos["marca"]:'';?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>