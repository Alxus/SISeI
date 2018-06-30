
<ul id="infotaller" class="sidenav sidenav-fixed">
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
	<h4>Fecha y lugar</h4>
	<p><?=$taller['fecha']." a las ".$taller['hora']." en ".$taller['lugar']?></p>
</div>