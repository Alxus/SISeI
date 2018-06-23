<div class="navbar-fixed black-text">
  <nav class="grey lighten-4">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img src="http://www.sisei.com.mx/assets/images/logo_cosisei.png"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href=<?php echo site_url('admin/panel/asistentes');?>>Asistentes</a></li>
        <li><a class='dropdown-trigger' href='#' data-target='eventos'>Evento<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href=<?php echo site_url('admin/panel/carnets');?>>Carnets</a></li>
        <li><a href=<?php echo site_url('admin/panel/usrlst');?>>Usuarios</a></li>
        <li><a href="#">Ajustes</a></li>
        <li><a href=<?php echo site_url('logout');?>>Salir</a></li>
      </ul>
    </div>
  </nav>
</div>

<ul id='eventos' class='dropdown-content'>
  <li><a href=<?echo site_url('admin/panel/talleres');?>>Talleres</a></li>
  <li><a href="#!">Conferencias</a></li>
</ul>