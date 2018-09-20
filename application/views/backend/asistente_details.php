<!-- _____________________________Modal Structure_____________________________ -->
		<nav>
			<div class="nav-wrapper grey darken-4">
				<a href="" class="brand-logo center">INFORMACIÓN DE ASISTENTE</a>
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
					    <form class="col s10 offset-s1">

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['facebook_name'];?>" id="facebook_name" type="text" class="validate">
					          <label for="first_name">Facebook Name</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['facebook_first_name'];?>" id="facebook_first_name" type="text" class="validate">
					          <label for="last_name">Facebook First Name</label>
					        </div>
					      </div>

						  <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['nombre_real'];?>" id="nombre_real" type="text" class="validate">
					          <label for="first_name">Nombre Real</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['apellido_real'];?>" id="apellido_real" type="text" class="validate">
					          <label for="last_name">Apellido Real</label>
					        </div>
					      </div>

						  <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['no_control'];?>" id="no_control" type="text" class="validate">
					          <label for="first_name">No. Control</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['tel'];?>" id="tel" type="text" class="validate">
					          <label for="last_name">Telefono</label>
					        </div>
					      </div>

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['email'];?>" id="email" type="text" class="validate">
					          <label for="first_name">Email</label>
					        </div>

					        <div class="input-field col s3">
					        	<select disabled id="sexo" class="browser-default" name="sexo">
								<option value="" disabled>Seleccione</option>
								<option value=1 <?php echo ($asistente['carrera']==1) ? 'Selected' : ''; ?>>Sistemas</option>
								<option value=2 <?php echo ($asistente['carrera']==2) ? 'Selected' : ''; ?>>TICs</option>
								<option value=3 <?php echo ($asistente['carrera']==3) ? 'Selected' : ''; ?>>Electrónica</option>
								<option value=4 <?php echo ($asistente['carrera']==4) ? 'Selected' : ''; ?>>Mecatrónica</option>
								<option value=5 <?php echo ($asistente['carrera']==5) ? 'Selected' : ''; ?>>Eléctrica</option>
								<option value=6 <?php echo ($asistente['carrera']==6) ? 'Selected' : ''; ?>>Mecánica</option>
								<option value=7 <?php echo ($asistente['carrera']==7) ? 'Selected' : ''; ?>>Ambiental</option>
								<option value=8 <?php echo ($asistente['carrera']==8) ? 'Selected' : ''; ?>>Bioquímica</option>
								<option value=9 <?php echo ($asistente['carrera']==9) ? 'Selected' : ''; ?>>Renovables</option>
								<option value=10 <?php echo ($asistente['carrera']==10) ? 'Selected' : ''; ?>>Gestíon</option>
								<option value=11 <?php echo ($asistente['carrera']==11) ? 'Selected' : ''; ?>>Industrial</option>
							  	</select>
							  	<label class="active">Sexo</label>
					        </div>

					        <div class="input-field col s3">
					          <select disabled id="sexo" class="browser-default" name="sexo">
								<option value="" disabled>Seleccione</option>
								<option value=0 <?php echo ($asistente['sexo']==0) ? 'Selected' : ''; ?>>Hombre</option>
								<option value=1 <?php echo ($asistente['sexo']==1) ? 'Selected' : ''; ?>>Mujer</option>
							  </select>
							  <label class="active">Sexo</label>
					        </div>
					      </div>

					      <div class="row">
								<div class="input-field col s3">
									<select disabled id="talla" class="browser-default" name="talla">
										<option value="" disabled>Seleccione</option>
										<option value=1 <?php echo ($asistente['talla']==1) ? 'Selected' : ''; ?>>Extra Chica</option>
										<option value=2 <?php echo ($asistente['talla']==2) ? 'Selected' : ''; ?>>Chica</option>
										<option value=3 <?php echo ($asistente['talla']==3) ? 'Selected' : ''; ?>>Mediana</option>
										<option value=4 <?php echo ($asistente['talla']==4) ? 'Selected' : ''; ?>>Grande</option>
										<option value=5 <?php echo ($asistente['talla']==5) ? 'Selected' : ''; ?>>Extra Grande</option>
									</select>
									<label class="active">Talla</label>
								</div>

								<div class="input-field col s2">
									<select disabled id="pro" class="browser-default" name="pro">
										<option value="" disabled>Seleccione</option>
										<option value=0 <?php echo ($asistente['pro']==0) ? 'Selected' : ''; ?>>Básico</option>
										<option value=1 <?php echo ($asistente['pro']==1) ? 'Selected' : ''; ?>>Completo</option>
									</select>
									<label class="active">Carnet</label>
								</div>
						</div>

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['created_at'];?>" id="created_at" type="text" class="validate">
					          <label for="first_name">Created Date</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $asistente['updated_at'];?>" id="updated_at" type="text" class="validate">
					          <label for="last_name">Updated Date</label>
					        </div>
					      </div>
					    </form>
				</div>
		    </div>
		    <div class="right-align">
		       	<a href=<?php echo site_url('admin/panel/asistentes');?> id="btn_Eliminar" class="red modal-action modal-close waves-effect waves-light btn">Regresar al listado</a>
		       	<div style="padding: 15px"></div>
		    </div>
		</div>
	</div>
		<!-- _________________________________________________________________________ -->