<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CarritoController {

    public static function agregar($producto) {

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $id = $producto['id_producto'];

        if (isset($_SESSION['carrito'][$id])) {

            $nuevaCantidad =
                $_SESSION['carrito'][$id]['cantidad'] + $producto['cantidad'];

            if ($nuevaCantidad <= $producto['stock']) {
                $_SESSION['carrito'][$id]['cantidad'] = $nuevaCantidad;
            }

        } else {

            if ($producto['cantidad'] <= $producto['stock']) {
                $_SESSION['carrito'][$id] = [
                    'id_producto' => $id,
                    'nombre'      => $producto['nombre'],
                    'precio'      => $producto['precio'],
                    'cantidad'    => $producto['cantidad'],
                    'stock'       => $producto['stock']
                ];
            }
        }
    }

    public static function actualizarCantidad($id, $cantidad) {

        if (!isset($_SESSION['carrito'][$id])) {
            return;
        }

        $cantidad = (int)$cantidad;

        if ($cantidad <= 0) {
            unset($_SESSION['carrito'][$id]);
            return;
        }

        $stock = (int)$_SESSION['carrito'][$id]['stock'];

        if ($cantidad > $stock) {
            $cantidad = $stock;
        }

        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }

    public static function obtener() {
        return $_SESSION['carrito'] ?? [];
    }

    public static function total() {
        $total = 0;
        foreach (self::obtener() as $p) {
            $total += $p['precio'] * $p['cantidad'];
        }
        return $total;
    }

    public static function eliminar($id) {
        unset($_SESSION['carrito'][$id]);
    }

    public static function vaciar() {
        unset($_SESSION['carrito']);
    }
}

if (isset($_POST["btnAgregarCarrito"])) {

    $producto = [
        'id_producto' => $_POST["id_producto"],
        'nombre'      => $_POST["nombre"],
        'precio'      => $_POST["precio"],
        'cantidad'    => isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 1,
        'stock'       => $_POST["stock"]
    ];

    CarritoController::agregar($producto);

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: /RepoProyectoG5/View/Inicio/Principal.php");
    }
    exit;
}

if (isset($_POST["btnEliminarCarrito"])) {

    $id = (int)$_POST["id_producto"];
    CarritoController::eliminar($id);

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: /RepoProyectoG5/View/Carrito/Carrito.php");
    }
    exit;
}

if (isset($_POST["btnSumarCarrito"])) {

    $id = (int)$_POST["id_producto"];

    $carrito = CarritoController::obtener();
    if (isset($carrito[$id])) {
        $nueva = $carrito[$id]["cantidad"] + 1;
        CarritoController::actualizarCantidad($id, $nueva);
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: /RepoProyectoG5/View/Carrito/Carrito.php");
    }
    exit;
}

if (isset($_POST["btnRestarCarrito"])) {

    $id = (int)$_POST["id_producto"];

    $carrito = CarritoController::obtener();
    if (isset($carrito[$id])) {
        $nueva = $carrito[$id]["cantidad"] - 1;
        CarritoController::actualizarCantidad($id, $nueva);
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: /RepoProyectoG5/View/Carrito/Carrito.php");
    }
    exit;
}

if (isset($_POST["btnVaciarCarrito"])) {

    CarritoController::vaciar();

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: /RepoProyectoG5/View/Carrito/Carrito.php");
    }
    exit;
}

