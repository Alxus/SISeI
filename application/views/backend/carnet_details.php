<div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="<?php echo site_url('admin/panel/carnets');?>">Volver</a></div>
   </div>
<div class="container">
    <h2 class="header"><?php echo $carnet['nombre']; ?></h2>
    <div class="card horizontal">
      <div class="card-image">
        <img src="<?php echo $carnet['imagen']; ?>">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>Precio: <?php echo $carnet['precio']; ?> </p>
          <p>Limite: <?php echo $carnet['limite']; ?> </p>
          <p>Descripcion: <?php echo $carnet['descripcion']; ?> </p>
          <p>Created_At: <?php echo $carnet['created_at']; ?> </p>
          <p>Updated_At: <?php echo $carnet['updated_at']; ?> </p>
         
        </div>
      </div>
    </div>
  </div>