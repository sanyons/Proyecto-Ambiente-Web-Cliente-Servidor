<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recopilar el ID de la cita a eliminar
    $id_cita = isset($_GET["id"]) ? $_GET["id"] : '';

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

    // Consulta SQL para eliminar una cita por ID
    $sql = "DELETE FROM citas WHERE id_citas = '$id_cita'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Cita eliminada exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al eliminar la cita: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a cita.php después de eliminar la cita
    echo '<script>window.location.href = "cita.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>