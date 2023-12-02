<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recopilar el ID del producto a eliminar
    $id_producto = isset($_GET["id"]) ? $_GET["id"] : '';

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

    // Consulta SQL para eliminar un producto por ID
    $sql = "DELETE FROM producto WHERE id_producto = '$id_producto'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Producto eliminado exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al eliminar el producto: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a producto.php después de eliminar el producto
    echo '<script>window.location.href = "producto.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
