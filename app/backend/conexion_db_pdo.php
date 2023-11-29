<?php
class Conexion extends PDO
{
	/*Datos de la base de datos*/
	private $tipo_de_base='mysql'; // Tipo de base de datos (en este caso, MySQL)
	private $host='localhost'; // Dirección del servidor de la base de datos
	private $nombre_de_base='test'; // Nombre de la base de datos
	private $usuario='root'; // Nombre de usuario para conectarse a la base de datos
	private $contrasena=''; // Contraseña para conectarse a la base de datos (vacía en este caso)

	public function __construct()
	{
		try
		{
			// se llama al constructor de la clase PDO para establecer la conexión a la base de datos
			parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base,$this->usuario,$this->contrasena);
		}
		catch(PDOException $e)
		{
			// Capturamos cualquier excepción (error) que pueda ocurrir durante la conexión
			echo "Ha surgido un error y no se puede conectar a la B.D. DETALLE: ".$e->getMessage();
		}
	}
}
?>