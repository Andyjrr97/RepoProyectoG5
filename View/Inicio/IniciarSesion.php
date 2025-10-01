<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio Sesión</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../View/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../View/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../View/css/style.css">
    <link rel="shortcut icon" href="../../View/imagenes/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Inicio de sesión</h3>
                
                <!-- CORREGIDO: agregamos action y method -->
                <form action="principal.php" method="post">
                  <div class="form-group">
                    <label>Correo Electrónico *</label>
                    <input type="email" class="form-control p_input" name="correo" required>
                  </div>
                  <div class="form-group">
                    <label>Contraseña *</label>
                    <input type="password" class="form-control p_input" name="password" required>
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="recordar"> Recordar 
                      </label>
                    </div>
                    <a href="#" class="forgot-pass">¿Olvidaste tu contraseña?</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Ingresar</button>
                  </div>
                  <div class="d-flex mt-3">
                    <button type="button" class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook 
                    </button>
                    <button type="button" class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus 
                    </button>
                  </div>
                  <p class="sign-up mt-3">
                    ¿No tienes una cuenta? <a href="Registro.php">Crear una</a>
                  </p>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="../../View/js/vendor.bundle.base.js"></script>
    <script src="../../View/js/off-canvas.js"></script>
    <script src="../../View/js/hoverable-collapse.js"></script>
    <script src="../../View/js/misc.js"></script>
    <script src="../../View/js/settings.js"></script>
    <script src="../../View/js/todolist.js"></script>
  </body>
</html>
