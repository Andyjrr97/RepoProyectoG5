<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php';

    function ConsultarUsuarioModel($ced_usuario)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ConsultarUsuario('$ced_usuario')";
            $resultado = $context->query($sentencia);

            $datos = null;
            if ($resultado) {
                while ($row = $resultado->fetch_assoc()) {
                    $datos = $row;
                }
                $resultado->free();
            }

            CloseConnection($context);
            return $datos;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return null;
        }
    }

    function ActualizarPerfilModel($ced_usuario, $nombre, $apellido1, $apellido2, $telefono, $correo)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarPerfil('$ced_usuario', '$nombre', '$apellido1', '$apellido2', '$telefono', '$correo')";
            $resultado = $context->query($sentencia);

            CloseConnection($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return false;
        }
    }

    function ActualizarSeguridadModel($ced_usuario, $contrasena)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarContrasenna('$ced_usuario', '$contrasena')";
            $resultado = $context->query($sentencia);

            CloseConnection($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return false;
        }
    }

?>
