<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/CarritoController.php';

if (!isset($_SESSION["ced_usuario"])) {
    header("Location: /RepoProyectoG5/View/Inicio/IniciarSesion.php?e=sesion");
    exit;
}

if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "Administrador") {
    header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    exit;
}

$carrito = CarritoController::obtener();
if (empty($carrito)) {
    header("Location: /RepoProyectoG5/View/Carrito/Carrito.php");
    exit;
}

$db = OpenConnection();

try {
    $db->begin_transaction();

    $ced_usuario = (int) $_SESSION["ced_usuario"];

    // 1) Recalcular total REAL (no confiar en sesión)
    $total = 0.0;

    // Vamos a bloquear stock con SELECT ... FOR UPDATE para evitar sobreventa
    $stmtSel = $db->prepare("SELECT precio, stock FROM productos WHERE id_producto = ? LIMIT 1 FOR UPDATE");
    $stmtUpd = $db->prepare("UPDATE productos SET stock = ?, estado = ? WHERE id_producto = ?");
    $stmtDet = $db->prepare("INSERT INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario, total_linea)
                             VALUES (?, ?, ?, ?, ?)");

    // 2) Crear pedido
    $stmtPed = $db->prepare("INSERT INTO pedidos (ced_usuario, fecha, total, estado) VALUES (?, NOW(), 0.00, 'Confirmado')");
    $stmtPed->bind_param("i", $ced_usuario);
    $stmtPed->execute();

    $id_pedido = (int) $db->insert_id;

    foreach ($carrito as $p) {
        $id_producto = (int) $p['id_producto'];
        $cantidad = (int) $p['cantidad'];

        // Validaciones básicas
        if ($id_producto <= 0 || $cantidad <= 0) {
            throw new Exception("Producto/cantidad inválida.");
        }

        // Traer precio + stock real (bloqueado)
        $stmtSel->bind_param("i", $id_producto);
        $stmtSel->execute();
        $res = $stmtSel->get_result();

        if (!$res || $res->num_rows === 0) {
            throw new Exception("Producto no existe: $id_producto");
        }

        $row = $res->fetch_assoc();
        $precio = (float) $row['precio'];
        $stockActual = (int) $row['stock'];

        if ($cantidad > $stockActual) {
            throw new Exception("Stock insuficiente para producto $id_producto. Stock: $stockActual, solicitado: $cantidad");
        }

        $total_linea = $precio * $cantidad;
        $total += $total_linea;

        // 3) Insertar detalle
        $stmtDet->bind_param("iiidd", $id_pedido, $id_producto, $cantidad, $precio, $total_linea);
        $stmtDet->execute();

        // 4) Actualizar stock (y estado si llega a 0)
        $nuevoStock = $stockActual - $cantidad;
        $nuevoEstado = ($nuevoStock <= 0) ? "Inactivo" : "Activo";

        $stmtUpd->bind_param("isi", $nuevoStock, $nuevoEstado, $id_producto);
        $stmtUpd->execute();
    }


    $stmtUpPed = $db->prepare("UPDATE pedidos SET total = ? WHERE id_pedido = ?");
    $stmtUpPed->bind_param("di", $total, $id_pedido);
    $stmtUpPed->execute();

    $db->commit();

    CarritoController::vaciar();

    header("Location: /RepoProyectoG5/View/Inicio/Principal.php?ok=compra");
    exit;

} catch (Exception $e) {
    $db->rollback();

    header("Location: /RepoProyectoG5/View/Pago/Pagar.php?e=compra");
    exit;
} finally {
    CloseConnection($db);
}
