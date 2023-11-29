<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Expediente Médico</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <h1>Actualizar Expediente Médico</h1>

    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID del expediente a actualizar
        $id_expediente = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información del expediente desde la base de datos según el ID
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

        // Consulta SQL para obtener información del expediente
        $sql = "SELECT * FROM expediente WHERE id_expediente = '$id_expediente'";
        $result = mysqli_query($conexion, $sql);

        // Verificar si se obtuvieron resultados
        if ($result) {
            // Mostrar el formulario de actualización con la información del expediente
            $row = mysqli_fetch_assoc($result);
    ?>
            <form method="POST" action="procesar_actualizar_expediente.php">
                <input type="hidden" name="accion" value="Actualizar Expediente">
                <input type="hidden" name="id_expediente" value="<?php echo $row['id_expediente']; ?>">

                <label for="nombre_mascota">Nombre de la Mascota:</label>
                <input type="text" name="nombre_mascota" value="<?php echo $row['nombre_mascota']; ?>" required><br>

                <label for="veterinario">Veterinario:</label>
                <input type="text" name="veterinario" value="<?php echo $row['veterinario']; ?>" required><br>

                <label for="padecimiento">Padecimiento:</label>
                <input type="text" name="padecimiento" value="<?php echo $row['padecimiento']; ?>" required><br>

                <label for="presion">Presión:</label>
                <input type="number" name="presion" value="<?php echo $row['presion']; ?>" required><br>

                <label for="pulso">Pulso:</label>
                <input type="number" name="pulso" value="<?php echo $row['pulso']; ?>" required><br>

                <label for="temperatura">Temperatura:</label>
                <input type="number" name="temperatura" value="<?php echo $row['temperatura']; ?>" required><br>

                <label for="peso">Peso:</label>
                <input type="number" name="peso" value="<?php echo $row['peso']; ?>" required><br>

                <label for="talla">Talla:</label>
                <input type="number" name="talla" value="<?php echo $row['talla']; ?>" required><br>

                <label for="edad">Edad:</label>
                <input type="number" name="edad" value="<?php echo $row['edad']; ?>" required><br>
                <br>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información del expediente.";
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
