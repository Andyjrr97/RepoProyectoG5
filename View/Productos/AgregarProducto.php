<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/View/LayoutInterno.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoProyectoG5/Controller/ProductoController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["ced_usuario"])) {
    header("Location: ../../View/Inicio/IniciarSesion.php?e=sesion");
    exit;
}

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != "Administrador") {
    header("Location: ../../View/Inicio/Principal.php");
    exit;
}

if (isset($_POST["btnAgregarProducto"])) {

    $nombre = isset($_POST["Nombre"]) ? $_POST["Nombre"] : "";
    $descripcion = isset($_POST["Descripcion"]) ? $_POST["Descripcion"] : "";
    $marca = isset($_POST["Marca"]) ? $_POST["Marca"] : "";
    $precio = isset($_POST["Precio"]) ? $_POST["Precio"] : 0;
    $stock = isset($_POST["Stock"]) ? $_POST["Stock"] : 0;
    $estado = isset($_POST["Estado"]) ? $_POST["Estado"] : "Activo";
    $categoria = isset($_POST["Categoria"]) ? $_POST["Categoria"] : 1;
    $descripcionDetallada = isset($_POST["DescripcionDetallada"]) ? $_POST["DescripcionDetallada"] : "";

    $imagen = "";
    if (isset($_POST["Imagen"])) {
        $imagen = $_POST["Imagen"];
    }

    $resultado = AgregarProducto($nombre, $descripcion, $marca, $precio, $stock, $estado, $categoria, $descripcionDetallada, $imagen);

    if ($resultado) {
        $_POST["MensajeProducto"] = "Producto agregado correctamente";
    } else {
        $_POST["MensajeProducto"] = "No se pudo agregar el producto";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php ShowCSS(); ?>

<body>

    <div class="container-scroller">
        <?php ShowMenu(); ?>

        <div class="container-fluid page-body-wrapper">
            <?php ShowNav(); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Agregar producto</h4>

                                    <?php
                                    if (isset($_POST["MensajeProducto"])) {
                                        echo '<div class="alert alert-primary centrado">' . $_POST["MensajeProducto"] . '</div>';
                                    }
                                    ?>

                                    <form method="POST" action="">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input type="text" class="form-control" name="Nombre" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Descripción</label>
                                                    <input type="text" class="form-control" name="Descripcion" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Marca</label>
                                                    <input type="text" class="form-control" name="Marca" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Precio</label>
                                                    <input type="number" class="form-control" name="Precio" step="0.01"
                                                        min="0" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Imagen (ruta como en la BD)</label>
                                                    <input type="text" class="form-control" name="Imagen"
                                                        placeholder="ej: productos/iphone14.jpg">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Stock</label>
                                                    <input type="number" class="form-control" name="Stock" min="0"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Estado</label>
                                                    <select class="form-control" name="Estado" required>
                                                        <option value="Activo">Activo</option>
                                                        <option value="Inactivo">Inactivo</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Categoría</label>
                                                    <select class="form-control" name="Categoria" required>
                                                        <option value="1">Teléfonos</option>
                                                        <option value="2">Computadoras</option>
                                                        <option value="3">Accesorios</option>
                                                        <option value="4">Monitores</option>
                                                        <option value="5">Componentes</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Descripción detallada</label>
                                                    <textarea class="form-control" name="DescripcionDetallada"
                                                        rows="4"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" name="btnAgregarProducto"
                                                        class="btn btn-primary btn-block">
                                                        Guardar producto
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php ShowFooter(); ?>
            </div>
        </div>
    </div>

    <?php ShowJS(); ?>
</body>

</html>