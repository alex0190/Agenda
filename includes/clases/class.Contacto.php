<?php
include_once("class.Database.php");

class Contacto
{
	public $id_contacto;
	public $nombre;
	public $apellido_paterno;
	public $apellido_materno;
	public $correo;
	public $foto;
	
	function __construct($id_contacto)
    {
        $contacto = Database::select("SELECT * FROM contacto WHERE id_contacto = $id_contacto");
        $contacto = $contacto[0];
        $this->id_contacto       = $contacto['id_contacto'];
        $this->nombre            = $contacto['nombre'];
		$this->apellido_paterno  = $contacto['apellido_paterno'];
		$this->apellido_materno  = $contacto['apellido_materno'];
		$this->correo            = $contacto['correo'];
		$this->foto              = $contacto['foto'];
    }
	
	function updateDatos($nombre, $apellido_paterno, $apellido_materno, $correo)
	{
		$query = "UPDATE contacto SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', 
		         apellido_materno = '$apellido_materno', correo = '$correo' WHERE id_contacto = $this->id_contacto";
		return Database::update($query);
	}
	
	function setDomicilio($calle, $numero, $colonia, $ciudad, $estado, $cp)
	{
		$query = "REPLACE domicilio SET id_contacto = $this->id_contacto, calle = '$calle', 
		         numero = '$numero', colonia = '$colonia', ciudad = '$ciudad', estado = '$estado', cp = $cp";
		return Database::insert($query);
	}
	
	function setTelefono($casa, $celular)
	{
		$query = "REPLACE telefono SET id_contacto = $this->id_contacto, casa = '$casa', celular = '$celular'";
		return Database::insert($query);
	}
	
	function setImagen($foto)
    {
	    $query = "UPDATE contacto SET foto = '$foto' WHERE id_contacto = $this->id_contacto";
	    return Database::update($query);
	}
	
	function getDomicilio()
    {
	    $query = "SELECT * FROM domicilio WHERE id_contacto = $this->id_contacto";
	    $res = Database::select($query);
		return $res[0];
	}
	
	function getTelefono()
    {
	    $query = "SELECT * FROM telefono WHERE id_contacto = $this->id_contacto";
	    $res = Database::select($query);
		return $res[0];
	}
	
	// Funciones estaticas
	
	public static function obtenerContactos()
    {
	    $query = "SELECT * FROM contacto INNER JOIN telefono ON contacto.id_contacto = telefono.id_contacto";
	    return Database::select($query);
	}
	
	public static function eliminarContacto($id_contacto)
    {
	    $query = "DELETE FROM contacto WHERE id_contacto = $id_contacto";
	    return Database::update($query);
	}
	
	public static function insert($nombre, $apellido_paterno, $apellido_materno, $correo)
	{
		$query = "INSERT INTO contacto(nombre, apellido_paterno, apellido_materno, correo)
		         VALUES('$nombre', '$apellido_paterno', '$apellido_materno', '$correo');";
	    return Database::insert($query);
	}
}
?>