$(function () {
    
    $("#formInicioSesion").validate({
        rules: {
            correo: {
                required: true
            },
            contrasena: {
                required: true
            },
        },
        messages: {
            correo: {
                required: "* Requerido"
            },
            contrasena: {
                required: "* Requerido"
            }
        },
            errorElement: "span",
            errorClass: "text-danger small"
    });

});