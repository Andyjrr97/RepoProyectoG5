<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php';

    function CrearCuentaModel($ced_usuario, $nombre, $apellido1, $apellido2, $telefono, $correo, $contrasena)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL CrearCuenta('$ced_usuario', '$nombre', '$apellido1', '$apellido2', '$telefono', '$correo', '$contrasena')";
            $resultado = $context -> query($sentencia);

            CloseConnection($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return false;
        }
    }

    function ValidarCuentaModel($correo, $contrasena)
{
    try {
        $context = OpenConnection();

        $sentencia = "CALL ValidarCuenta('$correo', '$contrasena')";
            $resultado = $context -> query($sentencia);

            $datos = null;
            while ($row = $resultado->fetch_assoc()) {
                $datos = $row;
            }

            $resultado->free();
            CloseConnection($context);

            return $datos;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return null;
    }
} 


    function ValidarCorreoModel($correo)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ValidarCorreo('$correo')";
            $resultado = $context -> query($sentencia);

            $datos = null;
            while ($row = $resultado->fetch_assoc()) {
                $datos = $row;
            }

            $resultado->free();
            CloseConnection($context);

            return $datos;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return null;
        }
    }

    function ActualizarContrasennaModel($ced_usuario, $contrasena_generada)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarContrasenna('$ced_usuario', '$contrasena_generada')";
            $resultado = $context -> query($sentencia);

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
