<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutExterno.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/InicioController.php';
?>

<!DOCTYPE html>
<html lang="en">

  <?php
      ShowCSS();
  ?>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-5 mx-auto">
              <div class="card-body px-6 py-6">
                <h3 class="card-title text-left mb-4">Inicio de sesión</h3>
              
                <?php
                if (isset($_POST["Mensaje"])) {
                    echo '<div class="alert alert-primary centrado">' . $_POST["Mensaje"] . '</div>';
                }
                ?>

                <form id="formInicioSesion" action="" method="post">

                  <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico *</label>
                    <input type="text" class="form-control" id="correo" name="correo" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="form-label" for="password">Contraseña *</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                  </div>

                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                    </div>
                    <a href="RecuperarAcceso.php" class="forgot-pass">¿Olvidaste tu contraseña?</a>
                  </div>

                  <div class="text-center">
                    <button type="submit" id="btnIniciarSesion" name="btnIniciarSesion" class="btn btn-primary btn-block enter-btn">Ingresar</button>
                  </div>

                  <p class="sign-up mt-3" style="margin-top: -20px;">¿No tienes una cuenta? <a href="Registro.php">Registrarse</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      ShowJS();
    ?>
    <script src="../js/InicioSesion.js"></script>

  </body>
</html>

