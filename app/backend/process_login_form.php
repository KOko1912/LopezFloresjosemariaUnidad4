<?php
session_start();
//llamamos al archivo con las funciones
include('funciones_sql.php');

if (!empty($_POST['Correo']) AND !empty($_POST['Password'])){ //si los datos no son nulos
    
    /*Parametros recibidos del formulario*/
    $Correo = $_POST['Correo'];
    $Password = hash('sha3-512', $_POST['Password']); //encriptamos la contraseña

    $consultar = consultar($Correo); //utilizamos la funcion de consulta
    
    if ($consultar) { /*Si el usuario Existe*/
        $PasswordReal = $consultar['password']; //trae la contraseña guardada en la BD
        if ($PasswordReal == $Password){ //si las contraseñas coinciden
            $response = 1;
            $_SESSION['Cuenta_Activa'] = $Correo; //crea la sesion
        }else{ //si las contraseñas no coinciden
            $response = 0;
        }
    } else { /*Si el usuario no Existe*/
        $response = 0;
    }

} else { //si los datos son nulos
    $response = 2;
}

//imprime el caso
echo $response;
?>