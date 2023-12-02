<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $server = "localhost";
    $user = "root";
    $db_password = "";
    $dataBase = "veterinaria_db";

    $conn = new mysqli($server, $user, $db_password, $dataBase);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Utilizar sentencias preparadas para prevenir inyección de SQL
    $stmt = $conn->prepare("SELECT id_usuario, username, password FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Encontrar el usuario, obtener la contraseña hash
        $stmt->bind_result($id_usuario, $db_username, $db_password_hash);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $db_password_hash)) {
            // Inicio de sesión exitoso
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['username'] = $db_username;
            
            // Redirigir a la página de inicio después del inicio de sesión exitoso con un parámetro
            header("Location: index.html?loginSuccess=true");
            exit();
        } else {
            // Error en las credenciales
            header("Location: login.php?error=true");
            exit();
        }
    } else {
        // Error en las credenciales
        header("Location: login.php?error=true");
        exit();
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
} else {
    // Acceso directo al script, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}
?>
