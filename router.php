<?php
include_once("includes/config.php");
include_once("includes/clases/class.Contacto.php");

// Analizar URL
$uri = $_SERVER['REQUEST_URI'];
// Eliminar parámetros de consulta
if ($pos = strpos($uri, '?')) $uri = substr($uri, 0, $pos);
// Eliminar la ruta raíz
$path = substr($uri, strlen(dirname($_SERVER['PHP_SELF'])) + 1);
unset($uri, $pos);

// Termina en /
if (substr($path, -1) === '/') $path = substr($path, 0, -1);

// Obtenemos los parámetros de la ruta
$params = explode('/', $path);
$entidad = $params[0] ?? '';
$accion = $params[1] ?? '';
$id = $params[2] ?? '';
unset($params, $path);

// 
if (empty($entidad)) $path = "index";
else {
	if (strpos($entidad, ".") == false) {
		if (file_exists($entidad . ".php")) {
			// Se accede al archivo php principal del sitio

			$path = $entidad;
		} else if (file_exists($entidad)) {
			// Se accede a alguna subcarpeta del directorio principal del sitio

			$path = $entidad . "/" . $accion;
		}
	} else {
		// Se accede a alguna subcarpeta del directorio includes/acciones

		$entidades = explode(".", $entidad);
		$path = "includes/" . $entidades[0] . "/" . $entidades[1] . "/" . $accion;
	}
}

include("./" . $path . ".php");
