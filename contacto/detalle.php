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
<title>Detalle del Contacto</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilos.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
<style>
.div-datos{
	display: flex;
	justify-content: space-around;
	align-items: center;
}

.datos-contacto{
	width: 50%;
}

.datos-imagen{
	width: 25%;
}

.datos{
	width: 100%;
	padding: 0;
	overflow: hidden;
}

.datos div{
	float: left;
	width: 48%;
	padding: 3px;
}
</style>
</head>
<body>
<section class="main container">
<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-default">
   <div class="panel-heading">
     <h3 class="panel-title">Detalle del Contacto</h3>
   </div>
   <div class="panel-body">
    <div class="div-datos">
	 <div class="datos-contacto">
	  <h3>Datos del Contacto</h3>
	  <div class="datos">
	   <div>
	    <p><b>Nombre(s):</b> <?php echo $contacto->nombre; ?></p>
	   </div>
	   <div>
	    <p><b>Apellido Paterno:</b> <?php echo $contacto->apellido_paterno; ?></p>
	   </div>
	   <div>
	    <p><b>Apellido Materno:</b> <?php echo $contacto->apellido_materno; ?></p>
	   </div>
	   <div>
	    <p><b>Email:</b> <?php echo $contacto->correo; ?></p>
	   </div>
	   <div>
	    <p><b>Telefono Casa:</b> <?php echo $telefono["casa"]; ?></p>
	   </div>
	   <div>
	    <p><b>Telefono Celular:</b> <?php echo $telefono["celular"]; ?></p>
	   </div>
	   <div>
	    <p><b>Calle:</b> <?php echo $domicilio["calle"]; ?></p>
	   </div>
	   <div>
	    <p><b>Número:</b> <?php echo $domicilio["numero"]; ?></p>
	   </div>
	   <div>
	    <p><b>Colonia:</b> <?php echo $domicilio["colonia"]; ?></p>
	   </div>
	   <div>
	    <p><b>CP:</b> <?php echo $domicilio["cp"]; ?></p>
	   </div>
	   <div>
	    <p><b>Ciudad:</b> <?php echo $domicilio["ciudad"]; ?></p>
	   </div>
	   <div>
	    <p><b>Estado:</b> <?php echo $domicilio["estado"]; ?></p>
	   </div>
	  </div>
	 </div>
	 <div class="datos-imagen">
	  <?php
	   if(!empty($contacto->foto))
	   {
	  ?>
	      <img src="<?php echo base_url(); ?>/fotos/<?php echo $contacto->foto; ?>" style="width: 100%;" class="img-rounded">
	  <?php
	   }
	   else
	   {
	  ?>
	      <img src="<?php echo base_url(); ?>/fotos/contacto.png" style="width: 100%;" class="img-rounded">
	  <?php
	   }
	  ?>
	 </div>
	</div>
   </div>
  </div>
  <a href="../index">Regresar</a>
 </div>
</div>
</section>
</body>
</html>