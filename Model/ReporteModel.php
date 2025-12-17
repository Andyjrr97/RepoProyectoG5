<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/UtilesModel.php';

function TopVendidosPorRangoModel($inicio, $fin)
{
    try {
        $db = OpenConnection();

        $stmt = $db->prepare("CALL sp_top_vendidos_rango(?, ?)");
        $stmt->bind_param("ss", $inicio, $fin);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

        // Limpia resultados extra que deja CALL en mysqli
        while ($db->more_results() && $db->next_result()) {
            ;
        }

        $stmt->close();
        CloseConnection($db);

        return $data;
    } catch (Exception $e) {
        SaveError($e);
        return [];
    }
}

function HistorialProductoModel($id_producto)
{
    try {
        $db = OpenConnection();

        $stmt = $db->prepare("CALL sp_historial_producto(?)");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

        while ($db->more_results() && $db->next_result()) {
            ;
        }

        $stmt->close();
        CloseConnection($db);

        return $data;
    } catch (Exception $e) {
        SaveError($e);
        return [];
    }
}
