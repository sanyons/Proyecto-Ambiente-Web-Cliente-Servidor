<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recopilar el ID del usuario a eliminar
    $id_usuario = isset($_GET["id"]) ? $_GET["id"] : '';

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

    // Consulta SQL para eliminar un usuario por ID
    $sql = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Usuario eliminado exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al eliminar el usuario: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a usuario.php después de eliminar el usuario
    echo '<script>window.location.href = "usuario.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
