<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
  <div id="modal1" class="modal">
    <div class="modal-content">
      <?$this->load->view('backend/formulario_usuarios'):?>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
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
      <td><?=$ur['nombres'].' '.$usr['apellidos'];?></td>
      <?switch ($usr['tipo']):?>
      <?case 0:?>
      <td>Root</td>
      <?break;?>
      <?case 1:?>
      <td>Admin</td>
      <?break;?>
      <?case 2:?>
      <td>Logistica</td>
      <?break;?>
      <?case 3:?>
      <td>Talleres y Conferencias</td>
      <?break;?>
      <?case 4:?>
      <td>Vendedor</td>
      <?break;?>
      <?endswitch;?>
      <td><?=$usr['created_at'];?></td>
      <td><?=$usr['updated_at'];?></td>
      <td><?=$usr['last_accessed'];?></td>
    </tr>
    <?endforeach;?>
  </tbody>
</table>