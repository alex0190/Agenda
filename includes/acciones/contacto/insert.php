<?php
$id_contacto = Contacto::insert($_POST["nombre"], $_POST["apellidoP"], $_POST["apellidoM"], $_POST["correo"]);

if($id_contacto >= 1)
{
	$contacto = new Contacto($id_contacto);
	$contacto->setDomicilio($_POST["calle"], $_POST["numero"], $_POST["colonia"], $_POST["ciudad"], $_POST["estado"], $_POST["codPostal"]);
	$contacto->setTelefono($_POST["telCasa"], $_POST["telCelular"]);
	
	echo 1;
}
else
	echo 0;
?>