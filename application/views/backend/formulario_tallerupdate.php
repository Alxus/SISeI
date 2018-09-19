<div class="container">
	<h5 class="card-title center">Modificar Taller</h5>
	<form class="row" id="talleres-form" method="POST" action=<?php echo site_url('admin/update_taller/');?> class="col s12" enctype="multipart/form-data">
		<div class= "input-field col s12">
              <input type="hidden" name="id" value="<?php echo $taller['id']; ?>" required="" aria-required="true">
              <select name="ponente_id" value =1>
                  <?php foreach ($Ponentes as $auxi):?> 
                     <option value=<?php echo $auxi['id']; ?> <?php echo ($auxi['id']==$taller['ponente_id']) ? 'Selected' : ''; ?>><?php echo $auxi['nombres']." ".$auxi['apellidos']; ?></option>
                  <?php endforeach;?>    
            </select>
            <label>Ponente</label>
            </div>
		<div class="input-field col s12">
			<input id="nombre" type="text" name="nombre" value="<?php echo $taller['nombre']; ?>">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s12">
			<textarea id="descripcion" name="descripcion" class="materialize-textarea"><?php echo $taller['descripcion']; ?></textarea>
			<label for="descripcion">Descripción</label>
		</div>
		<div class="input-field col s12">
			<textarea id="requisitos" name="requisitos" class="materialize-textarea" ><?php echo $taller['requisitos']; ?></textarea>
			<label for="requisitos">Requisitos</label>
		</div>
		<div class="input-field col s12">
			<input id="lugar" type="text" name="lugar" value="<?php echo $taller['lugar']; ?>">
			<label for="lugar">Lugar</label>
		</div>
		<div class="input-field col s6 m4">
			<input id="fecha" type="date" name="fecha" value="<?php echo $taller['fecha']; ?>">
			<label for="fecha">Fecha</label>
		</div>
		<div class="input-field col s6 m3">
			<input id="hora" type="time" name="hora" value="<?php echo $taller['hora']; ?>">
			<label for="hora">Hora</label>
		</div>
		<div class="input-field col s6 m2">
			<input id="limite" type="text" name="limite" value="<?php echo $taller['limite']; ?>">
			<label for="limite">Limite</label>
		</div>
		<div class="input-field col s6 m2">
			<input id="nivel" type="text" name="nivel" value="<?php echo $taller['nivel']; ?>">
			<label for="nivel">Nivel</label>
		</div>
		<div class="row">
			<div class="file-field input-field col s6">
				<div class="btn-flat blue white-text">
					<span>Imagen</span>
					<input id="btnimg" name="btnimg" type="file">
				</div>
				<div class="file-path-wrapper hide-on-med-and-down">
					<input hidden id="imagen" name="imagen" class="file-path validate" type="text" value="<?php echo $taller['imagen']; ?>">
				</div>
			</div>
			<div class="file-field input-field col s6">
				<div class="btn-flat blue white-text">
					<span>Icono</span>
					<input id="btnicon" name="btnicon" type="file" >
				</div>
				<div class="file-path-wrapper hide-on-med-and-down">
					<input hidden id="icono" name="icono" class="file-path validate" type="text" value="<?php echo $taller['icono']; ?>">
				</div>
			</div>
			<div class="col s6">
				<img id="img" src="<?php echo $taller['imagen']; ?>" class="responsive-img">
			</div>
			<div class="col s6">
				<img id="icon" src="<?php echo $taller['icono']; ?>" class="responsive-img">
			</div>
		</div>
		<div class="row">
			<div class="col s2 offset-s4">
				<button type="submit" class="btn-flat red white-text">Modificar</button>
			</div>
			<div class="col s2">		
				<a href=<?php echo site_url('admin/panel/talleres');?> class="btn-flat red white-text">Cancelar</a>
			</div>
		</div>
	</form>
</div>