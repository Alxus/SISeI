    <div class="row d">
    	<!-- _________________________Pestaña de informacion_________________________ -->
    	<div class="col s3 grey darken-4">
    		<!-- Vacio -->
				<ul>
    				<li><div class="user-view">
      						<div class="background"></div>
      						<a href="#user"><img class="circle responsive-img" src="assets/img/sisei.jpg"></a>
      						<a href="#name"><span class="white-text name"><H3 align="center">SISeI XXII</H1></span></a><BR/>
    					</div>
    				</li>
    				<li><div class="divider"></div></li>
    				<li><a class="subheader"><H5 align="center">INFORMACION IMPORTANTE DE LA BD</H5></a></li>
    				<li><div class="divider"></div></li>
  				</ul>
			<!-- Vacio -->
    	</div>
    	<!-- _________________________________________________________________________ -->

    	<!-- __________________________Pestaña de asistentes__________________________ -->
    	<div class="container col s9">
		    <nav>
		      <div class="nav-wrapper grey darken-4">
		        <a href="#" class="brand-logo center">ASISTENTES</a>
		        <ul id="nav-mobile" class="left hide-on-med-and-down">
		          
		        </ul>
		      </div>
		    </nav>

    		<ul class="collection">
			<?php foreach($asistente->result() as $fila){ ?> <!-- Rellena el listado de asistentes -->
					<li class="collection-item avatar z-depth-3">
					    <img src="assets/img/asistente.jpg" class="circle"><!--Esta imagen sera cambiada por la de face-->
					    <span class="title"><?php echo $fila->nombre_real." ".$fila->apellido_real;?></span>
					    <p><?php echo $fila->no_control;?><br>
					        <?php echo $fila->carrera;?>
					    </p>
					    <a href="#modal1" class="secondary-content modal-trigger"><i class="medium material-icons">control_point</i> </a>
					</li>
			<?php } ?>
			</ul>
		</div>
		<!-- _________________________________________________________________________ -->

		<!-- _____________________________Modal Structure_____________________________ -->
		<div id="modal1" class="modal ">
		    <div class="modal-content">
		      	<h6>
			      	<ul class="collection">
						<li class="collection-item avatar">
						    <img src="assets/img/asistente.jpg" class="circle"><!--Esta imagen sera cambiada por la de face-->
						    <span class="title"><?php echo $fila->nombre_real." ".$fila->apellido_real;?></span>
						    <a href="#modal1" class="secondary-content modal-trigger"><button onclick="funcionEditable()" class="small material-icons">build</button> </a>
						</li>
					</ul>
				</h6>
				<div class="row">
					<div class="row">
					    <form class="col s12">

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->facebook_name;?>" id="facebook_name" type="text" class="validate">
					          <label for="first_name">Facebook Name</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->facebook_first_name;?>" id="facebook_first_name" type="text" class="validate">
					          <label for="last_name">Facebook First Name</label>
					        </div>
					      </div>

						  <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->nombre_real;?>" id="nombre_real" type="text" class="validate">
					          <label for="first_name">Nombre Real</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->apellido_real;?>" id="apellido_real" type="text" class="validate">
					          <label for="last_name">Apellido Real</label>
					        </div>
					      </div>

						  <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->no_control;?>" id="no_control" type="text" class="validate">
					          <label for="first_name">No. Control</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->tel;?>" id="tel" type="text" class="validate">
					          <label for="last_name">Telefono</label>
					        </div>
					      </div>

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->email;?>" id="email" type="text" class="validate">
					          <label for="first_name">Email</label>
					        </div>

					        <div class="input-field col s3">
					          <input disabled value="<?php echo $fila->carrera;?>" id="carrera" type="text" class="validate">
					          <label for="first_name">Carrera</label>
					        </div>

					        <div class="input-field col s3">
					          <input disabled value="<?php echo $fila->sexo;?>" id="sexo" type="text" class="validate">
					          <label for="last_name">Sexo</label>
					        </div>
					      </div>

					      <div class="row">
					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->created_at;?>" id="created_at" type="text" class="validate">
					          <label for="first_name">Created Date</label>
					        </div>

					        <div class="input-field col s6">
					          <input disabled value="<?php echo $fila->updated_at;?>" id="updated_at" type="text" class="validate">
					          <label for="last_name">Updated Date</label>
					        </div>
					      </div>
					    </form>
					  </div>
					<!--<table class="col s6">
				        <thead>
				          <tr>
				              <th>Nombre Facebook</th>
				              <td><?php echo $fila->facebook_name;?></td>
				          </tr>
				          <tr>
				              <th>Primer Nombre Facebook</th>
				               <td><?php echo $fila->facebook_first_name;?></td>
				          </tr>
				          <tr>
				              <th>Link de Facebook</th>
				               <td><?php echo $fila->facebook_link;?></td>
				          </tr>
				          <tr>
				              <th>Telefono</th>
				               <td><?php echo $fila->tel;?></td>
				          </tr>
				          <tr>
				              <th>Email</th>
				               <td><?php echo $fila->email;?></td>
				          </tr>
				          <tr>
				              <th>Carrera</th>
				               <td><?php echo $fila->carrera;?></td>
				          </tr>
				          <tr>
				              <th>Sexo</th>
				               <td><?php echo $fila->sexo;?></td>
				          </tr>
				          <tr>
				              <th>Fecha Alta</th>
				               <td><?php echo $fila->created_at;?></td>
				          </tr>
				          <tr>
				              <th>Fecha Actualizacion</th>
				               <td><?php echo $fila->updated_at;?></td>
				          </tr>
				        </thead>
				    </table> -->
				</div>
		    </div>
		    <div class="modal-footer row">
		       	<div class="col s2 offset-s4"><button id="btn_Guardar" disabled class="waves-effect waves-light btn">Guardar</button></div>
		       	<div class="col s2"><button id="btn_Cancelar" disabled class="waves-effect waves-light btn">Cancelar</button></div>
		       	<div class="col s2 offset-s10"><a id="btn_Eliminar" class="red modal-action modal-close waves-effect waves-light btn">Eliminar</a></div>
		    </div>
		</div>
		<!-- _________________________________________________________________________ -->
	</div>
    