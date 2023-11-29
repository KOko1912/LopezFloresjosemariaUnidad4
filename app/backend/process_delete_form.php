<?php
session_start();
//llama al archivo con funciones
include('funciones_sql.php');

if ($_POST['Peticion'] == 'Delete'){ //si se procesa la peticion
    $Correo = $_SESSION['Cuenta_Activa']; //obtiene una variable de la sesion
    $eliminar = eliminar($Correo); //utiliza y envia parametro de la funcion eliminar

    if ($eliminar === true){ //si se elimina un registro
        $response = 1;
        session_destroy(); //destruye la sesion
    } else if ($eliminar === false){ //si no se elimina el registro
        $response = 2;
    } else { //algun otro suceso
        $response = 3;
    }
} else { //si no se procesa la peticion
    $response = 4;
}

//imprime el caso
echo $response;
?>