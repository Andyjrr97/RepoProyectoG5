<?php

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    function ShowCSS()
    {
      echo '
        <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
          <title>Proyecto Web MN</title>
          <meta name="description" content="" />

          <link rel="stylesheet" href="../css/boxicons.css" />
          <link rel="stylesheet" href="../css/core.css" class="template-customizer-core-css" />
          <link rel="stylesheet" href="../css/theme-default.css" class="template-customizer-theme-css" />
          <link rel="stylesheet" href="../css/demo.css" />
          <link rel="stylesheet" href="../css/perfect-scrollbar.css" />
          <script src="../js/helpers.js"></script>
          <script src="../js/config.js"></script>
        </head>';
    }

    function ShowJS()
    {
      echo '
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="../js/popper.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/perfect-scrollbar.js"></script>
        <script src="../js/menu.js"></script>
        <script src="../js/main.js"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>';
    }

    function ShowMenu()
    {
        echo '
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <img src="../img/logo.png">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">MN Web</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Mantenimientos</span></li>

            <li class="menu-item">
              <a href="../Productos/Productos.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Analytics">Productos</div>
              </a>
            </li>

          </ul>
        </aside>';
    }

    function ShowNav()
    {
        $nombre = "";
        $nombrePerfil = "";

        if(isset($_SESSION["Nombre"]))
        {
          $nombre = $_SESSION["Nombre"];
          $nombrePerfil = $_SESSION["NombrePerfil"];
        }

        echo '
         <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">' . $nombre . '
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block text-center">Perfil ' . $nombrePerfil . '</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../Usuarios/Perfil.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Perfil</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../Usuarios/Seguridad.php">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Seguridad</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Cerrar Sesión</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>';
    }

    function ShowFooter()
    {
        echo '
        <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  ThemeSelection
                </div>               
              </div>
            </footer>';
    }

?>