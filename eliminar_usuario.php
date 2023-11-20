<?php
session_start();

// Conexión a la base de datos 
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";
//1. Establecer la conexion mysqli
$conexion = mysqli_connect($server, $user, $password, $dataBase);

if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Acción: Eliminar Usuario
    if ($_POST["accion"] === "Eliminar Usuario") {
        $username_eliminar = $_POST["username_eliminar"];

        // Consulta SQL para eliminar el usuario
        $sql = "DELETE FROM usuario WHERE username = '$username_eliminar'";

        if (mysqli_query($conexion, $sql)) {
            // Redirige o muestra un mensaje de éxito
            header("Location: usuario_eliminado.php");
        } else {
            // Redirige o muestra un mensaje de error
            header("Location: error_eliminar_usuario.php");
        }
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
