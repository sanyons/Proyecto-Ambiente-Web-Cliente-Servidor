<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Categoría</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <h1>Actualizar Categoría</h1>

    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID de la categoría a actualizar
        $id_categoria = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información de la categoría desde la base de datos según el ID
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

        // Consulta SQL para obtener información de la categoría
        $sql = "SELECT * FROM categoria WHERE id_categoria = '$id_categoria'";
        $result = mysqli_query($conexion, $sql);

        // Verificar si se obtuvieron resultados
        if ($result) {
            // Mostrar el formulario de actualización con la información de la categoría
            $row = mysqli_fetch_assoc($result);
    ?>
            <form method="POST" action="procesar_actualizar_categoria.php" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="Actualizar Categoría">
                <input type="hidden" name="id_categoria" value="<?php echo $row['id_categoria']; ?>">

                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>" required><br>

                <label for="ruta_imagen">Imagen de perfil:</label>
                <input type="file" name="ruta_imagen"><br><br>
                <?php
                // Verificar si hay una ruta de imagen en la base de datos
                if (!empty($row['ruta_imagen'])) {
                    echo '<label>Imagen actual:</label>';
                    echo '<img src="' . $row['ruta_imagen'] . '" alt="Imagen de perfil" width="100"><br>';
                }
                ?>

                <label for="activo">Activo:</label>
                <input type="checkbox" name="activo" <?php echo $row['activo'] == 1 ? 'checked' : ''; ?>><br>
                <br>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información de la categoría.";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Acceso no válido.";
    }
    ?>

    <!-- Script para cargar el header y el footer -->
    <script>
        // Utilizando fetch para cargar el contenido de templates/header.html y templates/footer.html
        fetch('templates/header.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-placeholder').innerHTML = data;
            });
    </script>
</body>

</html>
