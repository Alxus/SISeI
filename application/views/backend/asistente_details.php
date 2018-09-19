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
					          <input disabled value="<?php echo $asistente['carrera'];?>" id="carrera" type="text" class="validate">
					          <label for="first_name">Carrera</label>
					        </div>

					        <div class="input-field col s3">
					          <input disabled value="<?php echo $asistente['sexo'];?>" id="sexo" type="text" class="validate">
					          <label for="last_name">Sexo</label>
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