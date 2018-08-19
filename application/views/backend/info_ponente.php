<div class="row">
      <div class="col s2 offset-s5"><a class="waves-effect waves-light btn modal-trigger" href="<?php echo site_url('admin/panel/ponentes');?>">Volver</a></div>
   </div>
<div class="container">
    <h3 class="header"><?php echo $ponente['nombres']; ?> <?php echo $ponente['apellidos']; ?></h3>
      <div class="card horizontal">
          <div class="card-image">
            <img src="<?php echo $ponente['imagen']; ?>">
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <h6>Nombre Taller: <?php echo (isset($taller) && $taller != null && count($taller)) > 0 ? $taller[0]['nombre'] : ''; ?> </h6>
              <h6>Nombre Conferencia: <?php echo (isset($conferencia) && $conferencia != null && count($conferencia)) > 0 ? $conferencia[0]['nombre'] : ''; ?> </h6>
              <h6>Telefono: <?php echo $ponente['tel']; ?> </h6>
              <h6>Email: <?php echo $ponente['email']; ?> </h6>
              <h6>Linkedin: <?php echo $ponente['linkedin']; ?> </h6>
              <h6>Descripcion: <?php echo $ponente['descripcion']; ?> </h6>
              <h6>Imagen: <?php echo $ponente['imagen']; ?> </h6>
              <h6>Created_At: <?php echo $ponente['created_at']; ?> </h6>
              <h6>Updated_At: <?php echo $ponente['updated_at']; ?> </h6>
              <div class="container">
                <a class="waves-effect waves-light blue btn" href="<?php echo base_url();?>index.php/Ponentes_controller/edit?id=<?php echo $ponente['id'];?>">Modificar</a>
                <a class="waves-effect waves-light red btn" href="<?php echo base_url();?>index.php/Ponentes_controller/delete?id=<?php echo $ponente['id'];?>">Eliminar</a>
            </div>
          </div> 
        </div>
  </div>
</div>  