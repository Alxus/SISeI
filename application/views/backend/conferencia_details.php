<div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="<?php echo site_url('admin/panel/conferencia');?>">Volver</a></div>
   </div>
<div class="container">
    <h2 class="header"><?php echo $conferencias['nombre']; ?></h2>
    <div class="card horizontal">
      <div class="card-image">
        <img src="<?php echo $conferencias['imagen']; ?>">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>Id del Ponente: <?php echo $conferencias['ponente_id']; ?> </p>
          <p>Nombre: <?php echo $conferencias['nombre']; ?> </p>
          <p>Fecha: <?php echo $conferencias['fecha']; ?> </p>
          <p>Hora: <?php echo $conferencias['hora']; ?> </p>
          <p>Calificacion: <?php echo $conferencias['calificacion']; ?> </p>
          <p>Created_At: <?php echo $conferencias['created_at']; ?> </p>
          <p>Updated_At: <?php echo $conferencias['updated_at']; ?> </p>
         
        </div>
      </div>
    </div>

    <div class="conatiner">
      <div class="card">
        <div class="card-image">
          <img src="<?php echo $conferencias['icono']; ?>">
          <span class="card-title">Icono</span>
        </div>
       
      </div>
    </div>

  </div>