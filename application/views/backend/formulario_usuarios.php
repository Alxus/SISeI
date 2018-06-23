<h4 class="center">Crear Usuario</h4>
<div class="row">
	<form id="users-form" method="POST" action=<?php echo site_url("admin/create_user");?> class="col s12">
		<div class="input-field col s12">
			<input id="username" type="text" name="username">
			<label for="username">Usuario</label>
		</div>
		<div class="input-field col s12">
			<input id="password" type="password" name="password">
			<label for="password">Contraseña</label>
		</div>
		<div class="input-field col s12">
			<input id="nombres" type="text" name="nombres">
			<label for="nombres">Nombres</label>
		</div>
		<div class="input-field col s12">
			<input id="apellidos" type="text" name="apellidos">
			<label for="apellidos">Apellidos</label>
		</div>
		<div class="input-field col s12">
			<select name="tipo">
				<option value="" disabled selected>Seleccione</option>
				<?php if ($_SESSION['SISeI_User']['tipo']==0): ?>
					<option value="1">Admin</option>
				<?php endif ?>
				<option value="2">Logistica</option>
				<option value="3">Talleres y Conferencias</option>
				<option value="4">Vendedor</option>
			</select>
			<label>Tipo</label>
		</div>						
		<button class="btn-flat right blue">Crear</button>
	</form>
</div>
