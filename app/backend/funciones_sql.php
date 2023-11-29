<?php
//llamamos a la conexion a la bd
include('conexion_db_pdo.php');

/*Funcion para consultar un registro de la base de datos*/
function consultar($correo){
    $conexion = new Conexion();
    // Consulta SQL para consultar un registro
	$consulta = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    //parametro
	$consulta->bindParam(':correo',$correo);
    //ejecucion de sentencia
	$consulta->execute();
    //cuenta si hay registro buscado
	$contar = $consulta->rowCount();

	if ($contar==1) { //si encuentra un registro
		return $consulta->fetch(PDO::FETCH_ASSOC);
	} else { //si no encuentra
		return false;
	}
}

/*Funcion para registrar un registro de la base de datos*/
function registrar($nombre, $correo, $password){
    try {
        $conexion = new Conexion();
        // Consulta SQL para crear un registro
        $registro = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (:nombre, :correo, :password)");
        //parametros
        $registro->bindParam(':nombre', $nombre);
        $registro->bindParam(':correo', $correo);
        $registro->bindParam(':password', $password);
        //ejecucion de la sentencia
        $registro->execute();

        // Devuelve true si el registro fue exitoso
        return true;
    } catch (PDOException $e) {
        // Devuelve el mensaje de error si hay un problema
        return "Error en el registro: " . $e->getMessage();
    }
}
?>