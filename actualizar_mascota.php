<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Mascota</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <h1>Actualizar Mascota</h1>

    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID de la mascota a actualizar
        $id_mascota = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información de la mascota desde la base de datos según el ID
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

        // Consulta SQL para obtener información de la mascota
        $sqlMascota = "SELECT * FROM mascota WHERE id_mascota = '$id_mascota'";
        $resultMascota = mysqli_query($conexion, $sqlMascota);

        // Consulta SQL para obtener la lista de usuarios
        $sqlUsuarios = "SELECT id_usuario, username FROM usuario";
        $resultUsuarios = mysqli_query($conexion, $sqlUsuarios);

        // Verificar si se obtuvieron resultados
        if ($resultMascota && $resultUsuarios) {
            // Mostrar el formulario de actualización con la información de la mascota
            $rowMascota = mysqli_fetch_assoc($resultMascota);
    ?>
            <form method="POST" action="procesar_actualizar_mascota.php" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="Actualizar Mascota">
                <input type="hidden" name="id_mascota" value="<?php echo $rowMascota['id_mascota']; ?>">

                <label for="nombre">Nombre de la Mascota:</label>
                <input type="text" name="nombre" value="<?php echo $rowMascota['nombre']; ?>" required><br>

                <label for="especie">Especie:</label>
                <input type="text" name="especie" value="<?php echo $rowMascota['especie']; ?>" required><br>

                <label for="sexo">Sexo:</label>
                <input type="text" name="sexo" value="<?php echo $rowMascota['sexo']; ?>" required><br>

                <label for="ruta_imagen">Imagen:</label>
                <input type="file" name="ruta_imagen"><br>
                <?php
                // Verificar si hay una ruta de imagen en la base de datos
                if (!empty($rowMascota['ruta_imagen'])) {
                    echo '<label>Imagen actual:</label>';
                    echo '<img src="' . $rowMascota['ruta_imagen'] . '" alt="Imagen de perfil" width="100"><br>';
                }
                ?>

                <label for="activo">Activo:</label>
                <input type="checkbox" name="activo" <?php echo $rowMascota['activo'] ? 'checked' : ''; ?>><br>

                <label for="id_usuario">Dueño:</label>
                <select name="id_usuario" required>
                    <?php
                    // Mostrar opciones del dropdown con los usuarios
                    while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                        $selected = ($rowUsuario['id_usuario'] == $rowMascota['id_usuario']) ? 'selected' : '';
                        echo "<option value='{$rowUsuario['id_usuario']}' $selected>{$rowUsuario['username']}</option>";
                    }
                    ?>
                </select><br>

                <br>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información de la mascota o la lista de usuarios.";
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
        document.addEventListener("DOMContentLoaded", function () {
            fetch('templates/header.html')
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
