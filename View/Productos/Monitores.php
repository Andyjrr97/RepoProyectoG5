<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "Cliente") {
    header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    exit;
}

$categoriaId = 4;
$minPrecio = isset($_GET['min']) && $_GET['min'] !== '' ? (float)$_GET['min'] : 0;
$maxPrecio = isset($_GET['max']) && $_GET['max'] !== '' ? (float)$_GET['max'] : 1500;
$marcasSeleccionadas = isset($_GET['marca']) ? (array)$_GET['marca'] : [];

$productos = ObtenerProductosPorCategoria($categoriaId, $minPrecio, $maxPrecio, $marcasSeleccionadas);
$marcasDisponibles = ObtenerMarcasPorCategoria($categoriaId);
?>

<!DOCTYPE html>
<html lang="es">
<?php ShowCSS(); ?>
<body>

<iframe name="iframe_carrito" style="display:none;"></iframe>

<div class="container-scroller">
    <?php ShowMenu(); ?>

    <div class="container-fluid page-body-wrapper">
        <?php ShowNav(); ?>

        <div class="main-panel">
            <div class="content-wrapper">

                <style>
                    .filtro-card { background: rgba(0, 0, 0, 0.75); border-radius: 15px; padding: 20px; color: #fff; }
                    .producto-card { background: #fff; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,.15); height: 100%; display: flex; flex-direction: column; }
                    .producto-card img { width: 100%; height: 180px; object-fit: contain; padding: 10px; }
                    .card-body { display: flex; flex-direction: column; flex-grow: 1; text-align: center; color: #333; }
                    .acciones { margin-top: auto; }
                    .text-white-custom { color: white !important; }
                </style>

                <h3 class="text-white mb-4">Monitores</h3>

                <div class="row">
                    <div class="col-md-3">
                        <div class="filtro-card">
                            <form method="GET" action="Monitores.php">
                                <h4 class="text-white-custom">Filtrar</h4>
                                <hr style="border-top: 1px solid rgba(255,255,255,0.2);">
                                
                                <label>Precio (USD):</label>
                                <div id="slider-precio" class="mt-2 mb-2"></div>
                                <p>$<span id="minLabel"><?php echo $minPrecio; ?></span> - $<span id="maxLabel"><?php echo $maxPrecio; ?></span></p>

                                <input type="hidden" name="min" id="min" value="<?php echo $minPrecio; ?>">
                                <input type="hidden" name="max" id="max" value="<?php echo $maxPrecio; ?>">

                                <?php if (!empty($marcasDisponibles)): ?>
                                    <label class="mt-3">Marcas:</label>
                                    <div style="max-height: 200px; overflow-y: auto;">
                                        <?php foreach ($marcasDisponibles as $m): ?>
                                            <div class="form-check">
                                                <label class="form-check-label text-white-custom">
                                                    <input type="checkbox" name="marca[]" value="<?php echo htmlspecialchars($m['marca']); ?>" 
                                                    <?php echo in_array($m['marca'], $marcasSeleccionadas) ? 'checked' : ''; ?>>
                                                    <?php echo htmlspecialchars($m['marca']); ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <button type="submit" class="btn btn-primary btn-block mt-3">Aplicar</button>
                                <a href="Monitores.php" class="btn btn-light btn-block mt-2">Limpiar</a>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <?php if (empty($productos)): ?>
                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        No se encontraron monitores. Verifique los filtros.
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($productos as $p): ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card producto-card">
                                            <img src="../<?php echo htmlspecialchars($p['imagen']); ?>" alt="Monitor">
                                            <div class="card-body">
                                                <h5 class="font-weight-bold"><?php echo htmlspecialchars($p['nombre']); ?></h5>
                                                <p class="text-muted small"><?php echo htmlspecialchars($p['descripcion']); ?></p>
                                                <p class="mb-1"><b>Marca:</b> <?php echo htmlspecialchars($p['marca']); ?></p>
                                                <h4 class="text-primary font-weight-bold">$<?php echo number_format($p['precio'], 2); ?></h4>
                                                
                                                <div class="acciones">
                                                    <form method="POST" action="/RepoProyectoG5/Controller/agregar_carrito.php" target="iframe_carrito">
                                                        <input type="hidden" name="id_producto" value="<?php echo $p['id_producto']; ?>">
                                                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>">
                                                        <input type="hidden" name="precio" value="<?php echo $p['precio']; ?>">
                                                        <input type="hidden" name="stock" value="<?php echo $p['stock']; ?>">
                                                        <input type="number" name="cantidad" min="1" max="<?php echo $p['stock']; ?>" value="1" class="form-control mb-2">
                                                        <button class="btn btn-success btn-sm btn-block">Agregar al carrito</button>
                                                    </form>
                                                    <a href="../Productos/DetalleProducto.php?id=<?php echo $p['id_producto']; ?>" class="btn btn-primary btn-sm btn-block mt-2">Ver Detalles</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ShowFooter(); ?>
        </div>
    </div>
</div>

<?php ShowJS(); ?>

<script>
$(function() {
    $("#slider-precio").slider({
        range: true,
        min: 0,
        max: 1500,
        values: [<?php echo $minPrecio; ?>, <?php echo $maxPrecio; ?>],
        slide: function(event, ui) {
            $("#minLabel").text(ui.values[0]);
            $("#maxLabel").text(ui.values[1]);
            $("#min").val(ui.values[0]);
            $("#max").val(ui.values[1]);
        }
    });
});
</script>
</body>
</html>
