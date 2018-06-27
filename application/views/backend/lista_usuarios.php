<?if($_SESSION['SISeI_User']['tipo']<=1):?>
<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Agregar usuario</a>
<div id="modal1" class="modal">
  <div class="modal-content">
    <?$this->load->view('backend/formulario_usuarios');?>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
  </div>
</div>
<?endif;?>
<?if($_SESSION['SISeI_User']['tipo']<=2):?>
  <a class="btn" target="_blank" href=<?=site_url('admin/panel/usrlst/pdf');?>>Imprimir lista</a>
<?endif;?>
<table class="centered">
  <thead>
    <tr>
      <th>Username</th>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Fecha de creacion</th>
      <th>Fecha de actualización</th>
      <th>Ultimo Acceso</th>
    </tr>
  </thead>

  <tbody>
    <?foreach ($usuarios as $usr):?>
    <tr>
      <td><?=$usr['username'];?></td>
      <td><?=$usr['nombres'].' '.$usr['apellidos'];?></td>
      <?if($usr['tipo']==0):?>
      <td>Root</td>
      <?endif;?>
      <?if($usr['tipo']==1):?>
      <td>Admin</td>
      <?endif;?>
      <?if($usr['tipo']==2):?>
      <td>Logistica</td>
      <?endif;?>
      <?if($usr['tipo']==3):?>
      <td>Talleres y Conferencias</td>
      <?endif;?>
      <?if($usr['tipo']==4):?>
      <td>Vendedor</td>
      <?endif;?>
      <td><?=$usr['created_at'];?></td>
      <td><?=$usr['updated_at'];?></td>
      <td><?=$usr['last_accessed'];?></td>
    </tr>
    <?endforeach;?>
  </tbody>
</table>