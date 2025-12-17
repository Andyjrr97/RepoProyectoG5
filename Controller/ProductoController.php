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

/* ============================
   NUEVO: Función que llama el View
   ============================ */
function AgregarProducto($nombre, $descripcion, $marca, $precio, $stock, $estado, $categoria, $descripcionDetallada, $imagen)
{
    return AgregarProductoModel($nombre, $descripcion, $marca, $precio, $stock, $estado, $categoria, $descripcionDetallada, $imagen);
}

