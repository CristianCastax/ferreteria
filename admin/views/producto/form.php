<div class="container">
    <form action="producto.php?action=<?php echo($action=='update')?'change&id_producto='.$datos['id_producto']:'save'; ?>" method="post" enctype="multipart/form-data"> <!--Sirve para transferencia de archivos -->
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
            <label for="InputMarca" class="form-label">Marca</label>
            <select name="id_marca" id="id_marca" class="form-select">
                <?php foreach($marcas as $marca): 
                    $selected = '';
                    if($marca['id_marca']==$datos['id_marca']):
                        $selected = 'selected';
                    endif;?>
                    <option value ="<?php echo ($marca['id_marca']); ?>" <?php echo $selected;?>><?php echo ($marca['marca']); ?></option>
                <?php endforeach;?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="Fotografia" class="form-label">Fotografia</label>
            <input type="file" class="form-control" id="fotografia" name="fotografia" placeholder="Captura tu fotografia" required="required" value="<?php echo (isset($datos["fotografia"])) ? $datos["fotografia"]:'';?>">
        </div>
        


        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>