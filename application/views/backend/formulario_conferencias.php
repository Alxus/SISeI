
<div class="container">
    <h4>Modificar Conferencias</h4>
   <form id="talleres-form" method="POST" action=<?php echo site_url('admin/update_conferencia');?>  enctype="multipart/form-data">
            <div class="input-field col s12">
               <input type="hidden" name="id" value="<?php echo $conferencia['id']; ?>" required="" aria-required="true">
              <input id="ponente_id" type="text" name="ponente_id" value="<?php echo $conferencia['ponente_id']; ?>" required="" aria-required="true">
              <label for="ponente_id">Id del Ponente</label>
            </div>
            <div class="input-field col s12">
              <input id="nombre" type="text" name="nombre" value="<?php echo $conferencia['nombre']; ?>" required="" aria-required="true" >
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
              <input id="fecha" type="text" name="fecha" class="datepicker" value="<?php echo $conferencia['fecha']; ?>" required="" aria-required="true" >
              <label for="fecha">Fecha</label>
            </div>
            <div class="input-field col s12">
              <input id="hora" type="text" name="hora" class="timepicker" value="<?php echo $conferencia['hora']; ?>" required="" aria-required="true">
              <label for="hora">Hora</label>
            </div>
            <div class="input-field col s12">
              <input id="calificacion" type="number" name="calificacion" value="<?php echo $conferencia['calificacion']; ?>" required="" aria-required="true">
              <label for="calificacion">Calificacion</label>
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
                <img id="ico" src="<?php echo $conferencia['icono']; ?>" class="responsive-img">
              </div>
             <div class="col s2 offset-s5"> <button href="#!" class=" modal-action modal-close waves-effect waves-green btn-small" input="submit"> Modificar</button> </div>
  </div>
</div>