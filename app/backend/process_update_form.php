<?php
session_start();
//llama al archivo con las funciones
include('funciones_sql.php');

if (!empty($_POST['NowPassword']) AND !empty($_POST['NewPassword'])){ //si los datos no son nulos
    
    /*Parametros recibidos del formulario*/
    $Correo = $_SESSION['Cuenta_Activa']; //obtiene una variable de la sesion
    $NowPassword = hash('sha3-512', $_POST['NowPassword']); //encripta la contraseña actual
    $NewPassword = hash('sha3-512', $_POST['NewPassword']); //encripta la contraseña nueva

    $consultar = consultar($Correo);
    $PasswordReal = $consultar['password']; //trae la contraseña guardada en la BD
    
    if ($PasswordReal == $NowPassword) { /*Si las contraseñas (bd y form) son iguales*/ 
        if ($PasswordReal == $NewPassword){ //si las contraseñas ingresadas son iguales
            $response = 4;
        }else{
            $actualizar = actualizar($Correo, $NewPassword); //utiliza y envia parametros de la funcion actualizar
            if ($actualizar == 1) { //si se actualizo
                $response = 1;
            } else { //si no se actualizo
                $response = 0;
            }
        }
    } else { /*Si las contraseñas no son iguales*/
        $response = 3;
    }

} else { //si los datos son nulos
    $response = 2;
}

//imprime el caso
echo $response;
?>