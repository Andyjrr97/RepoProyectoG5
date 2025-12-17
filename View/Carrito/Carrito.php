<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/CarritoController.php';

$carrito = CarritoController::obtener();
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

<h3 class="text-white mb-4">
    <i class="mdi mdi-cart"></i> Carrito de Compras
</h3>

<?php if (empty($carrito)): ?>

    <div class="card shadow-lg text-center p-5">
        <i class="mdi mdi-cart-off" style="font-size:80px;color:#ccc;"></i>
        <h4 class="mt-3 text-muted">Tu carrito está vacío</h4>
        <p class="text-muted">Agrega productos desde el catálogo</p>
    </div>

<?php else: ?>

<div class="card shadow-lg" style="border-radius:15px;">
<div class="card-body">

<div class="table-responsive">
<table class="table align-middle">
<thead style="background:#02003d;color:white;">
<tr>
    <th>Producto</th>
    <th class="text-center">Cantidad</th>
    <th class="text-end">Precio</th>
    <th class="text-end">Subtotal</th>
    <th class="text-center">Acciones</th>
</tr>
</thead>

<tbody>
<?php foreach ($carrito as $p): ?>
<tr>
    <td>
        <strong style="color:#333;">
            <?php echo htmlspecialchars($p['nombre']); ?>
        </strong>
    </td>

    <td class="text-center">
        <span class="badge badge-info px-3 py-2">
            <?php echo (int)$p['cantidad']; ?>
        </span>
    </td>

    <td class="text-end">
        $<?php echo number_format($p['precio'],2); ?>
    </td>

    <td class="text-end text-success fw-bold">
        $<?php echo number_format($p['precio'] * $p['cantidad'],2); ?>
    </td>

    <td class="text-center">

        <form method="POST" action="/RepoProyectoG5/Controller/CarritoController.php" style="display:inline;">
            <input type="hidden" name="id_producto" value="<?php echo (int)$p['id_producto']; ?>">
            <button type="submit" name="btnRestarCarrito" class="btn btn-sm btn-light">-</button>
        </form>

        <form method="POST" action="/RepoProyectoG5/Controller/CarritoController.php" style="display:inline;">
            <input type="hidden" name="id_producto" value="<?php echo (int)$p['id_producto']; ?>">
            <button type="submit" name="btnSumarCarrito" class="btn btn-sm btn-light">+</button>
        </form>

        <form method="POST" action="/RepoProyectoG5/Controller/CarritoController.php" style="display:inline;">
            <input type="hidden" name="id_producto" value="<?php echo (int)$p['id_producto']; ?>">
            <button type="submit" name="btnEliminarCarrito" class="btn btn-sm btn-danger">Eliminar</button>
        </form>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<hr>

<div class="row align-items-center">
    <div class="col-md-6">
        <form method="POST" action="/RepoProyectoG5/Controller/CarritoController.php">
            <button type="submit" name="btnVaciarCarrito" class="btn btn-outline-danger">
                Vaciar carrito
            </button>
        </form>
    </div>

    <div class="col-md-6 text-end">
        <h4 style="color:#02003d;">
            Total:
            <span class="fw-bold text-success">
                $<?php echo number_format(CarritoController::total(),2); ?>
            </span>
        </h4>

        <a href="/RepoProyectoG5/View/Pago/Pagar.php" class="btn btn-success mt-2">
            Pagar
        </a>
    </div>
</div>

</div>
</div>

<?php endif; ?>

</div>
<?php ShowFooter(); ?>
</div>
</div>
</div>

<?php ShowJS(); ?>
</body>
</html>

