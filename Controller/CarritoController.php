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
