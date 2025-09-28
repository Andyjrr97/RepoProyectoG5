<?php

    if(isset($_POST["btnIniciarSesion"]))
    {
        //Enviamos el correo y la contraseña a validar

        header("Location: ../../View/Inicio/Principal.php");
        exit;
    }

?>