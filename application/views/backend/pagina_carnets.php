<nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo">Prueba Carnet</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
            <!-- Modal Trigger -->
      <li> <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a></li>   
    </ul>
  </div>
</nav>
<div class="container">
  <table>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Limite</th>
      <th>Descripcion</th>
      <th>Imagen</th>
      <th>Created</th>
      <th>Updated</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <?php foreach ($carnets as $aux):?>
    <tr>
       <td> <?php echo $aux['id']; ?></td>
       <td> <?php echo $aux['nombre']; ?> </td>
       <td> <?php echo $aux['precio']; ?> </td>
       <td> <?php echo $aux['limite']; ?> </td>
       <td> <?php echo $aux['descripcion']; ?> </td>
       <td> <?php echo $aux['imagen']; ?> </td>
       <td> <?php echo $aux['created_at']; ?> </td>
       <td> <?php echo $aux['updated_at']; ?> </td>
       <td> <a href="<?php echo base_url();?>index.php/Carnets_controller/edit?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">updated</i></a></td>
       <td> <a href="<?php echo base_url();?>index.php/Carnets_controller/delete?id=<?php echo $aux['id'];?>" class="btn modal-trigger btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">deleted_forever</i></a></td>
    </tr>
  <?php endforeach;?>
</table>
</div>  

<!-- Estructura Modal1 -->
<div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h1>
      Nuevo Carnet
    </h1>
    <?php
      echo form_open('Carnets_controller/add/');
      echo form_label('Nombre', 'nombre');
      echo form_input('nombre');echo '<br>';
      echo form_label('Precio', 'precio');
      echo form_input('precio');echo '<br>';     
      echo form_label('Limite', 'limite');
      echo form_input('limite');echo '<br>'; 
       echo form_label('Descripcion', 'descripcion');
      echo form_input('descripcion');echo '<br>'; 
      echo form_label('Imagen', 'imagen');
      echo form_input('imagen');echo '<br>'; 
      echo form_submit('botonSubmit', 'Enviar');
      echo form_close();
   ?>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
  </div>
</div>

<script type="text/javascript" src="../../../assets/js/materialize.min.js"></script>
  <script>
    M.AutoInit();
    $(document).ready(function(){
    $('.modal').modal();
  });
  </script>
