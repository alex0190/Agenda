<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Registrar Contacto</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilos.css">
<script src="<?php echo base_url(); ?>/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/js/sweetalert2.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	asignarReglasValidacion();
});

function asignarReglasValidacion()
{
 $("#form-registro").validate({
	 
  ignore: "",
  rules:{
    "nombre" : {required:true, maxlength:50},
	"apellidoP" : {required:true, maxlength:50},
	"apellidoM" : {maxlength:50},
	"correo" : {required:true, email:true, maxlength:40},
	"calle" : {maxlength:50},
	"numero" : {maxlength:10},
	"colonia" : {required:true, maxlength:50},
	"ciudad" : {required:true, maxlength:50},
	"estado" : {required:true, maxlength:50},
	"codPostal" : {required:true, number:true},
	"telCasa" : {digits:true, number:true, maxlength:10},
	"telCelular" : {digits:true, number:true, maxlength:10}
  }
 });
 
 $.extend($.validator.messages,{
   required: "Este campo es obligatorio",
   email: "Escriba un correo electronico valido",
   number: "Escriba solo numeros",
   maxlength: $.validator.format("Por favor, no escriba más de {0} caracteres.")
 });
}

function insert()
{
	var formulario = $("#form-registro");
	
	if(formulario.valid())
	{
	   var nombre = $("#nombreVal").val();
	   var apellidoP = $("#apellidoPVal").val();
	   var apellidoM = $("#apellidoMVal").val();
	   var telCasa = $("#telCasaVal").val();
	   var telCelular = $("#telCelularVal").val();
	   var correo = $("#correoVal").val();
	   var calle = $("#calleVal").val();
	   var numero = $("#numeroVal").val();
	   var colonia = $("#coloniaVal").val();
	   var codPostal = $("#codPostalVal").val();
	   var ciudad = $("#ciudadVal").val();
	   var estado = $("#estadoVal").val();
	
	   $.ajax({
		  url: "<?php echo base_url(); ?>/acciones.contacto/insert",
		  type: "POST",
		  data: "nombre=" + nombre + "&apellidoP=" + apellidoP + "&apellidoM=" + apellidoM
		      + "&telCasa=" + telCasa + "&telCelular=" + telCelular + "&correo=" + correo
			  + "&calle=" + calle + "&numero=" + numero + "&colonia=" + colonia
			  + "&codPostal=" + codPostal + "&ciudad=" + ciudad + "&estado=" + estado,
	      success: function(data){
				if(data >= 1)
				{
					Swal.fire('Contacto registrado correctamente!!!!', '', 'success').then((result) => {
                       if(result.value) {
                         window.location.reload(true);
					   }
					});
				}
                else			
		          Swal.fire('No se pudo registrar el contacto!!!!', '', 'error');
		  }
	   });
	}	   
}
</script>
</head>
<body>
<section class="main container">
<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
 <div class="panel panel-default">
  <div class="panel-heading">
     <h3 class="panel-title">Agregar Contacto</h3>
  </div>
  <div class="panel-body">
  <form id="form-registro">
   <div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-4">
     <label>Nombre:</label>
     <input type="text" class="form-control input-text" id="nombreVal" name="nombre">
    </div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Apellido Paterno:</label>
	 <input type="text" class="form-control input-text" id="apellidoPVal" name="apellidoP">
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Apellido Materno:</label>
	 <input type="text" class="form-control input-text" id="apellidoMVal" name="apellidoM">
	</div>
   </div>
   <div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Telefono Casa</label>
	 <input type="text" class="form-control input-text" id="telCasaVal" name="telCasa">
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Telefono Celular</label>
	 <input type="text" class="form-control input-text" id="telCelularVal" name="telCelular">
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Email</label>
	 <input type="email" class="form-control input-text" id="correoVal" name="email">
	</div>
   </div>
   <div class="row">
    <div class="form-group col-md-5 col-sm-4 col-xs-4">
	 <label>Calle</label>
	 <input type="text" class="form-control input-text" id="calleVal" name="calle">
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-2">
	 <label>Número</label>
	 <input type="text" class="form-control input-text" id="numeroVal" name="numero">
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-5">
	 <label>Colonia</label>
	 <input type="text" class="form-control input-text" id="coloniaVal" name="colonia">
	</div>
   </div>
   <div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Código Postal</label>
	 <input type="text" class="form-control input-text" id="codPostalVal" name="codPostal">
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Ciudad</label>
	 <input type="text" class="form-control input-text" id="ciudadVal" name="ciudad">
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-4">
	 <label>Estado</label>
	 <input type="text" class="form-control input-text" id="estadoVal" name="estado">
	</div>
   </div>
   <input type="button" class="btn btn-primary" id="boton" value="Guardar" onClick="insert();">
  </form>
  </div>
  </div>
  <a href="index">Regresar</a>
</div>
</div>
</section>
</body>
</html>