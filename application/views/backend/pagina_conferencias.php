
<div class="row">
  <div class="col s3 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nueva Conferencia</a></div>
  <?if($_SESSION['SISeI_User']['tipo']<=2):?>
  <a class="btn blue" target="_blank" href=<?=site_url('admin/panel/conferencias/pdf');?>>Imprimir lista</a>
  <?endif;?>   
</div>
<div class="container">
 <table class="responsive-table">
  <thead>

    <tr>
      <th>Nombre del Ponente</th>
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
        <td><?php echo $aux['ponente']; ?></td>
        <td><?php echo $aux['nombre']; ?></td>
        <td><?php echo $aux['fecha']; ?></td>
        <td><?php echo $aux['hora']; ?></td>
        <td><?php echo $aux['calificacion']; ?></td>
        <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/details?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light black"><i class="material-icons">info_outline</i></a></td>
        <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">edit</i></a></td>
        <td><a href="<?php echo base_url();?>index.php/Conferencias_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
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
     <h4 class="center-align">Crear Conferencia</h4>

     <form id="talleres-form" method="POST" action=<?php echo site_url('admin/create_conferencia');?> class="col s12" enctype="multipart/form-data">
      <div class= "input-field col s12">
       <select name="ponente_id" required="" aria-required="true">
        <option value="" disabled selected>Seleccione</option>
        <?php foreach ($Ponentes as $auxi):?> 
         <option value=<?php echo $auxi['id']; ?>><?php echo $auxi['nombres']." ".$auxi['apellidos']; ?></option>
       <?php endforeach;?>    
     </select>
     <label>Ponente</label>
   </div>

   <div class="input-field col s12">
    <input id="nombre" type="text" name="nombre" class="validate" required="" aria-required="true">
    <label for="nombre">Nombre</label>
  </div>
  <div class="input-field col s12">
    <textarea id="descripcion" name="descripcion" class="materialize-textarea" required="" aria-required="true" ></textarea>
    <label for="descripcion">Descripcion</label>
  </div>
  <div class="input-field col s12">
    <input id="ubicacion" type="text" name="ubicacion" class="validate" required="" aria-required="true">
    <label for="ubicacion">Ubicacion</label>
  </div>
  <div class="input-field col s12">     
    <input id="fecha" type="date" class="datepicker" name="fecha" required="" aria-required="true"/>
    <label for="fecha">Fecha</label>
  </div>
  <div class="input-field col s12">
    <input id="hora" type="time" name="hora" class="timepicker" required="" aria-required="true" />
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
    <div class="file-field input-field col s7">
      <div class="btn">
        <span>Logo de la Empresa</span>
        <input id="btnlog" name="btnlog" type="file">
      </div>
      <div class="file-path-wrapper hide-on-med-and-down">
        <input id="logo" name="logo" class="file-path validate" type="text" class="validate" required="" aria-required="true">
      </div>
    </div>
    <div class="col s5">
      <img id="log" src="" class="responsive-img">
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




