<?php

    function ShowCSS()
    {
        echo '
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Inicio</title>
        <link rel="stylesheet" href="../../View/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../View/css/vendor.bundle.base.css">
    
        <link rel="stylesheet" href="../../View/css/style.css">
        <link rel="shortcut icon" href="../../View/imagenes/favicon.png" />
    </head>';
    }

    function ShowJS()
    {
      echo '
    <script src="../../View/js/vendor.bundle.base.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="../../View/js/off-canvas.js"></script>
    <script src="../../View/js/hoverable-collapse.js"></script>
    <script src="../../View/js/misc.js"></script>
    <script src="../../View/js/settings.js"></script>
    <script src="../../View/js/todolist.js"></script>';
    }

?>