<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/UsuarioController.php';

  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  if (!isset($_SESSION["ced_usuario"])) {
      header("Location: ../../View/Inicio/IniciarSesion.php?e=sesion");
      exit;
  }

  $usuario = ConsultarUsuario();
?>

<!DOCTYPE html>
<html lang="es">

<?php ShowCSS(); ?>

<body>
  <div class="container-scroller">
    
    <?php ShowMenu(); ?>

    <div class="container-fluid page-body-wrapper">

      <?php ShowNav(); ?>

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Información del usuario</h4>

                  <?php 
                    if(isset($_POST["MensajePerfil"])) {
                        echo '<div class="alert alert-primary centrado">' . $_POST["MensajePerfil"] . '</div>';
                    }
                  ?>

                  <?php if ($usuario) : ?>
                    <form action="" method="POST">
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Cédula</label>
                            <input type="text" class="form-control" 
                                   value="<?php echo htmlspecialchars($usuario['ced_usuario']); ?>" disabled>
                          </div>

                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control"
                                   name="Nombre"
                                   value="<?php echo htmlspecialchars($usuario['nombre']); ?>">
                          </div>

                          <div class="form-group">
                            <label>Primer apellido</label>
                            <input type="text" class="form-control"
                                   name="Apellido1"
                                   value="<?php echo htmlspecialchars($usuario['apellido1']); ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Segundo apellido</label>
                            <input type="text" class="form-control"
                                   name="Apellido2"
                                   value="<?php echo htmlspecialchars($usuario['apellido2']); ?>">
                          </div>

                          <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" class="form-control"
                                   name="Telefono"
                                   value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
                          </div>

                          <div class="form-group">
                            <label>Correo</label>
                            <input type="email" class="form-control"
                                   name="Correo"
                                   value="<?php echo htmlspecialchars($usuario['correo']); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="d-flex justify-content-center mt-3 gap-2">

                        <button type="submit"
                                name="btnActualizarPerfil"
                                class="btn btn-primary enter-btn mr-2">
                          Actualizar perfil
                        </button>

                      </div>

                    </form>
                    

                  <?php else : ?>
                    <div class="alert alert-danger">No se pudo cargar la información del usuario.</div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <button type="button"
                        class="btn btn-change-pass"
                        data-toggle="modal"
                        data-target="#modalSeguridad">
                    🔒 Cambiar contraseña 🔒
                </button>
            </div>

          <div class="modal fade" id="modalSeguridad" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Cambiar contraseña</h5>
                  <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                  </button>
                </div>

                <form action="" method="POST">
                  <div class="modal-body">

                    <?php 
                      if(isset($_POST["MensajeSeguridad"])) {
                          echo '<div class="alert alert-primary centrado">' . $_POST["MensajeSeguridad"] . '</div>';
                      }
                    ?>

                    <div class="form-group">
                      <label>Contraseña actual</label>
                      <input type="password" class="form-control" 
                             name="ContrasennaActual" required>
                    </div>

                    <div class="form-group">
                      <label>Nueva contraseña</label>
                      <input type="password" class="form-control" 
                             name="ContrasennaNueva" required>
                    </div>

                    <div class="form-group">
                      <label>Confirmar nueva contraseña</label>
                      <input type="password" class="form-control" 
                             name="ConfirmarContrasenna" required>
                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                    <button class="btn btn-primary"
                            name="btnActualizarSeguridad"
                            type="submit">
                      Guardar cambios
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>

        <?php ShowFooter(); ?>

      </div>
    </div>
  </div>

<?php
      ShowJS();
    ?>
    <script src="../js/Seguridad.js"></script>

<?php if (isset($_POST["btnActualizarSeguridad"])): ?>
<script>

  $(document).ready(function () {
      $('#modalSeguridad').modal('show');
  });
</script>
<?php endif; ?>

</body>
</html>
