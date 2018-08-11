<div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="<?php echo site_url('admin/panel/carnets');?>">Volver</a></div>
   </div>
<div class="container">
    <h3 class="header"><?php echo $carnet['nombre']; ?></h3>
    <div class="card horizontal">
      <div class="card-image">
        <img src="<?php echo $carnet['imagen']; ?>">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <h4>Precio: <?php echo $carnet['precio']; ?> </h4> 
          <h4>Limite: <?php echo $carnet['limite']; ?> </h4>
          <h4>Descripcion: <?php echo $carnet['descripcion']; ?> </h4>
           <h4>Tipo: <?php echo $carnet['tipo']; ?> </h4>
          <h4>Created_At: <?php echo $carnet['created_at']; ?> </h4>
          <h4>Updated_At: <?php echo $carnet['updated_at']; ?> </h4>
          <div class="container">
             <a class="waves-effect waves-light btn blue" href="<?php echo base_url();?>index.php/Carnets_controller/edit?id=<?php echo $carnet['id'];?>"><i class="material-icons white-text">edit</i>Editar</a>
            <a class="waves-effect waves-light btn red" href="<?php echo base_url();?>index.php/Carnets_controller/delete?id=<?php echo $carnet['id'];?>"><i class="material-icons white-text">delete</i>Eliminar</a>
          </div>
        </div>
      </div>
     
    </div>
  </div>