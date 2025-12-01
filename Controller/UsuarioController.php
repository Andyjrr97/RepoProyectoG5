<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UsuarioModel.php';

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    function ConsultarUsuario()
    {
        $ced_usuario = $_SESSION["ced_usuario"];
        return ConsultarUsuarioModel($ced_usuario);
    }

    if(isset($_POST["btnActualizarPerfil"]))
    {
        $ced_usuario = $_SESSION["ced_usuario"];
        $nombre     = $_POST["Nombre"];
        $apellido1  = $_POST["Apellido1"];
        $apellido2  = $_POST["Apellido2"];
        $telefono   = $_POST["Telefono"];
        $correo     = $_POST["Correo"];

        $resultado = ActualizarPerfilModel($ced_usuario, $nombre, $apellido1, $apellido2, $telefono, $correo);

        if($resultado)
        {
            $_SESSION["nombre"]   = $nombre;
            $_SESSION["apellido1"] = $apellido1;
            $_SESSION["apellido2"] = $apellido2;
            $_SESSION["telefono"]  = $telefono;
            $_SESSION["correo"]    = $correo;

            $_POST["MensajePerfil"] = "La información se actualizó correctamente";
        }
        else
        {
            $_POST["MensajePerfil"] = "La información no se actualizó correctamente";
        }        
    }

    if(isset($_POST["btnActualizarSeguridad"]))
    {
        $ced_usuario       = $_SESSION["ced_usuario"];
        $contrasennaActual = $_POST["ContrasennaActual"] ?? "";
        $contrasennaNueva  = $_POST["ContrasennaNueva"] ?? "";
        $confirmar         = $_POST["ConfirmarContrasenna"] ?? "";

        if (empty($contrasennaActual) || empty($contrasennaNueva) || empty($confirmar)) {
            $_POST["MensajeSeguridad"] = "Debe completar todos los campos.";
        }
        elseif ($contrasennaNueva !== $confirmar) {
            $_POST["MensajeSeguridad"] = "La nueva contraseña y la confirmación no coinciden.";
        }
        else {
            $usuario = ConsultarUsuarioModel($ced_usuario);

            if (!$usuario) {
                $_POST["MensajeSeguridad"] = "No se encontró la información del usuario.";
            }
            elseif ($usuario["contrasena"] !== $contrasennaActual) {
                $_POST["MensajeSeguridad"] = "La contraseña actual no es correcta.";
            }
            else {
                $resultado = ActualizarSeguridadModel($ced_usuario, $contrasennaNueva);

                if($resultado)
                {
                    $_POST["MensajeSeguridad"] = "La contraseña se actualizó correctamente.";
                }
                else
                {
                    $_POST["MensajeSeguridad"] = "Ocurrió un error al actualizar la contraseña.";
                }
            }
        }
    }
