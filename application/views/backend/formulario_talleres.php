	
<h5 class="card-title center">Crear Taller</h5>
<form class="row" id="talleres-form" method="POST" action=<?php echo site_url('admin/create_taller');?> class="col s12" enctype="multipart/form-data">
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
		<input id="nombre" type="text" name="nombre">
		<label for="nombre">Nombre</label>
	</div>
	<div class="input-field col s12">
		<textarea id="descripcion" name="descripcion" class="materialize-textarea"></textarea>
		<label for="descripcion">Descripción</label>
	</div>
	<div class="input-field col s12">
		<textarea id="requisitos" name="requisitos" class="materialize-textarea"></textarea>
		<label for="requisitos">Requisitos</label>
	</div>
	<div class="input-field col s12">
		<input id="lugar" type="text" name="lugar">
		<label for="lugar">Lugar</label>
	</div>
	<div class="input-field col s6 m4">
		<input id="fecha" type="date" name="fecha">
		<label for="fecha">Fecha</label>
	</div>
	<div class="input-field col s6 m3">
		<input id="hora" type="time" name="hora">
		<label for="hora">Hora</label>
	</div>
	<div class="input-field col s6 m2">
		<input id="limite" type="text" name="limite">
		<label for="limite">Limite</label>
	</div>
	<div class="input-field col s6 m2">
		<input id="nivel" type="text" name="nivel">
		<label for="nivel">Nivel</label>
	</div>
	<div class="row">
		<div class="file-field input-field col s6">
			<div class="btn-flat blue white-text">
				<span>Imagen</span>
				<input id="btnimg" name="btnimg" type="file">
			</div>
			<div class="file-path-wrapper hide-on-med-and-down">
				<input id="imagen" name="imagen" class="file-path validate" type="text">
			</div>
		</div>
		<div class="file-field input-field col s6">
			<div class="btn-flat blue white-text">
				<span>Icono</span>
				<input id="btnicon" name="btnicon" type="file">
			</div>
			<div class="file-path-wrapper hide-on-med-and-down">
				<input id="icono" name="icono" class="file-path validate" type="text">
			</div>
		</div>
		<div class="col s6">
			<img id="img" src="" class="responsive-img">
		</div>
		<div class="col s6">
			<img id="icon" src="" class="responsive-img">
		</div>
	</div>
	<button type="submit" class="btn-flat right blue white-text">Crear</button>
</form>
