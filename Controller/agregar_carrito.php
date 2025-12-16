<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/CarritoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    CarritoController::agregar([
        'id_producto' => (int)$_POST['id_producto'],
        'nombre'      => $_POST['nombre'],
        'precio'      => (float)$_POST['precio'],
        'cantidad'    => (int)$_POST['cantidad'],
        'stock'       => (int)$_POST['stock']
    ]);

    header('Content-Type: application/json');

    echo json_encode([
        'ok' => true,
        'total_items' => isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0
    ]);
}
