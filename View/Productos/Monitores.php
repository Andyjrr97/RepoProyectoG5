<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

$minPrecio = isset($_GET['min']) && $_GET['min'] !== '' ? (float)$_GET['min'] : 0;
$maxPrecio = isset($_GET['max']) && $_GET['max'] !== '' ? (float)$_GET['max'] : 1500;
$marcasSeleccionadas = isset($_GET['marca']) ? (array)$_GET['marca'] : [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "Cliente") {
    header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    exit;
}

$categoriaMonitores = 4;

$productos         = ObtenerProductosPorCategoria($categoriaMonitores, $minPrecio, $maxPrecio, $marcasSeleccionadas);
$marcasDisponibles = ObtenerMarcasPorCategoria($categoriaMonitores);
?>

<!DOCTYPE html>
<html lang="es">
<?php ShowCSS(); ?>

<body>

    <iframe id="iframe_carrito" name="iframe_carrito" style="display:none;"></iframe>

    <div class="container-scroller">

        <?php ShowMenu(); ?>

        <div class="container-fluid page-body-wrapper">

            <?php ShowNav(); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                    <style>
                    .filtro-card {
                        background: rgba(0, 0, 0, 0.75);
                        border-radius: 15px;
                        padding: 20px 25px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
                        color: #ffffff;
                        font-size: 0.9rem;
                    }

                    .producto-card {
                        background: #f2f2f2;
                        border-radius: 15px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                        border: 1px solid rgba(0, 0, 0, 0.1);
                        text-align: center;
                        padding: 20px;
                        color: #0044cc;
                        transition: transform .2s ease-in-out;
                    }

                    .producto-card:hover {
                        transform: scale(1.02);
                    }

                    .producto-card img {
                        width: 150px;
                        height: 150px;
                        object-fit: contain;
                        margin-bottom: 15px;
                    }

                    .texto-azul-marca {
                        color: #0066ff;
                        font-size: 0.9rem;
                        margin-bottom: 6px;
                    }

                    .texto-descripcion {
                        color: #555 !important;
                        font-size: 0.9rem;
                    }

                    .producto-card h5.text-primary {
                        color: #0033cc !important;
                        font-weight: bold;
                    }

                    .filtro-marca-label {
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        font-size: 0.9rem;
                        margin-bottom: 4px;
                    }

                    .producto-card .btn-primary {
                        background-color: #0033cc;
                        border-color: #0033cc;
                    }

                    .producto-card .btn-primary:hover {
                        background-color: #002a99;
                        border-color: #002a99;
                    }
                    </style>

                    <h3 class="text-white mb-4">Monitores
                        <span class="badge badge-info"><?= count($productos) ?> disponibles</span>
                    </h3>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="filtro-card">
                                <h4 class="mb-3">Filtrar</h4>

                                <form method="GET" action="">

                                    <label>Por precio (USD):</label>
                                    <div id="slider-precio" class="mt-2"></div>

                                    <p class="mt-2 mb-3">
                                        $<span id="minLabel"></span> — $<span id="maxLabel"></span>
                                    </p>

                                    <input type="hidden" id="min" name="min" value="<?php echo $minPrecio; ?>">
                                    <input type="hidden" id="max" name="max" value="<?php echo $maxPrecio; ?>">

                                    <?php if (!empty($marcasDisponibles)): ?>
                                    <hr>
                                    <label>Por marca:</label>
                                    <div style="max-height: 160px; overflow-y:auto; margin-top:5px;">
                                        <?php foreach ($marcasDisponibles as $m): 
                                            $marca   = $m['marca'];
                                            $checked = in_array($marca, $marcasSeleccionadas) ? 'checked' : '';
                                        ?>
                                        <label class="filtro-marca-label">
                                            <input type="checkbox" name="marca[]"
                                                value="<?php echo htmlspecialchars($marca); ?>" <?php echo $checked; ?>>
                                            <span><?php echo htmlspecialchars($marca); ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>

                                    <button type="submit" class="btn btn-primary btn-block mt-3">
                                        Aplicar filtros
                                    </button>

                                    <a href="Monitores.php" class="btn btn-light btn-block mt-2">
                                        Limpiar filtros
                                    </a>

                                </form>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <?php if (empty($productos)): ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No se encontraron monitores con los filtros seleccionados.
                                    </div>
                                </div>
                                <?php else: ?>
                                <?php foreach ($productos as $prod): ?>
                                <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                    <div class="card producto-card">
                                        <div class="card-body">

                                            <?php if (!empty($prod['imagen'])): ?>
                                            <img src="../imagenes/<?php echo htmlspecialchars($prod['imagen']); ?>"
                                                alt="<?php echo htmlspecialchars($prod['nombre']); ?>">
                                            <?php endif; ?>

                                            <h5 class="card-title font-weight-bold"
                                                style="color:#111; margin-bottom:8px;">
                                                <?php echo htmlspecialchars($prod['nombre']); ?>
                                            </h5>


                                            <?php if (!empty($prod['marca'])): ?>
                                            <p class="texto-azul-marca">
                                                Marca: <b><?php echo htmlspecialchars($prod['marca']); ?></b>
                                            </p>
                                            <?php endif; ?>

                                            <p class="card-description texto-descripcion">
                                                <?php echo htmlspecialchars($prod['descripcion']); ?>
                                            </p>

                                            <p style="color:#555; font-size:0.85rem; margin-bottom:8px;">
                                                Disponibles: <?php echo $prod['stock']; ?>
                                            </p>

                                            <h5 class="text-primary font-weight-bold mb-3">
                                                $<?php echo number_format($prod['precio'], 2); ?>
                                            </h5>

                                            <form method="POST" action="/RepoProyectoG5/Controller/agregar_carrito.php"
                                                target="iframe_carrito" style="margin-bottom:10px;">

                                                <input type="hidden" name="id_producto"
                                                    value="<?php echo $prod['id_producto']; ?>">
                                                <input type="hidden" name="nombre"
                                                    value="<?php echo htmlspecialchars($prod['nombre']); ?>">
                                                <input type="hidden" name="precio"
                                                    value="<?php echo $prod['precio']; ?>">
                                                <input type="hidden" name="stock" value="<?php echo $prod['stock']; ?>">

                                                <input type="number" name="cantidad" min="1"
                                                    max="<?php echo $prod['stock']; ?>" value="1"
                                                    class="form-control mb-2" style="max-width:120px; margin:0 auto;">

                                                <button class="btn btn-success btn-sm btn-block">
                                                    Agregar al carrito
                                                </button>
                                            </form>

                                            <a href="../Productos/DetalleProducto.php?id=<?php echo $prod['id_producto']; ?>"
                                                class="btn btn-primary btn-sm">
                                                Ver más
                                            </a>

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
        const minInicial = <?php echo $minPrecio; ?>;
        const maxInicial = <?php echo $maxPrecio; ?>;

        $("#slider-precio").slider({
            range: true,
            min: 0,
            max: 1500,
            step: 10,
            values: [minInicial, maxInicial],
            slide: function(event, ui) {
                actualizarLabels(ui.values[0], ui.values[1]);
            }
        });

        function actualizarLabels(min, max) {
            $("#minLabel").text(min);
            $("#maxLabel").text(max);
            $("#min").val(min);
            $("#max").val(max);
        }

        actualizarLabels(minInicial, maxInicial);
    });
    </script>

</body>

</html>
