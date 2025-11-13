$(function () {

    $("#formRegistro").validate({
        rules: {
            Usuario: {
                required: true
            },
            Correo: {
                required: true
            },
            Contrasena: {
                required: true
            },
        },
        messages: {
            Usuario: {
                required: "* Requerido"
            },
            Correo: {
                required: "* Requerido"
            },
            Contrasena: {
                required: "* Requerido"
            }
        }
    });

});