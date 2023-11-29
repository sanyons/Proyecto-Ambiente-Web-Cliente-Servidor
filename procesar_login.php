<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $server = "localhost";
    $user = "root";
    $password = "";
    $dataBase = "veterinaria_db";

    $conn = new mysqli($server, $user, $password, $dataBase);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Utilizar sentencias preparadas para prevenir inyección de SQL
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $username;
        header("Location: inicio_exitoso.php");
        exit(); // Asegurarse de salir después de redirigir
    } else {
        // Error en las credenciales
        header("Location: login.php?error=true");
        exit(); // Asegurarse de salir después de redirigir
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
} else {
    // Acceso directo al script, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit(); // Asegurarse de salir después de redirigir
}
?>
