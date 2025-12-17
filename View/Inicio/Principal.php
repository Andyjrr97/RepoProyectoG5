<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

$productos = ObtenerProductosInicio();
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

                <h3 class="text-white mb-4">Productos Destacados</h3>

                <div class="row">
                    <?php foreach ($productos as $prod): ?>
                        <div class="col-md-4 grid-margin stretch-card">

                            <!-- CARD DEL PRODUCTO -->
                            <div class="card" style="
                                border-radius: 15px;
                                background: rgba(0, 0, 0, 0.55); 
                                box-shadow: 0 4px 15px rgba(0,0,0,0.4);
                                padding-top: 20px;
                            ">

                                <div class="card-body" style="text-align:center;">

                                    <!-- CONTENEDOR DE IMAGEN -->
                                    <?php if (!empty($prod['imagen'])): ?>
                                        <div style="
                                            width: 140px;
                                            height: 140px;
                                            margin: 0 auto 15px auto;
                                            border-radius: 12px;
                                            background: rgba(255,255,255,0.08);
                                            backdrop-filter: blur(4px);
                                            padding: 10px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        ">
                                            <img src="../imagenes/<?php echo htmlspecialchars($prod['imagen']); ?>" 
                                                style="
                                                    width:100%;
                                                    height:100%;
                                                    object-fit:contain;
                                                ">
                                        </div>
                                    <?php endif; ?>

                                    <!-- Nombre -->
                                    <h4 class="card-title text-white">
                                        <?php echo htmlspecialchars($prod['nombre']); ?>
                                    </h4>

                                    <!-- Descripción -->
                                    <p class="card-description text-muted">
                                        <?php echo htmlspecialchars($prod['descripcion']); ?>
                                    </p>

                                    <!-- Precio -->
                                    <h5 style="color:#4aa3ff; font-weight:bold;">
                                        $<?php echo number_format($prod['precio'], 2); ?>
                                    </h5>

                                    <!-- Botón Ver más -->
                                    <a href="../Productos/DetalleProducto.php?id=<?php echo $prod['id_producto']; ?>" 
                                       class="btn btn-primary btn-sm mt-2" 
                                       style="border-radius:8px; padding:6px 15px;">
                                        Ver más
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <?php ShowFooter(); ?>
        </div>

    </div>
</div>

<?php ShowJS(); ?>
</body>
</html>

