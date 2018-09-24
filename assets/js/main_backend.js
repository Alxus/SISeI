$(document).ready(function(){
  $('.modal').modal();
  $('.dropdown-trigger').dropdown({constrainWidth:false, coverTrigger:false});
  $('select').formSelect({constrainWidth:true,coverTrigger:false});
  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
});

var nc;
var nm='<div id="searchByNombre">'+
'<div class="input-field col s12">'+
'<i class="material-icons prefix">search</i>'+
'<input id="nombres" type="text" name="name">'+
'<label for="nombres">Buscar por nombre</label>'+
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
var listaorig = $('#listAsist');
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
        if(JSON.stringify(json)!='[]'){
          results(json);
        }else{
          alert('No se encontró el asistente');
        }
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
        nombre: $('input[name=name]').val()
      },
      dataType    : 'json',
      encode          : false
    }).done(function (json){
      if(json!=null){
        if(json!=$.parseJSON('[]') && json.length!=0){
          results(json);
        }else{
          alert('No se encontró el asistente');
        }
      }else{
        alert('No se encontró el asistente');
      }
    }).fail(function(xhr){
      console.log(xhr);
      alert("Error en el servidor");
    });
  }
});

$('body').on('click', '.btnCobrar', function (){
  call($(this).attr('id'));
});

$('body').on('click', '#btnReturn', function (){
  regresar();
});

function call(id){
  $.get( base_url+"api/get_asistente/"+id,
    function( json ) {
      if(json.estado=="PAGADO" && json.nc=="Básico"){
        if(confirm('¿Desea cobrar el carnet completo?')){
          setearcompleto(json);
          $('input[name=dato]').val('');
          $('input[name=name]').val('');
          $('#lisresult').remove();
          $('#tablaAsist').append(listaorig);
          $('.collapsible').collapsible("close");
        }else{
          return;
        }
      } else if(json.estado=="PAGADO" && json.nc=="Completo"){
        alert("Este asistente ya pagó.");
        return;
      }
      setear(json);
      $('input[name=dato]').val('');
      $('input[name=name]').val('');
      $('#lisresult').remove();
      $('#tablaAsist').append(listaorig);
      $('.collapsible').collapsible("close");
    },
    "json");
}

function regresar(){
  $('input[name=dato]').val('');
  $('input[name=name]').val('');
  $('#lisresult').remove();
  $('#tablaAsist').append(listaorig);
  $('#btnReturn').remove();
  $('.collapsible').collapsible("close");
}

function setear(json){
  $('input[name=fb]').val(json.facebook_id).prop( "readonly", true );
  $('input[name=nombre]').val(json.nombre_real).prop( "readonly", true );
  $('input[name=apellido]').val(json.apellido_real).prop( "readonly", true );
  $('input[name=email]').val(json.email).prop( "readonly", true );
  $('input[name=tel]').val(json.tel).prop( "readonly", true );
  $('input[name=noControl]').val(json.no_control).prop( "readonly", true );
  $('select[name=carrera]').val(json.carrera).prop( "readonly", true );
  $('select[name=carnet]').val(json.carnet_id);
  $('select[name=sexo]').val(json.sexo).prop( "readonly", true );
  $('select[name=talla]').val(json.talla).prop( "readonly", true );
  $('label').addClass('active');
  $('#btnReturn').remove();
}

function setearcompleto(json){
  $('input[name=fb]').val(json.facebook_id).prop( "readonly", true );
  $('input[name=nombre]').val(json.nombre_real).prop( "readonly", true );
  $('input[name=apellido]').val(json.apellido_real).prop( "readonly", true );
  $('input[name=email]').val(json.email).prop( "readonly", true );
  $('input[name=tel]').val(json.tel).prop( "readonly", true );
  $('input[name=noControl]').val(json.no_control).prop( "readonly", true );
  $('select[name=carrera]').val(json.carrera).prop( "readonly", true );
  $('select[name=carnet]').val(2);
  $('select[name=sexo]').val(json.sexo).prop( "readonly", true );
  $('select[name=talla]').val(json.talla).prop( "readonly", true );
  $('label').addClass('active');
  $('#btnReturn').remove();
}

function results(json){
  $('#listAsist').remove();
  $('#lisresult').remove();
  $('#btnReturn').remove();
  var newList = '<tbody id="lisresult">';
  for (var i = 0; i < json.length; i++) {
    newList+='<tr>'+
    '<td>'+(json[i].no_control!=null?json[i].no_control:'N/A')+'</td>'+
    '<td>'+json[i].nombre_real+' '+json[i].apellido_real+'</td>'+
    '<td>'+(json[i].nc!=null?json[i].nc:'N/A')+'</td>'+
    '<td>'+(json[i].estado!=null?json[i].estado:'N/A')+'</td>'+
    '<td>'+(json[i].debe!=null?'$ '+json[i].debe:'$ 0')+'</td>'+
    '<td><a id="'+json[i].id+'/'+(json[i].cid!=null?json[i].cid:0)+'" class="btn waves-effect btn-flat green btnCobrar white-text">Seleccionar</a></td>'+
    '</tr>';
  }
  newList+='</tbody>';
  $('#tablaAsist').append(newList);
  $('#return').append('<a id="btnReturn" class="btn btn-flat red white-text">Regresar</a>');
}