<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/ReporteModel.php';

function ObtenerTopVendidosPorRango($inicio, $fin)
{
    return TopVendidosPorRangoModel($inicio, $fin);
}

function ObtenerHistorialProducto($id_producto)
{
    return HistorialProductoModel($id_producto);
}
