<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

/* ================== RESTRICCIÓN (SOLO CLIENTE) ================== */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "Cliente") {
    header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    exit;
}
/* ================================================================ */

$minPrecio = isset($_GET['min']) && $_GET['min'] !== '' ? (float)$_GET['min'] : 0;
$maxPrecio = isset($_GET['max']) && $_GET['max'] !== '' ? (float)$_GET['max'] : 1500;
$marcasSeleccionadas = isset($_GET['marca']) ? (array)$_GET['marca'] : [];

$categoriaComputadoras = 2;

$productos         = ObtenerProductosPorCategoria($categoriaComputadoras, $minPrecio, $maxPrecio, $marcasSeleccionadas);
$marcasDisponibles = ObtenerMarcasPorCategoria($categoriaComputadoras);
?>

<!DOCTYPE html>
<html lang="es">
<?php ShowCSS(); ?>
<body>

<!-- IMPORTANTE: iframe oculto para que el POST NO cambie de página -->
<iframe name="iframe_carrito" style="display:none;"></iframe>

<div class="container-scroller">

<?php ShowMenu(); ?>
<div class="container-fluid page-body-wrapper">
<?php ShowNav(); ?>

<div class="main-panel">
<div class="content-wrapper">

<style>
/* ================= FILTROS ================= */
.filtro-card{
    background: rgba(0,0,0,.75);
    border-radius:15px;
    padding:20px;
    color:#fff;
    box-shadow:0 4px 12px rgba(0,0,0,.4);
}

/* ================= PRODUCTOS ================= */
.producto-card{
    background:#fff;
    border-radius:15px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
    display:flex;
    flex-direction:column;
    height:100%;
    text-align:center;
}

.producto-card img{
    width:150px;
    height:150px;
    object-fit:contain;
    margin:0 auto 10px;
}

.producto-contenido{
    flex-grow:1;
}

.texto-descripcion{
    color:#666;
    font-size:.9rem;
}

.stock-text{
    font-size:.85rem;
    color:#555;
}

.cantidad-group{
    display:flex;
    justify-content:center;
    margin:10px 0;
}

.cantidad-group input{
    width:70px;
    text-align:center;
}
</style>

<h3 class="text-white mb-4">Computadoras</h3>

<div class="row">

<!-- ================= FILTROS ================= -->
<div class="col-md-3">
<div class="filtro-card">

<form method="GET">
    <label>Precio (USD)</label>
    <div id="slider-precio" class="mt-2"></div>
    <p class="mt-2">$<span id="minLabel"></span> — $<span id="maxLabel"></span></p>

    <input type="hidden" id="min" name="min" value="<?= $minPrecio ?>">
    <input type="hidden" id="max" name="max" value="<?= $maxPrecio ?>">

    <?php if($marcasDisponibles): ?>
    <hr>
    <label>Marca</label>
    <?php foreach($marcasDisponibles as $m): ?>
        <div>
            <input type="checkbox"
                   name="marca[]"
                   value="<?= htmlspecialchars($m['marca']) ?>"
                   <?= in_array($m['marca'],$marcasSeleccionadas)?'checked':'' ?>>
            <?= htmlspecialchars($m['marca']) ?>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <button class="btn btn-primary btn-block mt-3">Aplicar</button>
    <a href="Computadoras.php" class="btn btn-light btn-block mt-2">Limpiar</a>
</form>

</div>
</div>

<!-- ================= PRODUCTOS ================= -->
<div class="col-md-9">
<div class="row">

<?php if(empty($productos)): ?>
<div class="col-12">
<div class="alert alert-info">No hay computadoras disponibles.</div>
</div>
<?php endif; ?>

<?php foreach($productos as $p): ?>
<div class="col-md-6 col-lg-4 mb-4 d-flex">

<div class="producto-card">

<?php if($p['imagen']): ?>
<img src="../imagenes/<?= htmlspecialchars($p['imagen']) ?>">
<?php endif; ?>

<div class="producto-contenido">
    <h5><?= htmlspecialchars($p['nombre']) ?></h5>
    <p class="texto-descripcion"><?= htmlspecialchars($p['descripcion']) ?></p>
</div>

<h5 class="text-primary">$<?= number_format($p['precio'],2) ?></h5>

<p class="stock-text">
    Disponibles: <?= $p['stock'] ?>
</p>

<form method="POST"
      action="/RepoProyectoG5/Controller/agregar_carrito.php"
      target="iframe_carrito">

    <input type="hidden" name="id_producto" value="<?= $p['id_producto'] ?>">
    <input type="hidden" name="nombre" value="<?= htmlspecialchars($p['nombre']) ?>">
    <input type="hidden" name="precio" value="<?= $p['precio'] ?>">
    <input type="hidden" name="stock" value="<?= $p['stock'] ?>">

    <div class="cantidad-group">
        <input type="number"
               name="cantidad"
               min="1"
               max="<?= $p['stock'] ?>"
               value="1"
               class="form-control">
    </div>

    <button class="btn btn-success btn-sm">
        Agregar al carrito
    </button>
</form>

<a href="../Productos/DetalleProducto.php?id=<?= $p['id_producto'] ?>"
   class="btn btn-primary btn-sm mt-2">
   Ver más
</a>

</div>
</div>
<?php endforeach; ?>

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
$(function(){
    $("#slider-precio").slider({
        range:true,
        min:0,
        max:1500,
        values:[<?= $minPrecio ?>,<?= $maxPrecio ?>],
        slide:function(e,ui){
            $("#minLabel").text(ui.values[0]);
            $("#maxLabel").text(ui.values[1]);
            $("#min").val(ui.values[0]);
            $("#max").val(ui.values[1]);
        }
    });

    $("#minLabel").text(<?= $minPrecio ?>);
    $("#maxLabel").text(<?= $maxPrecio ?>);
});
</script>

</body>
</html>
