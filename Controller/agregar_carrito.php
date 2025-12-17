<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/CarritoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_producto = isset($_POST['id_producto']) ? (int)$_POST['id_producto'] : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : 0;
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;
    $stock = isset($_POST['stock']) ? (int)$_POST['stock'] : 0;

    if ($id_producto > 0 && $cantidad > 0) {
        CarritoController::agregar([
            'id_producto' => $id_producto,
            'nombre'      => $nombre,
            'precio'      => $precio,
            'cantidad'    => $cantidad,
            'stock'       => $stock
        ]);
    }

    $esAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    if ($esAjax) {
        header('Content-Type: application/json');
        echo json_encode([
            'ok' => true,
            'total_items' => isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0
        ]);
        exit;
    } else {
        $volver = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../index.php';
        header("Location: $volver");
        exit;
    }
}

