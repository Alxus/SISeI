$(document).ready(function(){
  $('.modal').modal();
  $('.dropdown-trigger').dropdown({constrainWidth:false, coverTrigger:false});
  $('select').formSelect({constrainWidth:true,coverTrigger:false});
  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
});

var nc;
var nm='<div id="searchByNombre" class="center">'+
'<label><i class="material-icons">search</i> Buscar por asistente nombre completo</label>'+
'<div class="input-field col s6">'+
'<input id="nombres" type="text" name="nombres">'+
'<label for="nombres">Nombres</label>'+
'</div>'+
'<div class="input-field col s6">'+
'<input id="apellidos" type="text" name="apellidos">'+
'<label for="apellidos">Apellidos</label>'+
'</div>'+
'</div>'+
'</div>';
var base_url=window.location.protocol + "//" + window.location.host + "/"+"SISeIXII/index.php/";
$("#btnlog").change(function() {
  readURL(this,'#log');
});
$("#btnicon").change(function() {
  readURL(this,'#icon');
});
$("#btnimg").change(function() {
  readURL(this,'#img');
});

//Funcion para que se vea una preview de la imagen a subir
function readURL(input,target) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(target).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//funciones para los forms con ajax
$('#login-form').submit(function(event){
  event.preventDefault();
  $.ajax({
    type        : 'POST',
    url         : $('#login-form').attr( "action" ),
    data        : {
      username: $('input[name=username]').val(),
      password: $('input[name=password]').val()
    },
    dataType    : 'json',
    encode          : false
  }).done(function (json){
      if(json!=null){//Good
        if(json.error=='ALL_OK'){//Iniciada sesión correctamente
          window.location.href='index.php/admin/panel';
        }else{//Error de sesión
          alert('Inicio de sesión invalido');
        }
      }else{
        alert('Ha ocurrido un error');
      }
    }).fail(function(xhr){
      console.log(xhr);
      alert("Error en el servidor");
    });
  });

$('#users-form').submit(function(event){
  event.preventDefault();
  $.ajax({
    type        : 'POST',
    url         : $('#users-form').attr( "action" ),
    data        : {
      username: $('input[name=username]').val(),
      password: $('input[name=password]').val(),
      nombres: $('input[name=nombres]').val(),
      apellidos: $('input[name=apellidos]').val(),
      tipo: $('select[name=tipo]').val()
    },
    dataType    : 'json',
    encode          : false
  }).done(function (json){
    if(json!=null){
      if(json.error=='ALL_OK'){
        alert("Usuario registrado");
        location.reload(true)  
      }
      if(json.error=='BAD_POST'){
        alert("Verifique los datos");
      }
      if(json.error=='NOT_CREATED'){
        alert("Este usuario ya esta registrado.");
      }
    }else{
      alert('Ha ocurrido un error');
    }
  }).fail(function(xhr){
    console.log(xhr);
    alert("Error en el servidor");
  });
});

$('input[name=filtro]').on('click',function(){
  if($('input[name=filtro]').is(':checked')){
   nc = $('#searchByNC').detach();
   $('#inputBusqueda').prepend(nm);
   $('#formSearch').attr( "action",base_url+"admin/searchAsistenteByName" );
 }
 else{
  nm = $('#searchByNombre').detach();
  $('#inputBusqueda').prepend(nc);
  $('#formSearch').attr( "action", base_url+"admin/searchAsistenteByNC" );
}
});

$('#formSearch').submit(function(event){
  event.preventDefault();
  if(!$('input[name=filtro]').is(':checked')){
    $.ajax({
      type        : 'POST',
      url         : $('#formSearch').attr( "action" ),
      data        : {
        dato: $('input[name=dato]').val()
      },
      dataType    : 'json',
      encode          : false
    }).done(function (json){
      if(json!=null){
        $('input[name=fb]').val(json.id_facebook).prop( "readonly", true );
        $('input[name=nombre]').val(json.nombre_real).prop( "readonly", true );
        $('input[name=apellido]').val(json.apellido_real).prop( "readonly", true );
        $('input[name=email]').val(json.email).prop( "readonly", true );
        $('input[name=tel]').val(json.tel).prop( "readonly", true );
        $('input[name=noControl]').val(json.noControl).prop( "readonly", true );
        $('select[name=carrera]').val(json.carrera).prop( "readonly", true );
        //$('input[name=carnet]').val(json.carnet);
        $('select[name=sexo]').val(json.sexo).prop( "readonly", true );
        $('select[name=talla]').val(json.talla).prop( "readonly", true );
        $('label').addClass('active');
      }else{
        alert('No se encontró el asistente');
      }
    }).fail(function(xhr){
      console.log(xhr);
      alert("Error en el servidor");
    });
  }else{
    $.ajax({
      type        : 'POST',
      url         : $('#formSearch').attr( "action" ),
      data        : {
        nombres: $('input[name=nombres]').val(),
        apellidos: $('input[name=apellidos]').val()        
      },
      dataType    : 'json',
      encode          : false
    }).done(function (json){
      if(json!=null){
        console.log(json);
      }else{
        alert('No se encontró el asistente');
      }
    }).fail(function(xhr){
      console.log(xhr);
      alert("Error en el servidor");
    });
  }
});

/*$('.eliminar').on('click',function(){
  if(confirm('Desea eliminar esta madre?')){
    window.location.href="talleres";
    alert('Borrado');
  }

  M.toast({html: '<span>¿Desea elminar el taller?</span>'+
    '<button class="btn-flat toast-action">Sí</button>'+
    '<button class="btn-flat toast-action">No</button>',
    classes:''})
});
*/



/*$('#talleres-form').submit(function(event){
  event.preventDefault();
  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    processData: false,
    contentType: false,
    cache: false,
    url         : $('#talleres-form').attr( "action" ),
    data        : {
      nombre: $('input[name=nombre]').val(),
      descripcion: $('textarea[name=descripcion]').val(),
      requisitos: $('textarea[name=requisitos]').val(),
      lugar: $('input[name=lugar]').val(),
      limite: $('input[name=limite]').val(),
      fecha: $('input[name=fecha]').val(),
      hora: $('input[name=hora]').val(),
      nivel: $('input[name=nivel]').val(),
      btnimg: $('input[name=btnimg]').val(),
      btnicon: $('input[name=btnicon]').val(),
      imagen: $('input[name=imagen]').val(),
      icono: $('input[name=icono]').val(),
    },
  }).done(function (json){
    if(json!=null){
      if(json.error=='ALL_OK'){
        alert("Taller agregado");
        window.location.href='admin/panel/talleres';
      }
      if(json.error=='BAD_POST'){
        alert("Verifique los datos");
      }
      if(json.error=='NOT_CREATED'){
        alert("Error en la base de datos");
      }
    }else{
      alert('Ha ocurrido un error');
    }
  }).fail(function(xhr){
    console.log(xhr);
    alert("Error en el servidor");
  });
});*/