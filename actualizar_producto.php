<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <h1>Actualizar Producto</h1>

    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID del producto a actualizar
        $id_producto = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información del producto desde la base de datos según el ID
        $server = "localhost";
        $user = "root";
        $password = "";
        $dataBase = "veterinaria_db";

        // Establecer la conexión mysqli
        $conexion = mysqli_connect($server, $user, $password, $dataBase);

        // Verificar la conexión
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta SQL para obtener información del producto
        $sqlProducto = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
        $resultProducto = mysqli_query($conexion, $sqlProducto);

        // Consulta SQL para obtener la lista de categorías
        $sqlCategorias = "SELECT id_categoria, descripcion FROM categoria";
        $resultCategorias = mysqli_query($conexion, $sqlCategorias);

        // Verificar si se obtuvieron resultados
        if ($resultProducto && $resultCategorias) {
            // Mostrar el formulario de actualización con la información del producto
            $rowProducto = mysqli_fetch_assoc($resultProducto);
    ?>
            <form method="POST" action="procesar_actualizar_producto.php" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="Actualizar Producto">
                <input type="hidden" name="id_producto" value="<?php echo $rowProducto['id_producto']; ?>">

                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" value="<?php echo $rowProducto['descripcion']; ?>" required><br>

                <label for="detalle">Detalle:</label>
                <textarea name="detalle" required><?php echo $rowProducto['detalle']; ?></textarea><br>

                <label for="precio">Precio:</label>
                <input type="text" name="precio" value="<?php echo $rowProducto['precio']; ?>" required><br>

                <label for="existencias">Existencias:</label>
                <input type="text" name="existencias" value="<?php echo $rowProducto['existencias']; ?>" required><br>

                <label for="ruta_imagen">Imagen:</label>
                <input type="file" name="ruta_imagen"><br>
                <?php
                // Verificar si hay una ruta de imagen en la base de datos
                if (!empty($rowProducto['ruta_imagen'])) {
                    echo '<label>Imagen actual:</label>';
                    echo '<img src="' . $rowProducto['ruta_imagen'] . '" alt="Imagen de perfil" width="100"><br>';
                }
                ?>

                <label for="activo">Activo:</label>
                <input type="checkbox" name="activo" <?php echo $rowProducto['activo'] ? 'checked' : ''; ?>><br>

                <label for="id_categoria">Categoría:</label>
                <select name="id_categoria" required>
                    <?php
                    // Mostrar opciones del dropdown con las categorías
                    while ($rowCategoria = mysqli_fetch_assoc($resultCategorias)) {
                        $selected = ($rowCategoria['id_categoria'] == $rowProducto['id_categoria']) ? 'selected' : '';
                        echo "<option value='{$rowCategoria['id_categoria']}' $selected>{$rowCategoria['descripcion']}</option>";
                    }
                    ?>
                </select><br>

                <br>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información del producto o la lista de categorías.";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Acceso no válido.";
    }
    ?>

    <!-- Script para cargar el header y el footer -->
    <script>
        // Utilizando fetch para cargar el contenido de templates/header.php y templates/footer.html
        document.addEventListener("DOMContentLoaded", function () {
            fetch('templates/header.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('header-placeholder').innerHTML = data;
                });

            fetch('templates/footer.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('footer-placeholder').innerHTML = data;
                });
        });
    </script>
</body>

</html>
