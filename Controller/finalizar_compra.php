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

    foreach ($carrito as $p) {
        $id = (int)$p['id_producto'];
        $cant = (int)$p['cantidad'];

        $sqlSel = "SELECT stock FROM productos WHERE id_producto = $id LIMIT 1";
        $res = $db->query($sqlSel);

        if (!$res || $res->num_rows === 0) {
            continue;
        }

        $row = $res->fetch_assoc();
        $stockActual = (int)$row['stock'];
        $nuevoStock = $stockActual - $cant;

        if ($nuevoStock <= 0) {
            $sqlDel = "DELETE FROM productos WHERE id_producto = $id";
            $db->query($sqlDel);
        } else {
            $sqlUpd = "UPDATE productos SET stock = $nuevoStock WHERE id_producto = $id";
            $db->query($sqlUpd);
        }
    }

    $db->commit();

    CarritoController::vaciar();

    header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    exit;

} catch (Exception $e) {
    $db->rollback();
    header("Location: /RepoProyectoG5/View/Pago/Pagar.php?e=compra");
    exit;

} finally {
    CloseConnection($db);
}

