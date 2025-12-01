<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php'; 


function ListarProductosModel()
{
    try {
        $db = OpenConnection();

        $sql = "SELECT 
                    id_producto,
                    nombre,
                    descripcion,
                    precio,
                    imagen,
                    stock
                FROM productos
                WHERE estado = 'Activo'
                LIMIT 6";

        $query = $db->query($sql);

        if (!$query) {
            echo "Error en SQL: " . $db->error;
            return [];
        }

        $productos = [];

        while ($row = $query->fetch_assoc()) {
            $productos[] = $row;
        }

        CloseConnection($db);
        return $productos;

    } catch (Exception $e) {
        echo $e->getMessage();
        return [];
    }
}



function ConsultarProductoPorIdModel($id_producto)
{
    try {
        $db = OpenConnection();

        $sql = "SELECT *
                FROM productos
                WHERE id_producto = $id_producto
                LIMIT 1";

        $query = $db->query($sql);

        if (!$query) {
            echo "Error SQL: " . $db->error;
            return null;
        }

        $producto = $query->fetch_assoc();

        CloseConnection($db);
        return $producto;

    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}