<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cita</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <h1>Actualizar Cita</h1>

    <?php
    session_start();

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recopilar el ID de la cita a actualizar
        $id_cita = isset($_GET["id"]) ? $_GET["id"] : '';

        // Obtener información de la cita desde la base de datos según el ID
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

        // Consulta SQL para obtener información de la cita
        $sqlCita = "SELECT * FROM citas WHERE id_citas = '$id_cita'";
        $resultCita = mysqli_query($conexion, $sqlCita);

        // Consulta SQL para obtener la lista de mascotas y dueños
        $sqlMascotas = "SELECT id_mascota, nombre FROM mascota";
        $resultMascotas = mysqli_query($conexion, $sqlMascotas);

        $sqlDuenos = "SELECT id_usuario, nombre FROM usuario";
        $resultDuenos = mysqli_query($conexion, $sqlDuenos);

        // Verificar si se obtuvieron resultados
        if ($resultCita && $resultMascotas && $resultDuenos) {
            // Mostrar el formulario de actualización con la información de la cita
            $rowCita = mysqli_fetch_assoc($resultCita);
    ?>
            <form method="POST" action="procesar_actualizar_cita.php" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="Actualizar Cita">
                <input type="hidden" name="id_cita" value="<?php echo $rowCita['id_citas']; ?>">

                <label for="nombre_mascota">Nombre de la Mascota:</label>
                <select name="nombre_mascota" required>
                <?php
                // Mostrar opciones del dropdown con las mascotas
                while ($rowMascota = mysqli_fetch_assoc($resultMascotas)) {
                     $selected = ($rowMascota['id_mascota'] == $rowCita['id_mascota']) ? 'selected' : '';
                     echo "<option value='{$rowMascota['nombre']}' $selected>{$rowMascota['nombre']}</option>";
                }
                ?>
            </select><br>

                <label for="nombre_duenno">Nombre del Dueño:</label>
                <select name="nombre_duenno" required>
                <?php
                // Mostrar opciones del dropdown con los dueños
                while ($rowDueno = mysqli_fetch_assoc($resultDuenos)) {
                    $selected = ($rowDueno['id_usuario'] == $rowCita['id_usuario']) ? 'selected' : '';
                    echo "<option value='{$rowDueno['nombre']}' $selected>{$rowDueno['nombre']}</option>";
                }
                ?>
            </select><br>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" required><?php echo $rowCita['descripcion']; ?></textarea><br>

                <label for="ruta_imagen">Imagen de la padencia:</label>
                <input type="file" name="ruta_imagen"><br>

                <label for="fecha_cita" class="form-label">Fecha de la cita:</label>
                <input type="datetime-local" name="fecha_cita" value="<?php echo date('Y-m-d\TH:i', strtotime($rowCita['fecha_cita'])); ?>" required><br>

                <label for="estado">Estado:</label>
                <input type="checkbox" name="estado" <?php echo $rowCita['estado'] == 1 ? 'checked' : ''; ?>><br>
                <br>

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "Error al obtener la información de la cita, mascotas o dueños.";
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
        });
    </script>
</body>

</html>
