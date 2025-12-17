<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/InicioController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["ced_usuario"])) {
    header("Location: ../../View/Inicio/IniciarSesion.php?e=sesion");
    exit;
}

function ShowCSS()
{
?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Élite Electrónica</title>
        <link rel="stylesheet" href="../../View/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../View/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../../View/css/style.css">
        <link rel="shortcut icon" href="../../View/imagenes/faviconi.png" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <style>
            @font-face {
                font-family: 'Rubik';
                src: url('../fonts/Rubik-Light.ttf') format('truetype');
                font-weight: 300;
            }

            @font-face {
                font-family: 'Rubik';
                src: url('../fonts/Rubik-Bold.ttf') format('truetype');
                font-weight: 700;
            }

            .main-panel .content-wrapper {
                background: url("../imagenes/tecnologia_gamer.png") center/cover no-repeat;
                min-height: calc(100vh - 70px);
            }

            .sidebar {
                background-color: #02003d;
            }

            .sidebar .sidebar-brand-wrapper {
                background-color: #02003d !important;
            }

            .navbar,
            .navbar-brand-wrapper {
                background-color: #02003d !important;
            }

            .footer {
                background-color: #02003d;
                /* mismo azul del layout */
                color: #ffffff;
                border-top: 1px solid #060a2e;
                padding: 8px 1.5rem;
            }

            .sidebar .sidebar-brand-wrapper .sidebar-brand img {
                width: 210px;
                height: auto;
                max-height: none;
            }

            .sidebar .sidebar-brand-wrapper .brand-logo-mini img {
                width: 40px !important;
                height: auto !important;
            }

            /* Botón cambiar contraseña */
            .btn-change-pass {
                background: linear-gradient(90deg, #4400ffff, #5b53ccff);
                color: white;
                padding: 12px 35px;
                font-size: 18px;
                font-weight: bold;
                border-radius: 8px;
                border: none;
                transition: 0.3s;
                box-shadow: 0 4px 12px rgba(0, 4, 255, 0.3);
            }

            .btn-change-pass:hover {
                background: linear-gradient(90deg, #ff0000ff, #f04a4aff);
                box-shadow: 0 6px 18px rgba(255, 0, 0, 1);
                transform: translateY(-2px);
            }

            .btn-change-pass:active {
                transform: scale(0.97);
            }

            /* Estilo para input deshabilitado (cédula usuario, etc.) */
            input.form-control[disabled] {
                background-color: #5e5e5eff !important;
                color: #2e1fffff !important;
                border: 1px solid #0004ffff !important;
                opacity: 1 !important;
            }
        </style>
    </head>
<?php
}


function ShowJS()
{
    echo '
    <script src="../../View/js/vendor.bundle.base.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="../../View/js/off-canvas.js"></script>
    <script src="../../View/js/hoverable-collapse.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="../../View/js/misc.js"></script>
    <script src="../../View/js/settings.js"></script>
    <script src="../../View/js/todolist.js"></script>';
}

function ShowMenu()
{
    $rol = isset($_SESSION["rol"]) ? $_SESSION["rol"] : "Invitado";

    $avatar = "../imagenes/Cliente.png";

    if ($rol === "Administrador") {
        $avatar = "../imagenes/admin.png";
    }

    $nombre     = isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : "";
    $apellido1  = isset($_SESSION["apellido1"]) ? $_SESSION["apellido1"] : "";
    $nombreCompleto = trim($nombre . " " . $apellido1);

    $rol = isset($_SESSION["rol"]) ? $_SESSION["rol"] : "Invitado";

    echo '
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <!-- Logo normal (sidebar completo) -->
            <a class="sidebar-brand brand-logo" href="/RepoProyectoG5/View/Inicio/Principal.php">
                <img src="../imagenes/logo_elite.png" alt="logo" />
            </a>

            <!-- Logo mini (cuando el sidebar está colapsado) -->
            <a class="sidebar-brand brand-logo-mini" href="/RepoProyectoG5/View/Inicio/Principal.php">
                <img src="../imagenes/logo_mini_elite.png" alt="logo mini" />
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div>
                            <img class="img-xs rounded-circle" src="' . $avatar . '" alt="avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h4 class="mb-0 font-weight-normal">' . $nombreCompleto . '</h4>
                            <span>' . $rol . '</span>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>

            ' . ($rol === "Cliente" ? '
            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Computadoras.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">Computadoras</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Telefonos.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-cellphone"></i>
                    </span>
                    <span class="menu-title">Telefonos</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Componentes.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-memory"></i>
                    </span>
                    <span class="menu-title">Componentes</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Accesorios.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-headphones"></i>
                    </span>
                    <span class="menu-title">Accesorios</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Monitores.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-monitor"></i>
                    </span>
                    <span class="menu-title">Monitores</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Carrito/Carrito.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-cart"></i>
                    </span>
                    <span class="menu-title">Carrito</span>
                </a>
            </li>
            ' : '') . '

            ' . ($rol === "Administrador" ? '
            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/AgregarProducto.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-plus-box"></i>
                    </span>
                    <span class="menu-title">Agregar producto</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/Productos/Vendidos.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-trending-up"></i>
                    </span>
                    <span class="menu-title">Lo mas Vendido</span>
                </a>
            </li>
            ' : '') . '

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/info/Contactenos.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-phone"></i>
                    </span>
                    <span class="menu-title">Contactenos</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/RepoProyectoG5/View/info/SobreNosotros.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-information"></i>
                    </span>
                    <span class="menu-title">Sobre Nosotros</span>
                </a>
            </li>

        </ul>
    </nav>';
}

function ShowNav()
{
    $rol = isset($_SESSION["rol"]) ? $_SESSION["rol"] : "Invitado";

    $avatar = "../imagenes/Cliente.png";

    if ($rol === "Administrador") {
        $avatar = "../imagenes/admin.png";
    }

    $nombre     = isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : "";
    $apellido1  = isset($_SESSION["apellido1"]) ? $_SESSION["apellido1"] : "";
    $nombreCompleto = trim($nombre . " " . $apellido1);

    echo '
    <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="/RepoProyectoG5/View/Inicio/Principal.php">
                <img src="../imagenes/logo_mini_elite.png" alt="logo" />
            </a>
        </div>

        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                        <div class="navbar-profile">
                            <img class="img-xs rounded-circle" src="' . $avatar . '" alt="avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                            <p class="mb-0 d-none d-sm-block navbar-profile-name">' . $nombreCompleto . '</p>
                            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                        <h6 class="p-3 mb-0">Perfil</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="../../View/Configuracion/Usuarios.php">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Configuracion</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="../../Controller/LogoutMainPage.php">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Salir</p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-format-line-spacing"></span>
            </button>
        </div>
    </nav>';
}

function ShowFooter()
{
    echo '
    <footer class="footer text-center">
        <span class="text-muted d-block">© 2025 Élite Electrónica. Todos los derechos reservados.</span>
    </footer>';
}
?>
