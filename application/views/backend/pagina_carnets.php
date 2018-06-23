
   <div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nuevo Carnet</a></div>
   </div>
      
<div class="row">
      <div class="col s1">Id</div>
       <div class="col s1">Nombre</div>
       <div class="col s1">Precio</div>
       <div class="col s1">Limite</div>
       <div class="col s2">Descripcion</div>
       <div class="col s2">Imagen</div>
       <div class="col s1">Created</div>
       <div class="col s1">Updated</div> 
       <div class="col s1">Modificar</div>
       <div class="col s1">Eliminar</div>  
   </div>
   <div class="divider"></div>  
    <?php foreach ($carnets as $aux):?>
    <div class="row">
       <div class="col s1"><?php echo $aux['id']; ?></div>
       <div class="col s1"><?php echo $aux['nombre']; ?> </div>
       <div class="col s1"> <?php echo $aux['precio']; ?> </div>
       <div class="col s1"> <?php echo $aux['limite']; ?> </div>
       <div class="col s2"> <?php echo $aux['descripcion']; ?> </div>
       <div class="col s2"> <img id="imgx" src="<?php echo $aux['imagen'];?>" class="responsive-img"></div> 
       <div class="col s1"> <?php echo $aux['created_at']; ?> </div>
       <div class="col s1"> <?php echo $aux['updated_at']; ?> </div>
       <div class="col s1"> <a href="<?php echo base_url();?>index.php/Carnets_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">updated</i></a></div>
       <div class="col s1"> <a href="<?php echo base_url();?>index.php/Carnets_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">deleted_forever</i></a></div>
    </div>
    <div class="divider"></div>
  <?php endforeach;?>  
  

<!-- Estructura Modal1 -->
<div id="modal1" class="modal">
  <div class="modal-content">
     <h4>Crear Carnet</h4>
  
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/create_carnet');?> class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
              <input id="nombre" type="text" name="nombre">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <input id="precio" type="text" name="precio">
              <label for="precio">Precio</label>
            </div>
            <div class="input-field col s12">
              <input id="limite" type="text" name="limite">
              <label for="limite">Limite</label>
            </div>
            <div class="input-field col s12">
              <input id="descripcion" type="text" name="descripcion">
              <label for="descripcion">Descripcion</label>
            </div>
            <div class="row">
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Imagen</span>
                  <input id="btnimg" name="btnimg" type="file">
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="imagen" name="imagen" class="file-path validate" type="text">
                </div>
              </div>
              <div class="col s5">
                <img id="img" src="" class="responsive-img">
              </div>
            </div>          
  </div>
  <div class="modal-footer">
    <button href="#!" class=" modal-action modal-close waves-effect waves-green btn-small" input="submit"> Crear</button>
    <a href="#!" class="modal-close waves-effect waves-green btn-small">Cerrar</a>
    </form>
  </div>
</div>

 

 