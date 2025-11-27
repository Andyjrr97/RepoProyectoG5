<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php';

    function ConsultarUsuarioModel($cedula)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ConsultarUsuario('$cedula')";
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

    function ActualizarPerfilModel($cedula, $nombre, $apellido1, $apellido2, $telefono, $correo)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarPerfil('$cedula', '$nombre', '$apellido1', '$apellido2', '$telefono', '$correo')";
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

    function ActualizarSeguridadModel($cedula, $contrasena)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarContrasenna('$cedula', '$contrasena')";
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
