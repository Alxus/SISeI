
   <div class="row">
      <div class="col s3 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nueva Conferencia</a></div>
   </div>
   <div class="container">
     <table class="responsive-table">
      <thead>

        <tr>
          <th>Id de Ponente </th>
          <th>Nombre </th>
          <th>Fecha</th>
          <th>Hora </th>
          <th>Calificacion</th>
          <th>Detalles</th>
          <th>Modificar </th>
          <th>Eliminar </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($Conferencias as $aux):?>
        <tr>
          <td><?php echo $aux['ponente_id']; ?></td>
          <td><?php echo $aux['nombre']; ?></td>
          <td><?php echo $aux['fecha']; ?></td>
          <td><?php echo $aux['hora']; ?></td>
          <td><?php echo $aux['calificacion']; ?></td>
          <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/details?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light black"><i class="material-icons">details</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">updated</i></a></td>
          <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">deleted_forever</i></a></td>
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
     <h4>Crear Conferencia</h4>
  
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/create_conferencia');?> class="col s12" enctype="multipart/form-data">
            <div class="input-field col s12">
              <input id="ponente_id" type="number" name="ponente_id" class="validate" required="" aria-required="true">
              <label for="ponente_id">Id del Ponente</label>
            </div>
            <div class="input-field col s12">
              <input id="nombre" type="text" name="nombre" class="validate" required="" aria-required="true">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              
              <input id="fecha" type="text" class="datepicker" name="fecha" required="" aria-required="true"/>
              <label for="fecha">Fecha</label>
            </div>
            <div class="input-field col s12">
              <input id="hora" type="text" name="hora" class="timepicker" required="" aria-required="true" />
              <label for="hora">Hora</label>
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

              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Icono</span>
                  <input id="btnicon" name="btnicon" type="file">
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="icono" name="icono" class="file-path validate" type="text" class="validate" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="icon" src="" class="responsive-img">
              </div>
            </div>          
  </div>
  <div class="modal-footer">
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
    <a href="#!" class="modal-close waves-effect waves-green btn-small">Cerrar</a>
    </form>
  </div>
</div>

 

 