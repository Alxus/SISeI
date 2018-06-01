$(document).ready(function(){
  $('.modal').modal();
});


function funcionEditable() {
        document.getElementById("nombre_real").disabled = false;
        document.getElementById("apellido_real").disabled = false;
        document.getElementById("no_control").disabled = false;
        document.getElementById("tel").disabled = false;
        document.getElementById("email").disabled = false;
        document.getElementById("carrera").disabled = false;
        document.getElementById("sexo").disabled = false;
        document.getElementById("created_at").disabled = false;
        document.getElementById("updated_at").disabled = false;
        document.getElementById("btn_Guardar").disabled = false;
        document.getElementById("btn_Cancelar").disabled = false;
    }

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
          window.location.href='admin/panel';
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
      tipo: $('input[name=tipo]').val()
    },
    dataType    : 'json',
    encode          : false
  }).done(function (json){
    if(json!=null){
      if(json.error=='ALL_OK'){
        alert("Usuario registrado");
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
});