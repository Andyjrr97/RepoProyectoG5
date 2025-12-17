<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/CarritoController.php';

$carrito = CarritoController::obtener();
$total = CarritoController::total();
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

<h3 class="text-white mb-4">Pago</h3>

<?php if (empty($carrito)): ?>
    <div class="alert alert-info">No hay productos para pagar.</div>
<?php else: ?>
    <div class="card shadow-lg" style="border-radius:15px;">
        <div class="card-body">
            <h4>Total a pagar: $<?php echo number_format($total,2); ?></h4>

            <form method="POST" action="/RepoProyectoG5/Controller/finalizar_compra.php" class="mt-3">
                <button type="submit" class="btn btn-success">
                    Confirmar compra
                </button>
            </form>

            <a href="/RepoProyectoG5/View/Carrito/Carrito.php" class="btn btn-link mt-2">
                Volver al carrito
            </a>
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

