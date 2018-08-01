<div class="row">
	<div class="col s12 m7 l8 hide-on-small-only">
		<div class="card">
			<div class="card-content">
				<table>
					<thead>
						<tr>
							<th>No. Control</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Carnet</th>
							<th>Estado</th>
							<th>Debe</th>
						</tr>
					</thead>
					<tbody>
						<?foreach($Asistentes as $a):?>
						<tr>
							<td><?=$a['no_control']!=null?$a['no_control']:'N/A';?></td>
							<td><?=$a['nombre_real'];?></td>
							<td><?=$a['apellido_real'];?></td>
							<td><?=$a['carnet']!=null?$a['carnet']:'N/A';?></td>
							<td><?=$a['estado']!=null?$a['estado']:'N/A';?></td>
							<td><?=$a['debe']!=null?'$ '.$a['debe']:'$ 0';?></td>
						</tr>
						<?endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="col s12 m5 l4">
		<ul class="collapsible">
			<li>
				<div class="collapsible-header"><i class="material-icons">search</i>Buscar Asistente</div>
				<div class="collapsible-body">
					<form id="formSearch" method="POST" action=<?=site_url('admin/searchAsistenteByNC')?>>
						<div class="row" id="inputBusqueda">
							<div class="input-field col s12" id="searchByNC">
								<i class="material-icons prefix">search</i>
								<input id="buscar" type="text" name="dato"></input>
								<label for="buscar">Buscar por No. Control</label>
							</div>
							<div class="center">
								<label>Buscar por: </label>
								<div class="switch">
									<label>
										No. Control
										<input name="filtro" type="checkbox">
										<span class="lever"></span>
										Nombre
									</label>
								</div>
							</div>
						</div>
						<div class="right-align">
							<button class="btn waves-effect" type="submit" >buscar</button>
						</div>
					</form>
				</div>
			</li>
		</ul>
		<div class="card">
			<div class="card-content">
				<form  id="formVTA" onsubmit="setTimeout(function () { window.location.reload(); }, 10)" method="POST" action=<?=site_url('admin/panel/ventas/Abono')?>>
					<div class="row">
						<div class="input-field col s6">
							<input hidden id="fb" type="text" name="fb">
							<input id="nombre" type="text" name="nombre">
							<label for="nombre">Nombres</label>
						</div>
						<div class="input-field col s6">
							<input id="apellido" type="text" name="apellido">
							<label for="apellido">Apellidos</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="email" type="email" name="email">
							<label for="email">Correo</label>
						</div>
						<div class="input-field col s6">
							<input id="tel" type="text" name="tel">
							<label for="tel">Telefono</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="noControl" type="text" name="noControl">
							<label for="noControl">No. Control</label>
						</div>
						<div class="input-field col s6">
							<select name="carrera">
								<option value="" disabled selected>Seleccione</option>
								<option value="1">Sistemas</option>
								<option value="2">Mecatronica</option>
								<option value="3">TyCs</option>
							</select>
							<label>Carrera</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<select name="carnet">
								<option value="" disabled selected>Seleccione</option>
								<?php foreach ($Carnets as $c): ?>
									<option value=<?=$c['id'];?>><?=$c['nombre']?></option>
								<?php endforeach ?>
							</select>
							<label>Carnet</label>
						</div>
						<div class="input-field col s6">
							<input id="abono" type="text" name="abono">
							<label for="abono">Pago/Abono</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<select name="sexo">
								<option value="" disabled selected>Seleccione</option>
								<option value="0">Hombre</option>
								<option value="1">Mujer</option>
							</select>
							<label>Sexo</label>
						</div>
						<div class="input-field col s6">
							<select name="talla">
								<option value="" disabled selected>Seleccione</option>
								<option value="1">Extra Chica</option>
								<option value="2">Chica</option>
								<option value="3">Mediana</option>
								<option value="4">Grande</option>
								<option value="5">Extra Grande</option>
							</select>
							<label>Talla</label>
						</div>
					</div>
					<div class="card-action">
						<div class="right-align">
							<button class="btn blue waves-effect" type="submit" formtarget="_blank">Registrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

