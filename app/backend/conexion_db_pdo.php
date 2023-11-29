<?php
class Conexion extends PDO
{
	private $tipo_de_base='mysql';
	private $host='mysql';
	private $nombre_de_base='test';
	private $usuario='root';
	private $contrasena='1234';

	public function __construct()
	{
		try
		{
			parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base,$this->usuario,$this->contrasena);
		}
		catch(PDOException $e)
		{
			echo "Ha surgido un error y no se puede conectar a la B.D. DETALLE: ".$e->getMessage();
		}
	}
}
?>