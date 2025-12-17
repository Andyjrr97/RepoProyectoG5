<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutExterno.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/InicioController.php';
?>

<!DOCTYPE html>
<html lang="en">

  <?php
      ShowCSS()
  ?>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-5 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Registro</h3>

                <form action="principal.php" method="post">

                  <div class="form-group">
                    <label>Cedula *</label>
                    <input type="text" class="form-control p_input" id="ced_usuario" name="ced_usuario" required>
                  </div>

                  <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" class="form-control p_input" id="nombre" name="nombre" required>
                  </div>

                  <div class="form-group">
                    <label>1er Apellido *</label>
                    <input type="text" class="form-control p_input" id="apellido1" name="apellido1" required>
                  </div>

                  <div class="form-group">
                    <label>2do Apellido *</label>
                    <input type="text" class="form-control p_input" id="apellido2" name="apellido2" required>
                  </div>

                  <div class="form-group">
                    <label>Telefono *</label>
                    <input type="text" class="form-control p_input" id="telefono" name="telefono" required>
                  </div>

                  <div class="form-group">
                    <label>Correo Electrónico *</label>
                    <input type="email" class="form-control p_input" id="correo" name="correo" required>
                  </div>

                  <div class="form-group">
                    <label>Contraseña *</label>
                    <input type="password" class="form-control p_input" id="contrasena" name="contrasena" required>
                  </div>

                  <div class="text-center">
                    <button type="submit" id="btnCrearCuenta" name="btnCrearCuenta" class="btn btn-primary btn-block enter-btn">Crear Cuenta</button>
                  </div>

                  <p class="sign-up mt-3" style="margin-top: -20px;">¿Ya tienes una cuenta? <a href="IniciarSesion.php">Iniciar Sesión</a></p>

                </form>
              </div>
            </div>
          </div>

    <?php
      ShowJS()
    ?>
    <script src="../js/Registro.js"></script>

  </body>
</html>
