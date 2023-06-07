<?php
include_once("includes/config.php");
include_once("includes/clases/class.Contacto.php");

$entidad = $_GET["var1"];
$accion = $_GET["var2"];
$id = $_GET["var3"];

if(empty($entidad))
	$path = "index";
else
{
	if(strpos($entidad, ".") == false)
	{
	    if(file_exists($entidad.".php"))
	    {
		   // Se accede al archivo php principal del sitio
		
		   $path = $entidad;
		}
	    else if(file_exists($entidad))
	    {
	       // Se accede a alguna subcarpeta del directorio principal del sitio
	   
           $path = $entidad."/".$accion;	   
		}	
	}
	else
	{
		// Se accede a alguna subcarpeta del directorio includes/acciones
		
		$entidades = explode(".", $entidad);
		$path = "includes/".$entidades[0]."/".$entidades[1]."/".$accion;
	}
}

include("./".$path.".php");
?>