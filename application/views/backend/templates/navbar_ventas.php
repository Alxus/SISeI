
<div class="navbar-fixed black-text">
  <nav id="navbar-ventas" class="grey lighten-4">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img src="http://www.sisei.com.mx/assets/images/logo_cosisei.png"></a>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons black-text">menu</i></a>
    </div>
  </nav>
</div>

<ul id="slide-out" class="sidenav">
  <li><div class="user-view">
      <div class="background">
        <img src="https://static-cdn.jtvnw.net/jtv_user_pictures/e91a3dcf-c15a-441a-b369-996922364cdc-profile_image-300x300.png">
      </div>
      <a href="#user"><img class="circle" src="http://www.sisei.com.mx/assets/images/sisei.jpg"></a>
      <a href="#realname"><span class="white-text name"><?=$_SESSION['SISeI_User']['nombres'].' '.$_SESSION['SISeI_User']['apellidos'];?></span></a>
      <a href="#username"><span class="white-text email"><?='@'.$_SESSION['SISeI_User']['username'];?></span></a>
    </div></li>
 <li><a href=<?php echo site_url('admin/panel/asistentes');?>><i class="material-icons">people</i>Asistentes</a></li>
 <li><a href=<?php echo site_url('admin/panel/usrlst');?>><i class="material-icons">account_circle</i>Usuarios</a></li>
 <li><div class="divider"></div></li>
 <li><a class="subheader">Ventas</a></li>
 <li><a href=<?php echo site_url('admin/panel/carnets');?>><i class="material-icons">assignment_ind
</i>Carnets</a></li>
 <li><a href=<?php echo site_url('admin/panel/ventas');?>><i class="material-icons">monetization_on
</i>Panel de ventas</a></li>
 <li><div class="divider"></div></li>
 <li><a class="subheader">Evento</a></li>
 <li><a href=<?echo site_url('admin/panel/talleres');?>><i class="material-icons">build</i>Talleres</a></li>
 <li><a href=<?php echo site_url('admin/panel/conferencia');?>><i class="material-icons">local_library</i>Conferencias</a></li>
 <li><div class="divider"></div></li>
<li><a href="#"><i class="material-icons">settings</i>Ajustes</a></li>
 <li><a href=<?php echo site_url('logout');?>><i class="material-icons">meeting_room</i>Salir</a></li>
</ul>

<ul id='eventos' class='dropdown-content'>
  <li><a href=<?echo site_url('admin/panel/talleres');?>>Talleres</a></li>
  <li><a href=<?php echo site_url('admin/panel/conferencia');?>>Conferencias</a></li>
</ul>