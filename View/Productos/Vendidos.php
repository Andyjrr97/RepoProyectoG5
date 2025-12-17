<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ReporteController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =======================
   Seguridad (igual que tus otras páginas Admin)
======================= */
if (!isset($_SESSION["ced_usuario"])) {
    header("Location: ../../View/Inicio/IniciarSesion.php?e=sesion");
    exit;
}

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != "Administrador") {
    header("Location: ../../View/Inicio/Principal.php");
    exit;
}

/* =======================
   Filtros (SIEMPRE definidos)
======================= */
$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "mes";   // semana|mes|anio
$anio = isset($_GET["anio"]) ? (int) $_GET["anio"] : (int) date("Y");
$mes = isset($_GET["mes"]) ? (int) $_GET["mes"] : (int) date("m");

if (!in_array($tipo, ["semana", "mes", "anio"])) {
    $tipo = "mes";
}
if ($mes < 1 || $mes > 12) {
    $mes = (int) date("m");
}

/* =======================
   Rangos de fecha
======================= */
if ($tipo === "anio") {
    $inicio = "$anio-01-01 00:00:00";
    $fin = "$anio-12-31 23:59:59";
} elseif ($tipo === "semana") {
    $inicio = date("Y-m-d 00:00:00", strtotime("monday this week"));
    $fin = date("Y-m-d 23:59:59", strtotime("sunday this week"));
} else { // mes
    $inicio = date("Y-m-01 00:00:00", strtotime("$anio-$mes-01"));
    $fin = date("Y-m-t 23:59:59", strtotime("$anio-$mes-01"));
}

/* =======================
   Datos Top Vendidos
======================= */
$topVendidos = ObtenerTopVendidosPorRango($inicio, $fin);

/* =======================
   Historial (opcional)
======================= */
$idHist = isset($_GET["hist"]) ? (int) $_GET["hist"] : 0;
$historial = [];
if ($idHist > 0) {
    $historial = ObtenerHistorialProducto($idHist);
}

/* =======================
   Data para gráfico (si hay historial)
======================= */
$labels = [];
$dataUnidades = [];
$dataIngresos = [];

if (!empty($historial)) {
    $agrupado = [];

    foreach ($historial as $h) {
        $dia = substr($h["fecha"], 0, 10); // YYYY-MM-DD
        if (!isset($agrupado[$dia])) {
            $agrupado[$dia] = ["unidades" => 0, "ingresos" => 0.0];
        }
        $agrupado[$dia]["unidades"] += (int) $h["cantidad"];
        $agrupado[$dia]["ingresos"] += (float) $h["total_linea"];
    }

    ksort($agrupado);

    foreach ($agrupado as $dia => $vals) {
        $labels[] = $dia;
        $dataUnidades[] = $vals["unidades"];
        $dataIngresos[] = round($vals["ingresos"], 2);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php ShowCSS(); ?>

<body>

    <div class="container-scroller">
        <?php ShowMenu(); ?>

        <div class="container-fluid page-body-wrapper">

            <?php ShowNav(); ?> <!-- ✅ NAVBAR CORRECTO (toggle sidebar + dropdown/logout) -->

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="mb-0">📊 Productos más vendidos</h3>
                        <small class="text-muted">Rango: <b><?= $inicio ?></b> → <b><?= $fin ?></b></small>
                    </div>

                    <!-- FILTROS -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="GET" class="row g-2">
                                <div class="col-md-3">
                                    <label class="form-label">Filtro</label>
                                    <select name="tipo" class="form-control">
                                        <option value="semana" <?= $tipo === "semana" ? "selected" : "" ?>>Semana</option>
                                        <option value="mes" <?= $tipo === "mes" ? "selected" : "" ?>>Mes</option>
                                        <option value="anio" <?= $tipo === "anio" ? "selected" : "" ?>>Año</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Año</label>
                                    <input type="number" name="anio" class="form-control" value="<?= $anio ?>">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Mes</label>
                                    <input type="number" name="mes" class="form-control" value="<?= $mes ?>" min="1"
                                        max="12">
                                    <small class="text-muted">*Solo aplica para “Mes”</small>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-primary w-100" type="submit">Filtrar</button>
                                </div>

                                <?php if ($idHist > 0): ?>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <a class="btn btn-outline-secondary w-100"
                                            href="Vendidos.php?tipo=<?= $tipo ?>&anio=<?= $anio ?>&mes=<?= $mes ?>">
                                            Quitar historial
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>

                    <!-- TABLA TOP VENDIDOS -->
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($topVendidos)): ?>
                                <div class="text-center p-5">
                                    <h5 class="mb-2">No hay ventas registradas</h5>
                                    <p class="text-muted mb-0">
                                        Aún no se han confirmado compras en este período.<br>
                                        Cuando un cliente compre, aquí se mostrará automáticamente.
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th style="width: 90px;">ID</th>
                                                <th>Producto</th>
                                                <th style="width: 160px;">Unidades vendidas</th>
                                                <th style="width: 180px;">Total generado</th>
                                                <th style="width: 140px;">Historial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($topVendidos as $p): ?>
                                                <tr>
                                                    <td><?= $p["id_producto"] ?></td>
                                                    <td><?= $p["nombre"] ?></td>
                                                    <td><?= $p["total_vendido"] ?></td>
                                                    <td>₡<?= number_format((float) $p["total_ingresos"], 2) ?></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-info"
                                                            href="Vendidos.php?tipo=<?= $tipo ?>&anio=<?= $anio ?>&mes=<?= $mes ?>&hist=<?= (int) $p["id_producto"] ?>">
                                                            Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- HISTORIAL + GRÁFICO -->
                    <?php if ($idHist > 0): ?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="mb-3">📌 Historial del producto ID: <?= $idHist ?></h5>

                                <?php if (empty($historial)): ?>
                                    <p class="text-muted mb-0">Este producto no tiene compras confirmadas.</p>
                                <?php else: ?>
                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th style="width: 220px;">Fecha</th>
                                                    <th style="width: 120px;">Cantidad</th>
                                                    <th style="width: 160px;">Precio unitario</th>
                                                    <th style="width: 160px;">Total línea</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($historial as $h): ?>
                                                    <tr>
                                                        <td><?= $h["fecha"] ?></td>
                                                        <td><?= $h["cantidad"] ?></td>
                                                        <td>₡<?= number_format((float) $h["precio_unitario"], 2) ?></td>
                                                        <td>₡<?= number_format((float) $h["total_linea"], 2) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h5 class="mb-3">📈 Gráfico de ventas (por día)</h5>
                                    <canvas id="graficoHistorial" style="width:100%; max-height:320px;"></canvas>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <?php ShowFooter(); ?>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        (function () {
            const labels = <?= json_encode($labels) ?>;
            const unidades = <?= json_encode($dataUnidades) ?>;
            const ingresos = <?= json_encode($dataIngresos) ?>;

            if (!labels || labels.length === 0) return;

            const canvas = document.getElementById('graficoHistorial');
            if (!canvas) return;

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'Unidades vendidas', data: unidades, tension: 0.25 },
                        { label: 'Ingresos (₡)', data: ingresos, tension: 0.25, yAxisID: 'y2' }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: { mode: 'index', intersect: false },
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Unidades' } },
                        y2: {
                            beginAtZero: true,
                            position: 'right',
                            grid: { drawOnChartArea: false },
                            title: { display: true, text: 'Ingresos (₡)' }
                        }
                    }
                }
            });
        })();
    </script>

    <?php ShowJS(); ?>
</body>

</html>