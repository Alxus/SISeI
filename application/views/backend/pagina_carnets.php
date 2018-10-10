    <?if($_SESSION['SISeI_User']['tipo']<=2):?>
   <div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nuevo Carnet</a></div>
   </div>
  <?endif;?>
   <div class="container">
     <table class="responsive-table">
      <thead>

        <tr>
          <th>Nombre </th>
          <th>Precio </th>
          <th>Limite </th>
          <th>Descripcion </th>
          <th>Detalles </th>
          <th>Modificar </th>
          <th>Eliminar </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($carnets as $aux):?>
        <tr>
          <td><?php echo $aux['nombre']; ?></td>
          <td><?php echo $aux['precio']; ?></td>
          <td><?php echo $aux['limite']; ?></td>
          <td><?php echo $aux['descripcion']; ?></td>
          <?if($_SESSION['SISeI_User']['tipo']<=2):?>
          <td><a href="<?php echo base_url();?>index.php/Carnets_controller/details?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light black"><i class="material-icons">info_outline</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Carnets_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">edit</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Carnets_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
          <?endif;?>
          <?php endforeach;?>  
        </tr>
        <!-- 
        <td> <img class="responsive-img" src="<?php echo $aux['imagen'];?>"></td>
          <td><?php echo $aux['created_at']; ?></td>
          <td><?php echo $aux['updated_at']; ?></td>
           -->
      </tbody>
     </table>
   </div>

<!-- Estructura Modal1 -->
<div id="modal1" class="modal">
  <div class="modal-content">
     <h4 class="center-align">Crear Carnet</h4>
  
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/create_carnet');?> class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
              <input id="nombre" type="text" name="nombre" class="validate" required="" aria-required="true">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <input id="precio" type="number" name="precio" class="validate" required="" aria-required="true">
              <label for="precio">Precio</label>
            </div>
            <div class="input-field col s12">
              <input id="limite" type="number" name="limite" class="validate" required="" aria-required="true" >
              <label for="limite">Limite</label>
            </div>
            <div class="input-field col s12">
              <textarea id="descripcion" name="descripcion" class="materialize-textarea" required="" aria-required="true" ></textarea>
              <label for="descripcion">Descripcion</label>
            </div>
            <div class= "input-field col s12">
             <select name="tipo" value =1>
              <option value="" disabled selected>Seleccione</option>
              <option value=1>Normal</option>
              <option value=2>Promocion</option>
            </select>
            <label>Tipo de carnet</label>
            
            </div>
            <div class="row">
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Imagen</span>
                  <input id="btnimg" name="btnimg" type="file">
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="imagen" name="imagen" class="file-path validate" type="text" class="validate" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="img" src="" class="responsive-img">
              </div>
            </div>          
  </div>
   <div class="row">
    <div class="col s2 offset-s4">
      <button type="submit" class="btn">Crear<i class="material-icons right">send</i></button>
     </div>
    <div class="col s2">    
      <a href="#!" class="btn modal-close">Cerrar</a>
    </div>
  </div>
    </form>
  </div>
</div>

 

 