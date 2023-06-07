<?php
$contacto = new Contacto($_POST["id_contacto"]);

if(!empty($contacto->foto))
{
	$path = "fotos/".$contacto->foto;
	
    unlink($path);		
}

$eliminar = Contacto::eliminarContacto($_POST["id_contacto"]);

if($eliminar)
	echo 1;
else
	echo 0;
?>