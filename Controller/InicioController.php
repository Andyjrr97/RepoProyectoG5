<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/UtilesController.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/InicioModel.php';


    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    if(isset($_POST["btnCrearCuenta"]))
    {
        $ced_usuario = $_POST["ced_usuario"];
        $nombre = $_POST["nombre"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        $resultado = CrearCuentaModel($ced_usuario, $nombre, $apellido1, $apellido2, $telefono, $correo, $contrasena);

        if($resultado)
        {
            header("Location: ../../View/Inicio/IniciarSesion.php");
            exit;
        }

        $_POST["Mensaje"] = "No se ha podido crear la cuenta solicitada";
    }


    if (isset($_POST["btnIniciarSesion"])) 
    {
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        $resultado = ValidarCuentaModel($correo, $contrasena);

    if ($resultado) 
    {
        $_SESSION["ced_usuario"] = $resultado["ced_usuario"];
        $_SESSION["correo"] = $resultado["correo"];
        $_SESSION["nombre"] = $resultado["nombre"];
        $_SESSION["apellido1"] = $resultado["apellido1"];
        $_SESSION["rol"] = $resultado["rol"];

        header("Location: ../../View/Inicio/Principal.php");
        exit;
    }
        $_POST["Mensaje"] = "No se ha podido validar la cuenta ingresada";
    }

    if(isset($_POST["btnRecuperarAcceso"]))
    {
        $correo = $_POST["correo"];
 
        $resultado = ValidarCorreoModel($correo);

        if ($resultado)
        {
            //Generar contraseña aleatoria
            $ContrasennaGenerada = GenerarContrasenna();

            //Actualizar la contraseña actual
            $resultadoActualizar = ActualizarContrasennaModel($resultado["ced_usuario"], $ContrasennaGenerada);
            
            if($resultadoActualizar)
            {
                //Notificarle por correo la nueva contraseña
                $mensaje = "<html><body>
                Estimado(a) " . $resultado["nombre"] . "<br><br>
                Se ha generado la siguiente contraseña de acceso: <b>" . $ContrasennaGenerada . "</b><br>
                Procure realizar el cambio de su contraseña una vez que ingrese al sistema.<br><br>
                Muchas gracias.
                </body></html>";

                EnviarCorreo('Recuperar Acceso', $mensaje, $resultado["correo"]);

                header("Location: ../../View/Inicio/IniciarSesion.php");
                exit;
            }
        }

        $_POST["Mensaje"] = "No se ha podido recuperar el acceso";
    }

?>