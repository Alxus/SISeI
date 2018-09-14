
<div class="container">
    <h4 class="center-align">Modificar Conferencias</h4>
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/update_conferencia');?>  enctype="multipart/form-data">
            <div class= "input-field col s12">
              <input type="hidden" name="id" value="<?php echo $conferencia['id']; ?>" required="" aria-required="true">
              <select name="ponente_id" value =1>
                  <?php foreach ($Ponentes as $auxi):?> 
                     <option value=<?php echo $auxi['id']; ?> <?php echo ($auxi['id']==$conferencia['ponente_id']) ? 'Selected' : ''; ?>><?php echo $auxi['nombres']." ".$auxi['apellidos']; ?></option>
                  <?php endforeach;?>    
            </select>
            <label>Ponente</label>
            </div>
            <div class="input-field col s12">
              <input id="nombre" type="text" name="nombre" value="<?php echo $conferencia['nombre']; ?>" required="" aria-required="true" >
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <textarea id="descripcion" name="descripcion" class="materialize-textarea" required="" aria-required="true" ><?php echo $conferencia['descripcion']; ?></textarea>
              <label for="descripcion">Descripcion</label>
            </div>
            <div class="input-field col s12">
              <input id="ubicacion" type="text" name="ubicacion" value="<?php echo $conferencia['ubicacion']; ?>" required="" aria-required="true">
              <label for="ubicacion">Ubicacion</label>
            </div>
            <div class="input-field col s12">
              <input id="fecha" type="date" name="fecha" class="datepicker" value="<?php echo $conferencia['fecha']; ?>" required="" aria-required="true" >
              <label for="fecha">Fecha</label>
            </div>
            <div class="input-field col s12">
              <input id="hora" type="time" name="hora" class="timepicker" value="<?php echo $conferencia['hora']; ?>" required="" aria-required="true">
              <label for="hora">Hora</label>
            </div>
            <div class="row">
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Imagen</span>
                  <input id="btnimg" name="btnimg" type="file" >
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="imagen" name="imagen" class="file-path validate" type="text" value="<?php echo $conferencia['imagen']; ?>" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="img" src="<?php echo $conferencia['imagen']; ?>" class="responsive-img">
              </div>    
               <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Icono</span>
                  <input id="btnicon" name="btnicon" type="file" >
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="icono" name="icono" class="file-path validate" type="text" value="<?php echo $conferencia['icono']; ?>" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="icon" src="<?php echo $conferencia['icono']; ?>" class="responsive-img">
              </div>
              <div class="file-field input-field col s7">
                <div class="btn">
                  <span>Logo de la Empresa</span>
                  <input id="btnlog" name="btnlog" type="file">
                </div>
                <div class="file-path-wrapper hide-on-med-and-down">
                  <input id="logo" name="logo" class="file-path validate" type="text" class="validate" value="<?php echo $conferencia['logo_empresa'];?>" required="" aria-required="true">
                </div>
              </div>
              <div class="col s5">
                <img id="log" src="<?php echo $conferencia['logo_empresa']; ?>" class="responsive-img">
              </div>
              
           </div>
           <div class="row">
            <div class="col s2 offset-s4">
              <button type="submit" class="btn-flat red white-text">Modificar</button>
            </div>
            <div class="col s2">    
              <a href=<?php echo site_url('admin/panel/conferencia');?> class="btn-flat red white-text">Cancelar</a>
            </div>
          </div>
        </form>
</div>