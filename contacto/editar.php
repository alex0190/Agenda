<?php
$contacto = new Contacto($id);
$domicilio = $contacto->getDomicilio();
$telefono = $contacto->getTelefono();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Editar Contacto</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilos.css">
<script src="<?php echo base_url(); ?>/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/js/sweetalert2.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
var id_contacto = <?php echo $contacto->id_contacto; ?>;

$(document).ready(function(){
	$("#fotoVal").change(function(){
		filePreviewImg(this);
	});
	
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

function filePreviewImg(archivo)
{
	if (archivo.files && archivo.files[0])
	{
		if(archivo.files[0].type == "image/jpeg" || archivo.files[0].type == "image/png")
		{
		    var img = new Image();
		
		    img.onload = function(){
			     $("#foto").attr("src", this.src);
		    }
		
		    img.src = URL.createObjectURL(archivo.files[0]);
		}
	    else
			Swal.fire('Solo puede cargar archivos jpg o png!!!!', '', 'error');
	}	
}

function actualizarContacto()
{
	var foto = $("#fotoVal")[0].files[0];
	
	$("#cargar").css("visibility", "visible");
	
	if(foto == undefined)
	{
	    editar("");
	}
	else
	{
		subirFoto(foto, function(data){
			if(data != "error")
			  editar(data);
		    else
			{
				$("#cargar").css("visibility", "hidden");
				Swal.fire('Hubó un problema al subir la foto!!!!', '', 'error');
			}
		});
	}
}

function editar(foto)
{
	var formulario = $("#form-editar");
	
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
		  url: "<?php echo base_url(); ?>/acciones.contacto/update",
		  type: "POST",
		  data: "id_contacto=" + id_contacto + "&nombre=" + nombre + "&apellidoP=" 
		      + apellidoP + "&apellidoM=" + apellidoM + "&telCasa=" + telCasa 
			  + "&telCelular=" + telCelular + "&correo=" + correo
			  + "&calle=" + calle + "&numero=" + numero + "&colonia=" + colonia
			  + "&codPostal=" + codPostal + "&ciudad=" + ciudad 
			  + "&estado=" + estado + "&foto=" + foto,
	      success: function(data){
				$("#cargar").css("visibility", "hidden");
				
				if(data == 1)
				{
					Swal.fire('Contacto actualizado correctamente!!!!', '', 'success').then((result) => {
                       if(result.value) {
                         window.location.reload(true);
					   }
					});
				}
                else			
		          Swal.fire('No se pudo actualizar al contacto!!!!', '', 'error');
		  }
	   });
	}	   
}

function subirFoto(foto, callback)
{
    var formData = new FormData();
	formData.append("foto", foto);
	    
    $.ajax({
        url: "<?php echo base_url(); ?>/includes/uploadArchivo",  
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
		    if(data != "error")
			{
				callback(data);
			}
			else
			{
				callback(data);
			}	    
	    }
	});
}
</script>
<style>
#cargar{
	background: rgba(255, 255, 255, .5);
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	z-index: 2000;
	display: flex;
	justify-content: center;
    align-items: center;
	visibility: hidden;
}

#cargar img{
	width: 100px;
	margin: 10px auto 0;
	display: block;
}

.img-rounded{
	width: 200px;
}
</style>
</head>
<body>
<section class="main container">
<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
 <div class="panel panel-default">
  <div class="panel-heading">
     <h3 class="panel-title">Editar Contacto</h3>
  </div>
  <div class="panel-body">
   <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-8">
    <form id="form-editar">
     <div class="row">
      <div class="form-group col-md-4 col-sm-4 col-xs-4">
       <label>Nombre:</label>
       <input type="text" class="form-control input-text" id="nombreVal" name="nombre" value="<?php echo $contacto->nombre; ?>">
      </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Apellido Paterno:</label>
	   <input type="text" class="form-control input-text" id="apellidoPVal" name="apellidoP" value="<?php echo $contacto->apellido_paterno; ?>">
	  </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Apellido Materno:</label>
	   <input type="text" class="form-control input-text" id="apellidoMVal" name="apellidoM" value="<?php echo $contacto->apellido_materno; ?>">
	  </div>
     </div>
     <div class="row">
      <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Telefono Casa</label>
	   <input type="text" class="form-control input-text" id="telCasaVal" name="telCasa" value="<?php echo $telefono["casa"]; ?>">
	  </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Telefono Celular</label>
	   <input type="text" class="form-control input-text" id="telCelularVal" name="telCelular" value="<?php echo $telefono["celular"]; ?>">
	  </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Email</label>
	   <input type="email" class="form-control input-text" id="correoVal" name="correo" value="<?php echo $contacto->correo; ?>">
	  </div>
     </div>
     <div class="row">
      <div class="form-group col-md-5 col-sm-5 col-xs-5">
	   <label>Calle</label>
	   <input type="text" class="form-control input-text" id="calleVal" name="calle" value="<?php echo $domicilio["calle"]; ?>">
	  </div>
	  <div class="form-group col-md-2 col-sm-2 col-xs-2">
	   <label>Número</label>
	   <input type="text" class="form-control input-text" id="numeroVal" name="numero" value="<?php echo $domicilio["numero"]; ?>">
	  </div>
	  <div class="form-group col-md-5 col-sm-5 col-xs-5">
	   <label>Colonia</label>
	   <input type="text" class="form-control input-text" id="coloniaVal" name="colonia" value="<?php echo $domicilio["colonia"]; ?>">
	  </div>
     </div>
     <div class="row">
      <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Código Postal</label>
	   <input type="text" class="form-control input-text" id="codPostalVal" name="codPostal" value="<?php echo $domicilio["cp"]; ?>">
	  </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Ciudad</label>
	   <input type="text" class="form-control input-text" id="ciudadVal" name="ciudad" value="<?php echo $domicilio["ciudad"]; ?>">
	  </div>
	  <div class="form-group col-md-4 col-sm-4 col-xs-4">
	   <label>Estado</label>
	   <input type="text" class="form-control input-text" id="estadoVal" name="estado" value="<?php echo $domicilio["estado"]; ?>">
	  </div>
     </div>
     <input type="button" class="btn btn-primary" value="Actualizar" onClick="actualizarContacto();">
    </form>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-4">
	 <form method="post">
	  <div class="form-group">
	   <input type="file" class="form-control" id="fotoVal">
	  </div>
	  <div class="form-group">
	   <img src="<?php echo base_url(); ?>/fotos/<?php echo !empty($contacto->foto) ? $contacto->foto : "contacto.png"; ?>" class="img-rounded" id="foto">
	  </div>
	  <input type="button" class="btn btn-warning" value="Subir">
	 </form>
	</div>
	<div id="cargar">
      <img src="<?php echo base_url(); ?>/img/circleWaitblue.gif">     
    </div>
	</div>
	</div>
  </div>
  <a href="../index">Regresar</a>
  </div>
</div>
</div>
</section>
</body>
</html>