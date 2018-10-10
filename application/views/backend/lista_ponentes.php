<div class="row">
      <?if($_SESSION['SISeI_User']['tipo']<=3 && && $_SESSION['SISeI_User']['tipo']!=2):?>
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nuevo Ponente</a></div>
      <?endif;?>
      <?if($_SESSION['SISeI_User']['tipo']<=2):?>
  <a class="btn blue" target="_blank" href=<?=site_url('admin/panel/ponentes/pdf');?>>Imprimir lista</a>
  <?endif;?>
   </div>
   <div class="container">
     <table class="responsive-table">
      <thead>

        <tr>
          <th>Nombres </th>
          <th>Apellidos </th>
          <th>Telefono </th>
          <th>Detalles </th>
          <th>Modificar </th>
          <th>Eliminar </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ponentes as $aux):?>
        <tr>
          <td><?php echo $aux['nombres']; ?></td>
          <td><?php echo $aux['apellidos']; ?></td>
          <td><?php echo $aux['tel']; ?></td>
          <?if($_SESSION['SISeI_User']['tipo']<=3 && $_SESSION['SISeI_User']['tipo']!=2):?>
          <td><a href="<?php echo base_url();?>index.php/Ponentes_controller/details?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light black"><i class="material-icons">info_outline</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Ponentes_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">edit</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Ponentes_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
          <?endif;?>
          <?php endforeach;?>  
        </tr>
      </tbody>
     </table>
   </div>

<!-- Estructura Modal1 -->
<div id="modal1" class="modal">
  <div class="modal-content">
     <h4>Crear Ponente</h4>
  
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/create_ponente');?> class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
              <input id="nombres" type="text" name="nombres" class="validate" required="" aria-required="true">
              <label for="nombres">Nombres</label>
            </div>
            <div class="input-field col s12">
              <input id="apellidos" type="text" name="apellidos" class="validate" required="" aria-required="true">
              <label for="apellidos">Apellidos</label>
            </div>
            <div class="input-field col s12">
              <input id="tel" type="number" name="tel" class="validate" required="" aria-required="true" >
              <label for="tel">Telefono</label>
            </div>
            <div class="input-field col s12">
              <input id="email" type="email" name="email" class="validate" required="" aria-required="true">
              <label for="email">Email</label>
            </div>
              <div class="input-field col s12">
              <input id="linkedin" type="text" name="linkedin" class="validate" required="" aria-required="true">
              <label for="linkedin">Linkedin</label>
            </div>
              <div class="input-field col s12">
              <textarea id="descripcion" name="descripcion" class="materialize-textarea" required="" aria-required="true" ></textarea>
              <label for="descripcion">Descripcion</label>
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
