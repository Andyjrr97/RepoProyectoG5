<?php

function OpenConnection()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $SERVER = "127.0.0.1";
    $USUARIO = "root";
    $CONTRASENA = "";
    $BASE_DATOS = "tienda";
    $PUERTO = 3306; //cambiar el puerto al que usa XAMPP

    return mysqli_connect($SERVER, $USUARIO, $CONTRASENA, $BASE_DATOS, $PUERTO);
}

function CloseConnection($context)
{
    mysqli_close($context);
}


function SaveError($error)
{
    $context = OpenConnection();

    $mensaje = mysqli_real_escape_string($context, $error->getMessage());

    $sentencia = "CALL RegistrarError('$mensaje')";
    $context->query($sentencia);

    CloseConnection($context);
}

?>

