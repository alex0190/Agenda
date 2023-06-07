<?php
session_start();

$contactos = Contacto::obtenerContactos();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Contactos</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilos.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/js/sweetalert2.min.js"></script>
<script>
$(document).ready(function() {
  $("#contactos").DataTable();
});

function eliminar(id_contacto)
{
	$.ajax({
		url: "<?php echo base_url(); ?>/acciones/contacto-eliminar",
		type: "POST",
		data: "id_contacto=" + id_contacto,
		success: function(data)
		{
			if(data == 1)
				window.location.reload(true);
			else
				Swal.fire('Hubo un problema al eliminar el contacto', '', 'error');
		}
	});
}

function confirmarEliminar(id_contacto)
{
	Swal.fire({
	    title: '¿Seguro que deseas eliminar el contacto?',
        text: "Una vez eliminado el contacto, se eliminarán sus datos y no podrán recuperarse.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            eliminar(id_contacto);
        }
    });
}
</script>
</head>
<body>
<section class="main container">
<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <a href="registrar" class="btn btn-primary">Nuevo contacto</a>
  <br><br>
  <div class="panel panel-default">
   <div class="panel-heading">
     <h3 class="panel-title">Lista de Contactos</h3>
   </div>
   <div class="panel-body">
    <table class="table table-striped" id="contactos" style="width: 100%;">
	 <thead>
      <tr>
	   <th>Nombre</th>
	   <th>Apellido Paterno</th>
	   <th>Apellido Materno</th>
	   <th>Tel. Casa</th>
	   <th>Tel. Celular</th>
	   <th>Acciones</th>
	  </tr>
	  </thead>
	  <tbody>
	  <?php
	   if(is_array($contactos))
	   {
		  foreach($contactos as $contacto)
		  {
	 ?>
	       <tr>
		    <td><?php echo $contacto["nombre"]; ?></td>
		    <td><?php echo $contacto["apellido_paterno"]; ?></td>
		    <td><?php echo $contacto["apellido_materno"]; ?></td>
		    <td><?php echo $contacto["casa"]; ?></td>
		    <td><?php echo $contacto["celular"]; ?></td>
		    <td>
		     <a href="editar/<?php echo $contacto["id_contacto"]; ?>">
		      <img src="<?php echo base_url(); ?>/img/editar.png" width="30" title="Editar contacto"></a>
			 <a href="detalle/<?php echo $contacto["id_contacto"]; ?>">
		     <img src="<?php echo base_url(); ?>/img/ver.png" width="30" title="Ver detalle del contacto"></a>
			 <a href="javascript:confirmarEliminar(<?php echo $contacto["id_contacto"]; ?>);">
		     <img src="<?php echo base_url(); ?>/img/eliminar.png" width="30" title="Eliminar contacto"></a>
		    </td>
		   </tr>
	 <?php
		  }
	   }
	 ?>
	 </tbody>
    </table>
   </div>
  </div>
 </div>
</div>
</section>
</body>
</html>