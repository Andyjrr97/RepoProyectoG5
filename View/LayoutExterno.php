<?php

function ShowCSS()
{
    echo '
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Élite Electronica</title>
        <link rel="stylesheet" href="../../View/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../View/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../../View/css/style.css">
        <link rel="shortcut icon" href="../../View/imagenes/faviconi.png" />

        <style>
            .auth.login-bg,
            .full-page-wrapper.login-bg,
            .content-wrapper.full-page-wrapper.auth.login-bg {
                background: url("../imagenes/Login_bn.png") no-repeat center center !important;
                background-size: cover !important;
                background-color: #000 !important; /* por si no carga la imagen */
            }
                .card {
        background: rgba(3, 0, 40, 0.80) !important;
        backdrop-filter: blur(6px);
    }
        </style>
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
