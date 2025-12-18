<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php'; 


function ListarProductosModel()
{
    try {
        $db = OpenConnection();

        $sql = "SELECT id_producto, nombre, descripcion, precio, imagen, stock
                FROM productos
                WHERE estado = 'Activo'
                LIMIT 6";

        $productos = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

        CloseConnection($db);
        return $productos;

    } catch (Exception $e) {
        return [];
    }
}

function ConsultarProductoPorIdModel($id_producto)
{
    try {
        $db = OpenConnection();

        $sql = "SELECT * 
                FROM productos 
                WHERE id_producto = ".(int)$id_producto."
                LIMIT 1";

        $producto = $db->query($sql)->fetch_assoc();

        CloseConnection($db);
        return $producto;

    } catch (Exception $e) {
        return null;
    }
}

function ListarProductosPorCategoriaModel($id_categoria)
{
    try {
        $db = OpenConnection();

        $sql = "SELECT id_producto, nombre, descripcion, precio, imagen, stock
                FROM productos
                WHERE estado = 'Activo'
                  AND id_categoria = ".(int)$id_categoria;

        $productos = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

        CloseConnection($db);
        return $productos;

    } catch (Exception $e) {
        return [];
    }
}

function ListarProductosFiltradosModel($categoriaId, $min = null, $max = null, $marcas = [])
{
    try {
        $db = OpenConnection();
        $categoriaId = (int)$categoriaId;

        $sql = "SELECT id_producto, nombre, descripcion, precio, imagen, stock, marca
                FROM productos
                WHERE estado = 'Activo'
                  AND id_categoria = $categoriaId";

        if (!empty($min)) $sql .= " AND precio >= ".(float)$min;
        if (!empty($max)) $sql .= " AND precio <= ".(float)$max;

        if (!empty($marcas)) {
            $marcasSQL = array_map(fn($m) => "'" . $db->real_escape_string($m) . "'", $marcas);
            $sql .= " AND marca IN (" . implode(",", $marcasSQL) . ")";
        }

        $sql .= " ORDER BY precio ASC";

        $productos = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

        CloseConnection($db);
        return $productos;

    } catch (Exception $e) {
        return [];
    }
}

function ListarMarcasPorCategoriaModel($categoriaId)
{
    try {
        $db = OpenConnection();

        $sql = "SELECT DISTINCT marca 
                FROM productos
                WHERE estado = 'Activo'
                AND id_categoria = ".(int)$categoriaId."
                AND marca <> '' 
                ORDER BY marca";

        $marcas = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

        CloseConnection($db);
        return $marcas;

    } catch (Exception $e) {
        return [];
    }
}

function AgregarProductoModel($nombre, $descripcion, $marca, $precio, $stock, $estado, $categoria, $descripcion_detallada, $imagen)
{
    try {
        $db = OpenConnection();

        $nombre  = $db->real_escape_string($nombre);
        $descripcion = $db->real_escape_string($descripcion);
        $marca   = $db->real_escape_string($marca);
        $estado  = $db->real_escape_string($estado);
        $descripcion_detallada = $db->real_escape_string($descripcion_detallada);
        $imagen  = $db->real_escape_string($imagen);

        $precio  = (float)$precio;
        $stock   = (int)$stock;
        $categoria = (int)$categoria;

        $sql = "INSERT INTO productos
                (nombre, descripcion, marca, precio, stock, estado, id_categoria, descripcion_detallada, imagen)
                VALUES
                ('$nombre', '$descripcion', '$marca', $precio, $stock, '$estado', $categoria, '$descripcion_detallada', '$imagen')";

        $ok = $db->query($sql);

        CloseConnection($db);
        return $ok ? true : false;

    } catch (Exception $e) {
        return false;
    }
}


