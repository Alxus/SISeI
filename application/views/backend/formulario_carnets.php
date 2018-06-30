
<div class="container">
    <h4>Modificar Carnet</h4>
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/update_carnet');?>  enctype="multipart/form-data">
            <div class="input-field col s12">
              <input type="hidden" name="id" value="<?php echo $carnet['id']; ?>" required="" aria-required="true">
              <input id="nombre" type="text" name="nombre" value="<?php echo $carnet['nombre']; ?>" required="" aria-required="true">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <input id="precio" type="number" name="precio" value="<?php echo $carnet['precio']; ?>" required="" aria-required="true" >
              <label for="precio">Precio</label>
            </div>
            <div class="input-field col s12">
              <input id="limite" type="number" name="limite" value="<?php echo $carnet['limite']; ?>" required="" aria-required="true" >
              <label for="limite">Limite</label>
            </div>
            <div class="input-field col s12">
              <input id="descripcion" type="text" name="descripcion" value="<?php echo $carnet['descripcion']; ?>" required="" aria-required="true">
              <label for="descripcion">Descripcion</label>
            </div>
            <div class="row">
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Imagen</span>
                  <input id="btnimg" name="btnimg" type="file" >
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="imagen" name="imagen" class="file-path validate" type="text" value="<?php echo $carnet['imagen']; ?>" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="img" src="<?php echo $carnet['imagen']; ?>" class="responsive-img">
              </div>
             <div class="col s2 offset-s5"> <button href="#!" class=" modal-action modal-close waves-effect waves-green btn-small" input="submit"> Modificar</button> </div>
          

  </div>
</div>