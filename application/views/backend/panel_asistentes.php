    <div class="row d">
    	<!-- _________________________Pestaña de informacion_________________________ -->
    	<div class="col s3 grey darken-4 hide-on-med-and-down">
    		<!-- Vacio -->
    		<ul>
    			<li><div class="user-view">
    				<div class="background"></div>
    				<a href="#user"><img class="circle responsive-img" src="http://www.sisei.com.mx/assets/images/sisei.jpg"></a>
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
    	<div class="container col s12 m9">

    		<nav>
    			<div class="nav-wrapper grey darken-4">
    				<div style="padding: 5px"></div>
    		
    				<ul id="nav-mobile" class="center">
    							<?if($_SESSION['SISeI_User']['tipo']<=2):?>
    				<a class="brand-logo center"><a class="btn center" target="_blank" href=<?=site_url('admin/panel/asistentes/pdf');?>>Imprimir lista</a></a>
    				<?endif;?>
    				</ul>
    			</div>
    		</nav>

    		<div style="padding: 3px"></div>
    		<nav>
    			<div class="nav-wrapper grey darken-4">
    				<a href="#" class="brand-logo center">LISTA ASISTENTES</a>
    				<ul id="nav-mobile" class="left hide-on-med-and-down">
    					
    				</ul>
    			</div>
    		</nav>

    		<ul class="collection">
    			<?php foreach($asistentes as $aux){ ?> <!-- Rellena el listado de asistentes -->
    			<li class="collection-item avatar z-depth-3">
    				<img src="http://www.sisei.com.mx/assets/images/defaultUser.jpg" class="circle"><!--Esta imagen sera cambiada por la de face-->
    				<span class="title"><?php echo $aux['nombre_real']." ".$aux['apellido_real'];?></span>
    				<p><?php echo $aux['no_control'];?><br>
    					<?php echo $aux['carrera'];?>
    				</p>
    				<a href="" class="secondary-content modal-trigger">
    					<table class="responsive-table">
    						<tbody>
    							<tr>
    								<td><a href="<?php echo base_url();?>index.php/Asistentes_controller/details?id=<?php echo $aux['id'];?>"><i class="material-icons" style="font-size: 35px">control_point</i></a></td>
    								<td><i class="material-icons" style="font-size: 35px">settings</i></td>
    								<td><i class="material-icons" style="font-size: 35px">delete</i></td>

    							</tbody>
    						</table>
    					</a>
					    <!-- <a href="" class="secondary-content modal-trigger">
					    	<i class="material-icons" style="font-size: 35px">control_point</i>
					    	<i class="material-icons" style="font-size: 35px">settings</i>
					    	<i class="material-icons" style="font-size: 35px">delete</i>
					    </a> -->

					</li>
				<?php } ?>
			</ul>
		</div>
		<!-- _________________________________________________________________________ -->



		<!-- ________________________Modal Registro Structure_________________________
		<div id="modalRegistro" class="modal ">
			<div class="modal-content">
				<div class="row">

					<nav>
						<div class="nav-wrapper grey darken-4">
							<a href="" class="brand-logo center">REGISTRO</a>
							<ul id="nav-mobile" class="left hide-on-med-and-down">
								
							</ul>
						</div>
					</nav>
					<div style="padding: 5px"></div>

					<div class="row">
						<form id="asistentes-form" class="col s12" method="POST" action=<?php echo site_url('admin/create_asistente');?> enctype="multipart/form-data">

							<div class="row">

								<div class="row">
									<div class="input-field col s6">
										<input id="nombre_real" name="nombre_real" type="text" class="validate" required="" aria-required="true">
										<label for="nombre_real">Nombre Real</label>
									</div>

									<div class="input-field col s6">
										<input id="apellido_real" name="apellido_real" type="text" class="validate" required="" aria-required="true">
										<label for="apellido_real">Apellido Real</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s6">
										<input id="no_control" name="no_control" type="text" class="validate" required="" aria-required="true">
										<label for="no_control">No. Control</label>
									</div>

									<div class="input-field col s6">
										<input id="tel" name="tel" type="text" class="validate" required="" aria-required="true">
										<label for="tel">Telefono</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s6">
										<input id="email" name="email" type="text" class="validate" required="" aria-required="true"
										<label for="email">Email</label>
									</div>

									<div class="input-field col s3">
										<input id="carrera" name="carrera" type="number" class="validate" required="" aria-required="true">
										<label for="carrera">Carrera</label>
									</div>

									<div class="input-field col s3">
										<input id="sexo" name="sexo" type="number" class="validate" required="" aria-required="true">
										<label for="sexo">Sexo</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s3">
										<input id="talla" name="talla"  type="number" class="validate" required="" aria-required="true">
										<label for="talla">Talla</label>
									</div>

									<div class="input-field col s2">
										<input id="pro" name="pro" type="number" class="validate" required="" aria-required="true">
										<label for="pro">Pro</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer right-align">
						<div><button id="btn_Guardar" class="waves-effect waves-light btn" type="submit" name="action">Guardar</button></div>
						<div><button id="btn_Cancelar" href="!#" class="modal-close waves-effect waves-light btn">Cancelar</button></div>
					</div>
				</form>
			</div>
			 _________________________________________________________________________ -->
		</div>
		