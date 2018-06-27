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
  <?if($_SESSION['SISeI_User']['tipo']<=2):?>
  <a class="btn blue" target="_blank" href=<?=site_url('admin/panel/talleres/pdf');?>>Imprimir lista</a>
  <?endif;?>
  <table class="centered">
    <thead>
      <th>Id</th>
      <th>Nombre</th>
      <th>Tallerista</th>
      <th>Descripcion</th>
      <th>Fecha</th>
      <th></th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <?foreach($talleres as $t):?>
      <tr>
        <td><?=$t['id'];?></td>
        <td><?=$t['nombre'];?></td>
        <td><?=$t['tallerista'];?></td>
        <td><?=$t['descripcion'];?></td>
        <td><?=$t['fecha'];?></td>
        <td><a class="btn-floating blue"href="#"><i class="material-icons">edit</i></a></td>
        <td><a class="btn-floating red eliminar" href="#"><i class="material-icons">delete</i></a></td>
        <td><a class="btn-floating green "href=<?=site_url('admin/panel/talleres/info/'.$t['id']);?>><i class="material-icons">info_outline</i></a></td>
      </tr>
      <?endforeach;?>
    </tbody>
  </table>