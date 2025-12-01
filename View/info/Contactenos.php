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

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card" style="
                            background: rgba(0, 0, 0, 0.60); 
                            border-radius: 15px;
                            backdrop-filter: blur(2px);
                            padding: 20px 25px;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
                        ">
                            <div class="card-body">
                                <h3 class="card-title" style="color:white; font-weight:bold;">
                                    Contáctenos
                                </h3>

                                <p style="color:white;">
                                    Si desea más información sobre nuestros productos, soporte técnico
                                    o cotizaciones especiales, puede contactarnos por los siguientes medios:
                                </p>

                                <ul class="list-unstyled" style="color:white;">
                                    <li><b>Teléfono:</b> +506 8888-0000</li>
                                    <li><b>Correo electrónico:</b> soporte@eliteelectronica.com</li>
                                    <li><b>Horario de atención:</b> Lunes a Sábado, 9:00 a.m. a 6:00 p.m.</li>
                                </ul>

                                <p style="color:white; margin-bottom:0;">
                                    También puede visitarnos en nuestra ubicación física, mostrada en el mapa a la derecha.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card" style="
                            background: rgba(8, 8, 133, 0.6); 
                            border-radius: 15px;
                            overflow: hidden;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
                        ">
                            <div class="card-body p-0" style="height:100%;">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2731.9855874421473!2d-84.01725646092522!3d9.908582610999781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e3d897d07297%3A0x67670599323fb16f!2sCiudad%20del%20Este!5e0!3m2!1ses-419!2scr!4v1764560471647!5m2!1ses-419!2scr" 
                                    width="100%" 
                                    height="420" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
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
