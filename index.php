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
  </head>
  <body class="bg-dark">
    <div class="d-flex align-items-center justify-content-center flex-column text-light atmosphere_font_primary" id="atmosphere_cont_presentacion">
        <b class="atmosphere_text_size_subtitle">Welcome to</b>
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
            <input class="form-control mb-2" placeholder="Ingresa tu Correo">
            <input class="form-control mb-3" placeholder="Ingresa tu Contraseña">
            <button class="atmosphere_btn_primary" style="width: auto;">Ingresar</button>
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
            <input class="form-control mb-2" placeholder="Ingresa tu Nombre">
            <input class="form-control mb-2" placeholder="Ingresa tu Correo">
            <input class="form-control mb-3" placeholder="Ingresa una Contraseña">
            <button class="atmosphere_btn_primary" style="width: auto;">Registrar</button>
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
    </script>

    <!--JS Boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--Ionic-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>