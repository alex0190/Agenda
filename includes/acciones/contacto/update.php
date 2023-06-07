<?php
$contacto = new Contacto($_POST["id_contacto"]);

$update = $contacto->updateDatos($_POST["nombre"], $_POST["apellidoP"], $_POST["apellidoM"], $_POST["correo"]);

if($update)
{
	if(!empty($_POST["foto"]))
	  $contacto->setImagen($_POST["foto"]);
  
    $contacto->setDomicilio($_POST["calle"], $_POST["numero"], $_POST["colonia"], $_POST["ciudad"], $_POST["estado"], $_POST["codPostal"]);
	$contacto->setTelefono($_POST["telCasa"], $_POST["telCelular"]);
	
	echo 1;
}
else
	echo 0;
?>