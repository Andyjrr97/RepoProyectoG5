<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
?>

<!DOCTYPE html>
<html lang="es">

<?php ShowCSS(); ?>

<body>
<div class="container-scroller">

    <?php ShowMenu(); ?>

    <div class="container-fluid page-body-wrapper">

        <?php ShowNav(); ?>

        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">

                        <div class="card" style="
                            background: rgba(15, 92, 187, 0.6); 
                            border-radius: 15px;
                            backdrop-filter: blur(2px);
                            padding: 25px 35px;
                            box-shadow: 0 4px 12px rgba(8, 0, 255, 0.4);
                        ">
                            <div class="card-body">

                                <h3 class="card-title" style="color:white; font-weight:bold;">
                                    Sobre Nosotros
                                </h3>

                                <p style="color:white;">
                                    En <b>Élite Electrónica</b> nos especializamos en la venta de computadoras,
                                    teléfonos, componentes y accesorios tecnológicos, ofreciendo productos de alto 
                                    rendimiento y marcas reconocidas.
                                </p>

                                <p style="color:white;">
                                    Nuestro objetivo es brindar una experiencia de compra confiable, con asesoría técnica,
                                    variedad de productos y un servicio al cliente cercano y profesional.
                                </p>

                                <p style="color:white;">
                                    Trabajamos constantemente para mantener un catálogo actualizado, precios competitivos 
                                    y un soporte post-venta que le permita a nuestros clientes aprovechar al máximo cada 
                                    equipo adquirido.
                                </p>

                                <p style="color:white; margin-bottom:0;">
                                    Gracias por confiar en <b>Élite Electrónica</b>. Estamos para ayudarle a encontrar la 
                                    mejor solución tecnológica para su hogar, estudio o negocio.
                                </p>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <?php ShowFooter(); ?>
        </div>

    </div>
</div>

<?php ShowJS(); ?>
</body>
</html>
