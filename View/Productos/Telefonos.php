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


$minPrecio = isset($_GET['min']) && $_GET['min'] !== '' ? (float)$_GET['min'] : 0;
$maxPrecio = isset($_GET['max']) && $_GET['max'] !== '' ? (float)$_GET['max'] : 1500;
$marcasSeleccionadas = isset($_GET['marca']) ? (array)$_GET['marca'] : [];

$categoriaTelefonos = 1;

$productos         = ObtenerProductosPorCategoria($categoriaTelefonos, $minPrecio, $maxPrecio, $marcasSeleccionadas);
$marcasDisponibles = ObtenerMarcasPorCategoria($categoriaTelefonos);
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
.filtro-card{
    background: rgba(0,0,0,.75);
    border-radius: 15px;
    padding: 20px;
    color: #fff;
}

.producto-card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
    height:100%;
}

.producto-card img{
    width:150px;
    height:150px;
    object-fit:contain;
    margin:auto;
}

.grid-equal{
    display:flex;
    flex-wrap:wrap;
}

.grid-equal > div{
    display:flex;
}

.card-body{
    display:flex;
    flex-direction:column;
}

.card-body .acciones{
    margin-top:auto;
}
</style>

<h3 class="text-white mb-4">
    Teléfonos
    <span class="badge badge-info"><?= count($productos) ?> disponibles</span>
</h3>

<div class="row">

<!-- FILTROS -->
<div class="col-md-3">
<div class="filtro-card">
<form method="GET">

<label>Precio:</label>
<div id="slider-precio" class="mt-2"></div>
<p class="mt-2">$<span id="minLabel"></span> - $<span id="maxLabel"></span></p>

<input type="hidden" name="min" id="min" value="<?= $minPrecio ?>">
<input type="hidden" name="max" id="max" value="<?= $maxPrecio ?>">

<?php if($marcasDisponibles): ?>
<hr>
<label>Marca:</label>
<?php foreach($marcasDisponibles as $m): ?>
<label class="d-block">
<input type="checkbox" name="marca[]"
       value="<?= $m['marca'] ?>"
       <?= in_array($m['marca'],$marcasSeleccionadas)?'checked':'' ?>>
<?= $m['marca'] ?>
</label>
<?php endforeach; ?>
<?php endif; ?>

<button class="btn btn-primary btn-block mt-3">Aplicar</button>
<a href="telefonos.php" class="btn btn-light btn-block mt-2">Limpiar</a>

</form>
</div>
</div>

<!-- PRODUCTOS -->
<div class="col-md-9">
<div class="row grid-equal">

<?php if(empty($productos)): ?>
<div class="col-12">
<div class="alert alert-info">No hay productos</div>
</div>
<?php endif; ?>

<?php foreach($productos as $p): ?>
<div class="col-md-6 col-lg-4 mb-4">
<div class="card producto-card">
<div class="card-body text-center">

<img src="../imagenes/<?= htmlspecialchars($p['imagen']) ?>">

<h5 class="mt-2"><?= htmlspecialchars($p['nombre']) ?></h5>
<p class="text-muted"><?= htmlspecialchars($p['descripcion']) ?></p>

<p><b>Stock:</b> <?= $p['stock'] ?></p>

<h5 class="text-primary">$<?= number_format($p['precio'],2) ?></h5>

<div class="acciones">

<form method="POST"
      action="/RepoProyectoG5/Controller/agregar_carrito.php"
      target="iframe_carrito">

<input type="hidden" name="id_producto" value="<?= $p['id_producto'] ?>">
<input type="hidden" name="nombre" value="<?= htmlspecialchars($p['nombre']) ?>">
<input type="hidden" name="precio" value="<?= $p['precio'] ?>">
<input type="hidden" name="stock" value="<?= $p['stock'] ?>">

<input type="number"
       name="cantidad"
       min="1"
       max="<?= $p['stock'] ?>"
       value="1"
       class="form-control mb-2">

<button class="btn btn-success btn-sm btn-block">
Agregar al carrito
</button>
</form>

<a href="../Productos/DetalleProducto.php?id=<?= $p['id_producto'] ?>"
   class="btn btn-primary btn-sm btn-block mt-2">
Ver más
</a>

</div>
</div>
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
