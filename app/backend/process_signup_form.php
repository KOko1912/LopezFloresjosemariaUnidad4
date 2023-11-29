<?php
session_start();
//llama al archivo con las funciones
include('funciones_sql.php');

if (!empty($_POST['Nombre']) AND !empty($_POST['Correo']) AND !empty($_POST['Password'])){ //si los datos no son nulos
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Password = hash('sha3-512', $_POST['Password']); //encripta la contraseña

    $consultar = consultar($Correo); //utiliza la funcion de consulta
    
    if ($consultar){ //si el correo esta registrado
        $response = 0;
    } else { //si el correo no esta registrado
        $registrar = registrar($Nombre, $Correo, $Password); //utiliza y envia los parametros de la funcion
        if ($registrar === true){ //si se hace el registro
            $_SESSION['Cuenta_Activa'] = $Correo; //crea la sesion
            $response = 1;
        } else { //si no se hace el registro
            $response = 3;
        }
    }
} else { //si los datos son nulos
    $response = 2;
}

//imprime el caso
echo $response;
?>