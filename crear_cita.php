<?php
// Establecer la conexión mysqli
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";

// Reabrir la conexión a la base de datos
$conn = new mysqli($server, $user, $password, $dataBase);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta para obtener nombres de mascotas
$sqlMascotas = "SELECT id_mascota, nombre FROM mascota WHERE activo = 1";
$resultMascotas = $conn->query($sqlMascotas);

// Consulta para obtener nombres de dueños
$sqlDueños = "SELECT id_usuario, nombre FROM usuario WHERE activo = 1";
$resultDueños = $conn->query($sqlDueños);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agendar Cita</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
</head>

<body>
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>

    <section>
        <h1>Agendar Cita</h1>
        <!-- Formulario para agendar una nueva cita -->
        <form method="POST" action="procesar_cita.php" enctype="multipart/form-data">

            <label for="nombre_mascota">Nombre de la Mascota:</label>
            <select name="nombre_mascota" required>
                <?php while ($rowMascota = $resultMascotas->fetch_assoc()) : ?>
                    <option value="<?php echo $rowMascota['id_mascota']; ?>"><?php echo $rowMascota['nombre']; ?></option>
                <?php endwhile; ?>
            </select><br>

            <label for="nombre_duenno">Nombre del Dueño:</label>
            <select name="nombre_duenno" required>
                <?php while ($rowDueño = $resultDueños->fetch_assoc()) : ?>
                    <option value="<?php echo $rowDueño['id_usuario']; ?>"><?php echo $rowDueño['nombre']; ?></option>
                <?php endwhile; ?>
            </select><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required></textarea><br>

            <label for="ruta_imagen">Imagen de la padencia:</label>
            <input type="file" name="ruta_imagen"><br>

            <label for="fecha_cita" class="form-label">Fecha de la cita:</label>
            <input type="datetime-local" id="fecha_cita" name="fecha_cita" class="form-control" required>

            <br>
            <br>
            <input type="submit" value="Agendar Cita">
        </form>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <script>
        // Utilizando fetch para cargar el contenido de templates/header.html y templates/footer.html
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
    </script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
