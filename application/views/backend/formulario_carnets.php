<h1>
Modificar Carnet
</h1>
<div>
    <?php echo form_open('Carnets_controller/edit/'); ?>
    <input type="hidden" name="id" value="<?php echo $carnet['id']; ?>"/>
    <label for="nombre">Nombre de la editorial:</label><br/>
    <input type="text" name="nombre" value="<?php echo $carnet['nombre']; ?>"/>
    <label for="precio">Nombre de la editorial:</label><br/>
    <input type="text" name="precio" value="<?php echo $carnet['precio']; ?>"/>
    <label for="limite">Nombre de la editorial:</label><br/>
    <input type="text" name="limite" value="<?php echo $carnet['limite']; ?>"/>
    <label for="descripcion">Nombre de la editorial:</label><br/>
    <input type="text" name="descripcion" value="<?php echo $carnet['descripcion']; ?>"/>
    <label for="imagen">Nombre de la editorial:</label><br/>
    <input type="text" name="imagen" value="<?php echo $carnet['imagen']; ?>"/>
    <input type="submit" name="update" value="Actualizar" />
    <?php echo form_close();?>
</div>