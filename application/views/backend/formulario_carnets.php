
<div class="container">
    <h4>Modificar Carnet</h4>
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/update_carnet');?> class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
              <input type="hidden" name="id" value="<?php echo $carnet['id']; ?>"/>
              <input id="nombre" type="text" name="nombre" value="<?php echo $carnet['nombre']; ?>">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <input id="precio" type="text" name="precio" value="<?php echo $carnet['precio']; ?>">
              <label for="precio">Precio</label>
            </div>
            <div class="input-field col s12">
              <input id="limite" type="text" name="limite" value="<?php echo $carnet['limite']; ?>">
              <label for="limite">Limite</label>
            </div>
            <div class="input-field col s12">
              <input id="descripcion" type="text" name="descripcion" value="<?php echo $carnet['descripcion']; ?>">
              <label for="descripcion">Descripcion</label>
            </div>
            <div class="row">
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Imagen</span>
                  <input id="btnimg" name="btnimg" type="file" >
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="imagen" name="imagen" class="file-path validate" type="text" value="<?php echo $carnet['imagen']; ?>">
                </div>
              </div>
              <div class="col s5">
                <img id="img" src="<?php echo $carnet['imagen']; ?>" class="responsive-img">
              </div>
            <button href="#!" class=" modal-action modal-close waves-effect waves-green btn-small" input="submit"> Crear</button> 
            </div>
          

  </div>
</div>