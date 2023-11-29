<?php
session_start();
//Codigo para verificar que haya una sesion activa
if (empty($_SESSION['Cuenta_Activa'])) {
    //Si no la hay, redireccion al index
    echo "<script>window.location.href = 'index.php';</script>";
}

//si se da clic al boton de logout
if (isset($_POST['logout'])){
    session_destroy(); //se destruye la sesion activa
    //se redirecciona al index
    echo "<script>window.location.href = 'index.php';</script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon - Icono-->
    <link rel="icon" href="img/atmosphere_icon.png" alt="favicon">
    <title>Atmosphere - Inicio</title>
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- JQuery Validate library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  <body class="bg-dark">
    <!--Seccion pricipal con las opciones de "Change Password"|"Delete Account"|"Log Out"-->
    <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary" id="atmosphere_cont_presentacion">
        <b class="atmosphere_text_size_subtitle">Welcome to</b>
        <h1><b class="atmosphere_text_color atmosphere_text_size_title">Atmosphere</b></h1>
        <div class="mt-4" id="atmosphere_cont_btn">
          <button class="atmosphere_btn_primary mb-2" onclick="openmodal('atmosphere_modal_update')"><b>Change Password</b></button> <!--Boton para abrir modal para cambiar contraseña-->
          <button class="atmosphere_btn_primary mb-2" onclick="openmodal('atmosphere_modal_delete')"><b>Delete Account</b></button> <!--Boton para abrir modal para eliminar cuenta-->
          <form method="post" action="">
            <button class="atmosphere_btn_primary" name="logout"><b>Log Out</b></button> <!--Boton para abrir modal para cerrar sesion-->
          </form>
        </div>
    </div>

    <!--Modal para cambiar contraseña-->
    <div class="fixed-top" id="atmosphere_modal_update">
      <div id="atmosphere_form_update">
        <!--Columna 1-->
        <div id="form_update_column1">
          <div class="d-flex align-items-end">
            <ion-icon name="close" class="icono ms-3" onclick="closemodal('atmosphere_modal_update')"></ion-icon> <!--Icono para cerrar el modal-->
          </div>
          <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary">
            <h1 class="mb-3"><b class="atmosphere_text_color">Cambiar Contraseña</b></h1> <!--Titulo del Formulario-->
            <input type="password" class="form-control mb-2" id="form_update_apassword" placeholder="Ingresa tu Contraseña Actual"> <!--Input para ingresar contraseña actual-->
            <input type="password" class="form-control mb-3" id="form_update_npassword" placeholder="Ingresa tu Nueva Contraseña"> <!--Input para ingresar contraseña nueva-->
            <button type="btn" class="atmosphere_btn_primary" style="width: auto;" id="form_update_btn_actualizar">Actualizar</button> <!--boton para procesar solicitud de Update-->
          </div>
        </div>
        <!--Columna 2-->
        <div id="form_update_column2">
          <!--Vacio-->
        </div>
      </div>
    </div>


    <!--Modal Formulario Registro-->
    <div class="fixed-top" id="atmosphere_modal_delete">
      <div id="atmosphere_form_signup">
        <!--Columna 1-->
        <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary" id="form_delete_column1" align="center">
          <h1 class="mb-3"><b class="atmosphere_text_color">Eliminar Cuenta</b></h1> <!--Titulo del Formulario-->
          <b class="mb-4">¿Estas seguro de querer eliminar la cuenta?, esta accion no se puede revertir.</b> <!--Texto de Advertencia-->
          <button class="atmosphere_btn_primary mb-2" id="form_delete_btn_eliminar">Si, Eliminar</button> <!--Boton para procesar Delete-->
          <button class="atmosphere_btn_primary" onclick="closemodal('atmosphere_modal_delete')">No, Cancelar</button> <!--Boton para cancerlar/cerrar modal-->
        </div>
        <!--Columna 2-->
        <div id="form_delete_column2">
          <!--Vacio-->
        </div>
      </div>
    </div>

    <script>
      /* Funcion para abrir un modal */
      function openmodal(modal){
        const cont_modal = document.getElementById(modal); //id del modal que se quiere abrir

        cont_modal.style.display= "flex"; //atributo css para aparecer modal
      }

      /* Funcion para cerrar un modal */
      function closemodal(modal){
        const cont_modal = document.getElementById(modal); //id del modal que se quiere cerrar

        cont_modal.style.display= "none"; //atributo css para desaparecer modal
      }

      $(document).ready(function() {
        //Si se da clic para procesar Update
        $('#form_update_btn_actualizar').click(function() {
          /*Datos introducidos*/
          var Now_Password = $('#form_update_apassword').val();
          var New_Password = $('#form_update_npassword').val();
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_update_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { NowPassword: Now_Password, NewPassword: New_Password }, // Se envian los datos
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 2) {
                Swal.fire("Llene todos los campos"); //alerta
              } else if (response == 3) {
                Swal.fire("La contraseña actual es incorrecta"); //alerta
                //Se limpian los campos
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else if (response == 4) {
                Swal.fire("La nueva contraseña no debe ser igual a la actual"); //alerta
                //Se limpian los campos
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else if (response == 1){
                Swal.fire("Contraseña Actualizada"); //alerta
                //Se limpian los campos
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else {
                Swal.fire("Error, Intente Nuevamente"); //alerta
                //Se limpian los campos
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              }
            }
          });
        });

        //Si se da clic en el boton para procesar Delete
        $('#form_delete_btn_eliminar').click(function() {
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_delete_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { Peticion: "Delete" }, // Se envia el dato
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 4) {
                Swal.fire("No se proceso la solicitud"); //alerta
              } else if (response == 1) {
                window.location.href = "index.php"; //redireccion al index
              } else {
                Swal.fire('Error, Intente Nuevamente'); //alerta
              }
            }
          });
        });
      });
    </script>

    <!--JS Boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--Ionic-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>