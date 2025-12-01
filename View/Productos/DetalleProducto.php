<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

$id = $_GET['id'] ?? 0;
$producto = ObtenerProductoPorId($id);
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

                <?php if ($producto): ?>

                    <div class="row">

                        <div class="col-md-5">
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="../imagenes/<?php echo htmlspecialchars($producto['imagen']); ?>"
                                     style="width:100%; max-width:350px; border-radius:15px; object-fit:cover;">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7">
                            <div style="
                                background: rgba(240,240,240,0.92);
                                border-radius: 18px;
                                padding: 25px 30px;
                                box-shadow: 0 4px 18px rgba(0,0,0,0.25);
                            ">
                                <h2 class="mb-3" style="color:#000; font-weight:bold;">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </h2>

                                <p style="color:#333;">
                                    <b>Características:</b>
                                    <?php echo htmlspecialchars($producto['descripcion']); ?>
                                </p>

                                <?php if (!empty($producto['descripcion_detallada'])): ?>
                                    <p style="color:#333; margin-top:10px;">
                                        <?php echo htmlspecialchars($producto['descripcion_detallada']); ?>
                                    </p>
                                <?php endif; ?>

                                <h3 class="mb-3" style="color:#007bff; font-weight:bold;">
                                    $<?php echo number_format($producto['precio'], 2); ?>
                                </h3>

                                <p style="color:#333;">
                                    Stock disponible: <b><?php echo $producto['stock']; ?></b>
                                </p>
                            </div>
                        </div>

                    </div>

                <?php else: ?>

                    <p class="text-white">No se encontró el producto.</p>

                <?php endif; ?>

            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>
</div>

<?php ShowJS(); ?>
</body>
</html>
