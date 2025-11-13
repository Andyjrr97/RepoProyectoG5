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
        $identificacion = $_POST["Identificacion"];
        $nombre = $_POST["Nombre"];
        $correoElectronico = $_POST["CorreoElectronico"];

        $resultado = ActualizarPerfilModel($ced_usuario, $identificacion,$nombre,$correoElectronico);

        if($resultado)
        {
            $_SESSION["Nombre"] = $nombre;
            $_POST["Mensaje"] = "La información se actualizó correctamente";
        }
        else
        {
            $_POST["Mensaje"] = "La información no se actualizó correctamente";
        }        
    }

    if(isset($_POST["btnActualizarSeguridad"]))
    {
        $ced_usuario = $_SESSION["ced_usuario"];
        $contrasenna = $_POST["Contrasenna"];

        $resultado = ActualizarSeguridadModel($ced_usuario, $contrasenna);

        if($resultado)
        {
            $_POST["Mensaje"] = "La información se actualizó correctamente";
        }
        else
        {
            $_POST["Mensaje"] = "La información no se actualizó correctamente";
        }        
    }   

?>