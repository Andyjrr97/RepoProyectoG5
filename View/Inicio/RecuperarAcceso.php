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
                <h3 class="card-title text-left mb-4">Recuperar Acceso</h3>
              
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

                  <div class="text-center">
                    <button type="submit" id="btnRecuperarAcceso" name="btnRecuperarAcceso" class="btn btn-primary btn-block enter-btn">Procesar</button>
                  </div>

                  <p class="sign-up mt-3" style="margin-top: -20px;"><a href="IniciarSesion.php">Regresar a Iniciar Sesión</a></p>

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

