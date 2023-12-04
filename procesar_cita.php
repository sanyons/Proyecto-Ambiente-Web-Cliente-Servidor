<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar los datos del formulario
    $nombre_mascota = $_POST["nombre_mascota"];
    $nombre_duenno = $_POST["nombre_duenno"];
    $descripcion = $_POST["descripcion"];
    $ruta_imagen = "";

    // Verificar si se ha cargado una imagen
    if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
        // Establece la ubicación donde se guardará la imagen
        $ruta_imagen = "uploads/" . $_FILES["ruta_imagen"]["name"];

        // Mueve la imagen al directorio de destino
        move_uploaded_file($_FILES["ruta_imagen"]["tmp_name"], $ruta_imagen);
    }

    $fecha_cita = $_POST["fecha_cita"];
    $estado = 1; // Puedes ajustar esto según tus necesidades
    $activo = 1; // Puedes ajustar esto según tus necesidades

    // Conexión a la base de datos 
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

    // Consulta SQL para insertar una nueva cita
    $sql = "INSERT INTO citas (nombre_mascota, nombre_duenno, descripcion, ruta_imagen, fecha_cita, estado, activo)
            VALUES ('$nombre_mascota', '$nombre_duenno', '$descripcion', '$ruta_imagen', '$fecha_cita', $estado, $activo)";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Cita creada exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al crear la cita: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a cita.php después de procesar el formulario
    echo '<script>window.location.href = "cita.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
