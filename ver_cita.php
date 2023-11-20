<!DOCTYPE html>
<html>
<head>
    <title>Ver Cita</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
</head>
<body>
    <h1>Información de la Cita</h1>

    <?php
    session_start();
    // Conexión a la base de datos 
    $server = "localhost";
    $user = "root";
    $password = "";
    $dataBase = "veterinaria_db";
    //1. Establecer la conexion mysqli
    $conexion = mysqli_connect($server, $user, $password, $dataBase);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id_cita = $_GET["id_cita"];  // Debes pasar el ID de la cita a través de la URL

    $sql = "SELECT * FROM citas WHERE id_citas = $id_cita";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        echo "<p><strong>Nombre de la Mascota:</strong> " . $row["nombre_mascota"] . "</p>";
        echo "<p><strong>Nombre del Dueño:</strong> " . $row["nombre_duenno"] . "</p>";
        echo "<p><strong>Descripción:</strong> " . $row["descripcion"] . "</p>";
        echo "<p><strong>Imagen de la Mascota:</strong> <img src='" . $row["ruta_imagen"] . "' alt='Imagen de la Mascota'></p>";
    } else {
        echo "Cita no encontrada.";
    }

    $conexion->close();
    ?>
</body>
</html>
