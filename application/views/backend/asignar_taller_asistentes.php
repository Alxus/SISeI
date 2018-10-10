<!-- _____________________________Modal Structure_____________________________ -->
		<nav>
			<div class="nav-wrapper grey darken-4">
				<a href="" class="brand-logo center">ASIGNAR TALLERES</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down"></ul>
			</div>
		</nav>
	<div class="container">

		<div id="modal1" class="col s12">
		    <div class="modal-content">
		      	<h6>
			      	<ul class="collection">
						<li class="collection-item avatar">
						    <img src="http://www.sisei.com.mx/Assets/img/defaultUser.jpg" class="circle"><!--Esta imagen sera cambiada por la de face-->
						    <span class="title"><?php echo $asistente['nombre_real']." ".$asistente['apellido_real'];?></span>

						</li>
					</ul>
				</h6>
				<div class="row">
					    <form id="asistentes-form" name="asistentes-form" class="col s10 offset-s1" method="POST" action=<?php echo site_url('admin/asignar_taller_asistente');?>  enctype="multipart/form-data">

						  <div class="row">
					        <div class="input-field col s6">
					          <input type="hidden" name="id" value="<?php echo $asistente['id']; ?>" required="" aria-required="true">
					          <input disabled value="<?php echo $asistente['nombre_real'];?>" id="nombre_real" name="nombre_real" type="text">
					          <label for="nombre_real">Nombre Real</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['apellido_real'];?>" id="apellido_real" name="apellido_real" type="text">
					          <label for="apellido_real">Apellido Real</label>
					        </div>
					      </div>

						  <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['no_control'];?>" id="no_control" name="no_control" type="text">
					          <label for="no_control">No. Control</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['tel'];?>" id="tel" name="tel" type="text">
					          <label for="tel">Telefono</label>
					        </div>
					      </div>

					      <div class="row">

								<div class="input-field col s10">
									<select id="taller_id" class="browser-default" name="taller_id">
										<option value="" disabled>Seleccione</option>
										<?php foreach($talleres as $aux){ ?>
										<option value=<?php echo $aux['id'];?>> <?php echo $aux['nombre'];?> </option>
										<?php } ?>
									</select>
									<label class="active">Taller</label>
								</div>

						</div>

					      <div class="row">
				              <div class="col s2 offset-s4">
				                <button type="submit" class="btn-flat red white-text">Asignar</button>
				              </div>
				              <div class="col s2">    
				                <a href=<?php echo site_url('admin/panel/asistentes');?> id="btn_Eliminar" class="red modal-action modal-close waves-effect waves-light btn">Cancelar</a>
				              </div>
				          </div>

					    </form>
				</div>
		    </div>
		</div>
	</div>
		<!-- _________________________________________________________________________ -->