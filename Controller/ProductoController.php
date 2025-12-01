<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Model/ProductoModel.php';

function ObtenerProductosInicio()
{
    return ListarProductosModel();
}

function ObtenerProductoPorId($id)
{
    return ConsultarProductoPorIdModel($id);
}

function ObtenerProductosPorCategoria($categoriaId, $minPrecio = null, $maxPrecio = null, $marcas = [])
{
    return ListarProductosFiltradosModel($categoriaId, $minPrecio, $maxPrecio, $marcas);
}

function ObtenerMarcasPorCategoria($categoriaId)
{
    return ListarMarcasPorCategoriaModel($categoriaId);
}
