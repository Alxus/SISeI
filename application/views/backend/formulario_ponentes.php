<div class="container">
	
			<h4 class="center-align" >Modificar Ponente</h4>
	  	
	    <form id="talleres-form" method="POST" action=<?php echo site_url('admin/update_ponente');?> class="col s12" enctype="multipart/form-data">
	            <div class="input-field col s12">
	              <input type="hidden" name="id" value="<?php echo $ponente['id']; ?>" required="" aria-required="true">
	              <input id="nombres" type="text" name="nombres" value="<?php echo $ponente['nombres']; ?>"  required="" aria-required="true">
	              <label for="nombres">Nombres</label>
	            </div>
	            <div class="input-field col s12">
	              <input id="apellidos" type="text" name="apellidos" value="<?php echo $ponente['apellidos']; ?>"  required="" aria-required="true">
	              <label for="apellidos">Apellidos</label>
	            </div>
	            <div class="input-field col s12">
	              <input id="tel" type="number" name="tel" value="<?php echo $ponente['tel']; ?>" required="" aria-required="true" >
	              <label for="tel">Telefono</label>
	            </div>
	            <div class="input-field col s12">
	              <input id="email" type="email" name="email" value="<?php echo $ponente['email']; ?>"  required="" aria-required="true">
	              <label for="email">Email</label>
	            </div>
	              <div class="input-field col s12">
	              <input id="linkedin" type="text" name="linkedin" value="<?php echo $ponente['linkedin']; ?>"  required="" aria-required="true">
	              <label for="linkedin">Linkedin</label>
	            </div>
	              <div class="input-field col s12">
	              <textarea id="descripcion" name="descripcion" class="materialize-textarea" required="" aria-required="true" ><?php echo $ponente['descripcion']; ?></textarea>
	              <label for="descripcion">Descripcion</label>
	            </div>
	           <div class="row">
		         <div class="col s2 offset-s4"> <button href="#!" class="btn-flat red white-text" input="submit"> Modificar</button> </div>
		         <div class="col s2"> <a href="<?php echo site_url('admin/panel/ponentes');?>" class="btn-flat red white-text" > Cancelar</a> </div>
		       </div>
	    </form>
	</div>
</div>  
    