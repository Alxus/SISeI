
<ul id="infotaller" class="sidenav sidenav-fixed hide-on-med-and-down">
	<li><div class="user-view">
		<div class="background">
			<img class="responsive-img" src=<?=$taller['imagen']?>>
		</div>
		<a><img class="circle" src=<?=$taller['icono']?>></a>
	</div></li>
	<li><p>Limite<span class="new badge blue" data-badge-caption=""><?=$taller['limite']?></span></p></li>
	<li><p>Registrados<span class="new badge blue" data-badge-caption=""><?=$taller['registrados']?></span></p></li>
	<li><p>Nivel<span class="new badge blue" data-badge-caption=""><?=$taller['nivel']?></span></p></li>
	<li><p>Calificacíón <span class="new badge blue" data-badge-caption=""><?=$taller['calificacion']?></span></p></li>
	<li><p>Creado:<span class="right"><?=$taller['created_at']?></span></p></li>
	<li><p>Ultima actualización:<span class="right"><?=$taller['updated_at']?></span></p></li>
	<li><td><a class="btn blue"href="#!"><i class="material-icons white-text">edit</i>Editar</a></td></li>
	<li><td><a class="btn red eliminar" href="#!"><i class="material-icons white-text">delete</i>Eliminar</a></td></li>
</ul>
<div class="infor">
	<h3 class="center"><?=$taller['nombre']?></h3>
	<div class="section">
		<img class="responsive-img hide-on-med-and-up" width="320" src=<?=$taller['imagen']?>>
		<img class="responsive-img hide-on-med-and-up" width="320" src=<?=$taller['icono']?>>
		<ul class="hide-on-med-and-up">
			<li><p>Limite<span class="new badge blue" data-badge-caption=""><?=$taller['limite']?></span></p></li>
			<li><p>Registrados<span class="new badge blue" data-badge-caption=""><?=$taller['registrados']?></span></p></li>
			<li><p>Nivel<span class="new badge blue" data-badge-caption=""><?=$taller['nivel']?></span></p></li>
			<li><p>Calificacíón <span class="new badge blue" data-badge-caption=""><?=$taller['calificacion']?></span></p></li>
			<li><p>Creado:<span class="right"><?=$taller['created_at']?></span></p></li>
			<li><p>Ultima actualización:<span class="right"><?=$taller['updated_at']?></span></p></li>
		</ul>
		<h4>Información general</h4>
		<h5>Descripción</h5>
		<p><?=$taller['descripcion']?></p>
		<h5>Tallerista</h5>
		<p><?=$taller['tallerista']?></p>
	</div>
	<div class="divider"></div>
	<div class="section">
		<h4>Requisitos</h4>
		<pre><?=$taller['requisitos']?></pre>
	</div>
	<div class="divider"></div>
	<h4>Lugar y Fecha</h4>
	<p><?=$taller['lugar']." el ".$taller['fecha']." a las ".$taller['hora'];?></p>
	<div class="row center hide-on-med-and-up">
		<a class="btn blue"href="#!"><i class="material-icons white-text">edit</i>Editar</a>
		<a class="btn red eliminar" href="#!"><i class="material-icons white-text">delete</i>Eliminar</a>
	</div>
</div>
