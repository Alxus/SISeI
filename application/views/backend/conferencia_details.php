<div class="row">
  <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="<?php echo site_url('admin/panel/conferencia');?>">Volver</a></div>
</div>
<div class="container">
  <h2 class="header"><?php echo $conferencias['nombre']; ?></h2>
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s4"> <img src="<?php echo $conferencias['imagen']; ?>"> </div>  
        <div class="col s4"> <img src="<?php echo $conferencias['icono']; ?>"> </div>  
        <div class="col s4">  <img src="<?php echo $conferencias['logo_empresa']; ?>"> </div>  
      </div>
      <div class="row">
        <div class="col s4"> <h4>Imagen</h4> </div>
        <div class="col s4"> <h4>Icono</h4> </div>
        <div class="col s4"><h4>Logo</h4>  </div>
      </div> 
    </div>
    <div class="container">
      <h4>Ponente: <?php echo $conferencias['ponente']; ?> </h4>
      <h4>Nombre: <?php echo $conferencias['nombre']; ?> </h4>
      <h4>Fecha: <?php echo $conferencias['fecha']; ?> </h4>
      <h4>Hora: <?php echo $conferencias['hora']; ?> </h4>
      <h4>Calificacion: <?php echo $conferencias['calificacion']; ?> </h4>
      <h4>Created_At: <?php echo $conferencias['created_at']; ?> </h4>
      <h4>Updated_At: <?php echo $conferencias['updated_at']; ?> </h4>
      <?if($_SESSION['SISeI_User']['tipo']<=3):?>
      <a class="waves-effect waves-light btn blue" href="<?php echo base_url();?>index.php/Conferencias_controller/edit?id=<?php echo $conferencias['id'];?>"><i class="material-icons white-text">edit</i>Editar</a>
      <a class="waves-effect waves-light btn red" href="<?php echo base_url();?>index.php/Conferencias_controller/delete?id=<?php echo $conferencias['id'];?>"><i class="material-icons white-text">delete</i>Eliminar</a>
      <?endif;?>
    </div> 
  </div>
</div>
<div id="Coments">
  <div class="row">
    <ul class="collection with-header">
      <li class="collection-header"><h4>Comentarios</h4></li>
      <?foreach($comentarios as $c):?>
      <li class="collection-item avatar">
        <img src="http://www.sisei.com.mx/assets/images/defaultUser.jpg" alt="" class="circle">
        <span class="title"><b><?=$c['autor']?></b></span>
        <p><?=$c['contenido']?></p>
      </li>
      <?endforeach;?>
    </ul>
  </div>
</div>