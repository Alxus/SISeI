  <a class="waves-effect btn modal-trigger blue" href="#addTaller">Agregar Taller</a>
	<div class="container row">
		<?php for($i=0; $i<sizeof($talleres); $i++):?>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l4">
				<div class="card">
					<div class="card-image">
						<img src=<?=$talleres[$i]['imagen'];?>>
					</div>
					<div class="card-content">
						<span class="card-title"><?=$talleres[$i]['nombre'];?></span>
						<p><?=$talleres[$i]['descripcion'];?></p>
					</div>
				</div>
			</div>
		<?php endfor;?>
	</div>


	<div id="addTaller" class="modal modal-fixed-footer">
		<div class="modal-content">
			<?php $this->load->view('backend/formulario_talleres');?>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
		</div>
	</div>