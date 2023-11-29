<?php
session_start();
//codigo para verificar que no haya una sesion activa
if (!empty($_SESSION['Cuenta_Activa'])){
  //si la hay, se redirecciona al inicio
  echo "<script>window.location.href = 'inicio.php';</script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon - Icono-->
    <link rel="icon" href="img/atmosphere_icon.png" alt="favicon">
    <title>Atmosphere - The Infinity Barrier</title>
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
        <b class="atmosphere_text_size_subtitle">The Infinity Barrier</b>
        <h1><b class="atmosphere_text_color atmosphere_text_size_title">Atmosphere</b></h1>
        <div class="mt-4" id="atmosphere_cont_btn">
          <button class="atmosphere_btn_primary mb-2" onclick="openmodal('atmosphere_modal_login')"><b>Log In</b></button>
          <button class="atmosphere_btn_primary" onclick="openmodal('atmosphere_modal_signup')"><b>Sign Up</b></button>
        </div>
    </div>

    <!--Modal-->
    <div class="fixed-top" id="atmosphere_modal_login">
      <div id="atmosphere_form_login">
        <div id="form_login_column1">
          <div class="d-flex align-items-end">
            <ion-icon name="close" class="icono ms-3" onclick="closemodal('atmosphere_modal_login')"></ion-icon>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary">
            <h1 class="mb-3"><b class="atmosphere_text_color">Iniciar Sesión</b></h1>
            <input type="email" class="form-control mb-2" id="form_login_correo" placeholder="Ingresa tu Correo">
            <input type="password" class="form-control mb-3" id="form_login_password" placeholder="Ingresa tu Contraseña">
            <button class="atmosphere_btn_primary" style="width: auto;" id="form_login_btn_ingresar">Ingresar</button>
          </div>
        </div>
        <div id="form_login_column2">
          <!--Vacio-->
        </div>
      </div>
    </div>


    <!--Modal-->
    <div class="fixed-top" id="atmosphere_modal_signup">
      <div id="atmosphere_form_signup">
        <div id="form_signup_column1">
          <div class="d-flex align-items-end">
            <ion-icon name="close" class="icono ms-3" onclick="closemodal('atmosphere_modal_signup')"></ion-icon>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary">
            <h1 class="mb-3"><b class="atmosphere_text_color">Crear Cuenta</b></h1>
            <input type="text" class="form-control mb-2" id="form_signup_nombre" placeholder="Ingresa tu Nombre">
            <input type="email" class="form-control mb-2" id="form_signup_correo" placeholder="Ingresa tu Correo">
            <input type="password" class="form-control mb-3" id="form_signup_password" placeholder="Ingresa una Contraseña">
            <button class="atmosphere_btn_primary" style="width: auto;" id="form_signup_btn_registrar">Registrar</button>
          </div>
        </div>
        <div id="form_signup_column2">
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
        $('#form_login_btn_ingresar').click(function() {
          /*Credenciales de Acceso*/
          var Correo = $('#form_login_correo').val();
          var Password = $('#form_login_password').val();
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_login_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { Correo: Correo, Password: Password }, // Se envian los datos
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 2) {
                Swal.fire("Llene todos los campos"); //alerta
              } else if (response == 0) {
                Swal.fire("Correo o Contraseña Incorrectos"); //alerta
                //Se limpian los campos
                $('#form_login_correo').val("");
                $('#form_login_password').val("");
              } else if (response == 1){
                window.location.href = "inicio.php"; //alerta
                //Se limpian los campos
                $('#form_login_correo').val("");
                $('#form_login_password').val("");
              }
            }
          });
        });

        //Enviar los Datos Introducidos en el formulario de Registro
        $('#form_signup_btn_registrar').click(function() {
          //Datos del Formulario
          var Nombre = $('#form_signup_nombre').val();
          var Correo = $('#form_signup_correo').val();
          var Password = $('#form_signup_password').val();

          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: 'backend/process_signup_form.php', // Archivo PHP para procesar los datos en el servidor
            data: { Nombre: Nombre, Correo: Correo, Password: Password }, // Se envia el datos
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 2) {
                Swal.fire("Llene todos los campos"); //alerta
              } else if (response == 0) {
                Swal.fire('El usuario ya esta registrado'); //alerta
                //Se limpian los campos
                $('#form_signup_nombre').val("");
                $('#form_signup_correo').val("");
                $('#form_signup_password').val("");
              } else if (response == 1) {
                window.location.href = 'inicio.php'; //alerta
                //Se limpian los campos
                $('#form_signup_nombre').val("");
                $('#form_signup_correo').val("");
                $('#form_signup_password').val("");
              } else {
                Swal.fire('Error, Intente Nuevamente'); //alerta
                //Se limpian los campos
                $('#form_signup_nombre').val("");
                $('#form_signup_correo').val("");
                $('#form_signup_password').val("");
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