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
