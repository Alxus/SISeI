<div class="row">
	<div class="col s12 m6 offset-m3">
		<div class="card grey lighten-4">
			<div class="card-content">
				<span class="card-title center">Crear Usuario</span>
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
						<input id="tipo" type="hidden" name="tipo" value="1">
						<button class="btn-flat right blue">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>