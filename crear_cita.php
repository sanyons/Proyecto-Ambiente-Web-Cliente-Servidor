<!DOCTYPE html>
<html>
<head>
    <title>Agendar Cita</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
      <!-- Incluir el header -->
</head>

    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>

<body>

  

    <h1>Agendar Cita</h1>
    <form method="POST" action="procesar_cita.php">
        <label for="nombre_mascota">Nombre de la Mascota:</label>
        <input type="text" name="nombre_mascota" required><br>

        <label for="nombre_duenno">Nombre del Dueño:</label>
        <input type="text" name= "nombre_duenno" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea><br>

        <label for="ruta_imagen">Imagen de la Mascota:</label>
        <input type="file" name="ruta_imagen"><br>

        <!-- <label for="horario_disponible">Seleccionar Horario:</label>
        <select  name="horario_disponible" required> -->
       
        <label for="horario_disponible">Seleccionar Horario:</label>
        <select name="horario_disponible" required>
        <?php
date_default_timezone_set('America/Costa_Rica');
session_start();

// Conexión a la base de datos 
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";

// Establecer la conexión mysqli
$conexion = mysqli_connect($server, $user, $password, $dataBase);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Obtener el día de la semana actual
$dia_semana_actual = strtolower(date('l')); // Convertir a minúsculas

// Obtener la hora actual
$hora_actual = date('H:i:s');

// Consultar los horarios disponibles para el día actual y con hora de inicio posterior a la hora actual
$sql = "SELECT id_horario, hora_inicio, hora_fin
        FROM horarios_disponibles
        WHERE dia_semana = '$dia_semana_actual' 
        AND activo = 1
        AND STR_TO_DATE(CONCAT(CURDATE(), ' ', hora_inicio), '%Y-%m-%d %H:%i:%s') > STR_TO_DATE('$hora_actual', '%H:%i:%s')";

$result = $conexion->query($sql);

// Imprimir errores de la consulta
if (!$result) {
    echo "Error en la consulta: " . $conexion->error;
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_horario'] . "'>" . $row['hora_inicio'] . " - " . $row['hora_fin'] . "</option>";
    }
} else {
    echo "<option value='' disabled> No hay horarios disponibles para hoy.</option>";
}

$conexion->close();
?>

</select>
        <br>
        <br>
        <input type="submit" value="Agendar Cita">
       
    </form>

   

</body>

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
</html>
