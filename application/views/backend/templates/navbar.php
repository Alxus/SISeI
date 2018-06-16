<!--Hay que mover esto a un css aparte-->
<style type="text/css">
  .brand-logo img{
    max-height: 2em; 
    margin-left: 1em;
  }
  .hiddendiv{
    display: none;
  }
</style>
<!--Esta navbar la editaremos cuando agreguemos secciones-->
  <div class="navbar-fixed black-text">
    <nav class="grey lighten-4">
      <div class="nav-wrapper">
        <a href="#!" class="brand-logo"><img src="http://www.sisei.com.mx/assets/images/logo_cosisei.png"></a>
        <ul class="right hide-on-med-and-down table-of-contents">
          <li><a href=<?php echo site_url('admin/panel/asistentes');?>>Asistentes</a></li>
          <li><a href=<?php echo site_url('admin/panel/carnets');?>>Carnets</a></li>
          <?if($_SESSION['SISeI_User']['tipo']<=1):?>
          <li><a href=<?php echo site_url('admin/panel/usuarios');?>>Usuarios</a></li>
          <li><a href=<?php echo site_url('admin/panel/usuarios');?>>Ajustes</a></li>
          <?endif;?>
          <li><a href=<?php echo site_url('logout');?>>Salir</a></li>
        </ul>
      </div>
    </nav>
  </div>
        