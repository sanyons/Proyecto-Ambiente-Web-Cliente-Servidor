<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recopilar el ID de la categoría a eliminar
    $id_categoria = isset($_GET["id"]) ? $_GET["id"] : '';

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

    // Consulta SQL para eliminar una categoría por ID
    $sql = "DELETE FROM categoria WHERE id_categoria = '$id_categoria'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Categoría eliminada exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al eliminar la categoría: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a categoria.php después de eliminar la categoría
    echo '<script>window.location.href = "categoria.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
