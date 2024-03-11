<div class="container">
    <form action="tienda.php?action=<?php echo($action=='update')?'change&id_tienda='.$datos['id_tienda']:'save'; ?>" method="post" enctype="multipart/form-data"> <!--Sirve para transferencia de archivos -->
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Tienda</h2>
        <div class="mb-3"> <!--NOMBRE -->
            <label for="tienda" class="form-label">Tienda</label>
            <input type="text" class="form-control" id="tienda" name="tienda" placeholder="Captura la tienda" required="required" value="<?php echo (isset($datos["tienda"])) ? $datos["tienda"]:'';?>">
        </div>
    <!--FOTOGRAFIA -->
        <?php if($action=='update'):?>
            <div class="mb-3">
                <label for="Fotografia" class="form-label">Fotografia Actual</label>
                <img src="../uploads/tiendas/<?php echo $datos['fotografia'] ?>" alt="" width="50%">
            </div>
        <?php endif;?>
        <div class="mb-3">
            <label for="Fotografia" class="form-label">Fotografia</label>
            <input type="file" class="form-control" id="fotografia" name="fotografia" placeholder="Captura tu fotografia" value="<?php echo (isset($datos["fotografia"])) ? $datos["fotografia"]:'';?>">
        </div>
    <!--MAPA --> 
        <?php if($action=='update'):?>
            <div class="mb-3">
                <label for="Fotografia" class="form-label">Mapa Actual</label>
                <iframe class="iframe" src="https://maps.google.com/?ll=<?php echo $datos['latitud']; ?>,<?php echo $datos['latitud']; ?>&z=14&t=m&output=embed" height="600" width="600" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        <?php endif;?>
        
    <!--LATITUD -->        
        <div class="mb-3">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Captura la latitud" value="<?php echo (isset($datos["latitud"])) ? $datos["latitud"]:'';?>">
        </div>

    <!--LONGITUD -->
        <div class="mb-3">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Captura la longitud" value="<?php echo (isset($datos["longitud"])) ? $datos["longitud"]:'';?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>