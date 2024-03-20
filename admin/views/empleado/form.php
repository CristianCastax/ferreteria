<div class="container">
    <form action="empleado.php?action=<?php echo($action=='update')?'change&id_empleado='.$datos['id_empleado']:'save'; ?>" method="post" enctype="multipart/form-data"> <!--Sirve para transferencia de archivos -->
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Empleado</h2>
    <!--NOMBRE -->    
        <div class="mb-3"> 
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Captura el nombre" required="required" value="<?php echo (isset($datos["nombre"])) ? $datos["nombre"]:'';?>">
        </div>
    <!--PRIMER APELLIDO -->    
        <div class="mb-3"> 
            <label for="primer_apellido" class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Captura primer apellido" required="required" value="<?php echo (isset($datos["primer_apellido"])) ? $datos["primer_apellido"]:'';?>">
        </div>
    <!--SEGUNDO APELLIDO -->    
        <div class="mb-3"> 
            <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Captura segundo apellido" required="required" value="<?php echo (isset($datos["segundo_apellido"])) ? $datos["segundo_apellido"]:'';?>">
        </div>
    <!--RFC-->    
        <div class="mb-3"> 
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{3}" class="form-control" id="rfc" name="rfc" placeholder="Captura tu RFC" required="required" value="<?php echo (isset($datos["rfc"])) ? $datos["rfc"]:'';?>">
        </div>
    <!--CURP-->    
        <div class="mb-3"> 
            <label for="curp" class="form-label">CURP</label>
            <input type="text" pattern="[A-Z]{4}[0-9]{6}[H|M]{1}[A-Z0-9]{7}" class="form-control" id="curp" name="curp" placeholder="Captura CURP" required="required" value="<?php echo (isset($datos["curp"])) ? $datos["curp"]:'';?>">
        </div>
    <!--FOTOGRAFIA-->   
    <div class="mb-3"> 
        <label for="curp" class="form-label">CAMARA</label>

        <?php include('/xampp/htdocs/ferreteria2/admin/tomandofoto/index.php'); ?>
    </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
        <a href="empleado.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>