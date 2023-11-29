<?php
session_start();

if (empty($_SESSION['Cuenta_Activa'])) {
    echo "<script>window.location.href = 'index.php';</script>";
}

if (isset($_POST['logout'])){
    session_destroy();
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
    <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary" id="atmosphere_cont_presentacion">
        <b class="atmosphere_text_size_subtitle">Welcome to</b>
        <h1><b class="atmosphere_text_color atmosphere_text_size_title">Atmosphere</b></h1>
        <div class="mt-4" id="atmosphere_cont_btn">
          <button class="atmosphere_btn_primary mb-2" onclick="openmodal('atmosphere_modal_update')"><b>Change Password</b></button>
          <button class="atmosphere_btn_primary mb-2" onclick="openmodal('atmosphere_modal_delete')"><b>Delete Account</b></button>
          <form method="post" action="">
            <button class="atmosphere_btn_primary" name="logout"><b>Log Out</b></button>
          </form>
        </div>
    </div>

    <!--Modal Formulario Login-->
    <div class="fixed-top" id="atmosphere_modal_update">
      <div id="atmosphere_form_update">
        <div id="form_update_column1">
          <div class="d-flex align-items-end">
            <ion-icon name="close" class="icono ms-3" onclick="closemodal('atmosphere_modal_update')"></ion-icon>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary">
            <h1 class="mb-3"><b class="atmosphere_text_color">Cambiar Contraseña</b></h1>
            <input type="email" class="form-control mb-2" id="form_update_apassword" placeholder="Ingresa tu Contraseña Actual">
            <input type="password" class="form-control mb-3" id="form_update_npassword" placeholder="Ingresa tu Nueva Contraseña">
            <button type="btn" class="atmosphere_btn_primary" style="width: auto;" id="form_update_btn_actualizar">Actualizar</button>
          </div>
        </div>
        <div id="form_update_column2">
          <!--Vacio-->
        </div>
      </div>
    </div>


    <!--Modal Formulario Registro-->
    <div class="fixed-top" id="atmosphere_modal_delete">
      <div id="atmosphere_form_signup">
        <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary" id="form_delete_column1" align="center">
          <h1 class="mb-3"><b class="atmosphere_text_color">Eliminar Cuenta</b></h1>
          <b class="mb-4">¿Estas seguro de querer eliminar la cuenta?, esta accion no se puede revertir.</b>
          <button class="atmosphere_btn_primary mb-2" id="form_delete_btn_eliminar">Si, Eliminar</button>
          <button class="atmosphere_btn_primary" onclick="closemodal('atmosphere_modal_delete')">No, Cancelar</button>
        </div>
        <div id="form_delete_column2">
          <!--Vacio-->
        </div>
      </div>
    </div>

    <script>
      function openmodal(modal){
        const cont_modal = document.getElementById(modal);

        cont_modal.style.display= "flex";
      }

      function closemodal(modal){
        const cont_modal = document.getElementById(modal);

        cont_modal.style.display= "none";
      }

      $(document).ready(function() {
        //Enviar los Datos Introducidos en el formulario de Login
        $('#form_update_btn_actualizar').click(function() {
          /*Credenciales de Acceso*/
          var Now_Password = $('#form_update_apassword').val();
          var New_Password = $('#form_update_npassword').val();
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_update_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { NowPassword: Now_Password, NewPassword: New_Password }, // Se envian los dato
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 2) {
                Swal.fire("Llene todos los campos");
              } else if (response == 3) {
                Swal.fire("La contraseña actual es incorrecta");
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else if (response == 4) {
                Swal.fire("La nueva contraseña no debe ser igual a la actual");
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else if (response == 1){
                Swal.fire("Contraseña Actualizada");
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              } else {
                Swal.fire("Error, Intente Nuevamente");
                $('#form_update_apassword').val("");
                $('#form_update_npassword').val("");
              }
            }
          });
        });

        //Enviar los Datos Introducidos en el formulario de Registro
        $('#form_delete_btn_eliminar').click(function() {
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_delete_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { Peticion: "Delete" }, // Se envia el dato
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 4) {
                Swal.fire("No se proceso la solicitud");
              } else if (response == 1) {
                window.location.href = "index.php";
              } else {
                Swal.fire('Error, Intente Nuevamente');
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