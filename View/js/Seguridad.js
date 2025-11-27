
$(function () {

    $("#formSeguridad").validate({
        rules: {
            Contrasenna: {
                required: true,
                 maxlength: 10
            },
            ConfirmarContrasenna: {
                required: true,
                equalTo: "#Contrasena",
                 maxlength: 10
            }
        },
        messages: {
            Contrasenna: {
                required: "* Requerido",
                maxlength: "* Máximo 10 caracteres"
            },
            ConfirmarContrasenna: {
                required: "* Requerido",
                equalTo: "* Los valores no coinciden",
                maxlength: "* Máximo 10 caracteres"
            }
        }
    });

});