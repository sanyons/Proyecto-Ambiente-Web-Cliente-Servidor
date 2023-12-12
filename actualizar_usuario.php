<!DOCTYPE html>
<html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
    <!-- Bootstrap header-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>Actualizar Usuario</h1>
    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID del usuario a eliminar
        $id_usuario = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información del usuario desde la base de datos según el ID
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

        // Consulta SQL para obtener información del usuario
        $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
        $result = mysqli_query($conexion, $sql);

        // Verificar si se obtuvieron resultados
        if ($result) {
            // Mostrar el formulario de actualización con la información del usuario
            $row = mysqli_fetch_assoc($result);
    ?>
            <form method="POST" action="procesar_actualizar_usuario.php" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="Actualizar Usuario">
                <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>

                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required><br>

                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>


                <label for="correo">Correo:</label>
                <input type="email" name="correo" value="<?php echo $row['correo']; ?>" required><br>

                <label for="telefono">Teléfono:</label>
                <input type="tel" name="telefono" value="<?php echo $row['telefono']; ?>" required><br>

                <label for="ruta_imagen">Imagen de perfil:</label>
                <input type="file" name="ruta_imagen"><br><br>
                <?php
                // Verificar si hay una ruta de imagen en la base de datos
                if (!empty($row['ruta_imagen'])) {
                    echo '<label>Imagen actual:</label>';
                    echo '<img src="' . $row['ruta_imagen'] . '" alt="Imagen de perfil" width="100"><br>';
                }
                ?>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información del usuario.";
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
    </script>
</body>

</html>