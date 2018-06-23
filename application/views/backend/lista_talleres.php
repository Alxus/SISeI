  <?if($_SESSION['SISeI_User']['tipo']<=1 || $_SESSION['SISeI_User']['tipo']==3):?>
  <a class="waves-effect btn modal-trigger blue" href="#addTaller">Agregar Taller</a>
  <div id="addTaller" class="modal modal-fixed-footer">
  	<div class="modal-content">
  		<?php $this->load->view('backend/formulario_talleres');?>
  	</div>
  	<div class="modal-footer">
  		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
  	</div>
  </div>
  <?endif;?>
  <div class="container row">
  	<?php foreach ($talleres as $t):?>
  		<div class="col s12 m6 l4">
  			<div class="card">
  				<div class="card-image">
  					<img src=<?=$t['imagen'];?>>
  				</div>
  				<div class="card-content">
  					<span class="card-title"><?=$t['nombre'];?></span>
  					<p><?=$t['descripcion'];?></p>
  				</div>
  			</div>
  		</div>
  	<?php endforeach;?>
  </div>