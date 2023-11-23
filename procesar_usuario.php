<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $username = $_POST["username"];
    $contrasena = $_POST["password"];
    // Aplicar hash a la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $ruta_imagen = "";

    // Verificar si se ha cargado una imagen
    if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
        // Establece la ubicación donde se guardará la imagen
        $ruta_imagen = "uploads/" . $_FILES["ruta_imagen"]["name"];

        // Mueve la imagen al directorio de destino
        move_uploaded_file($_FILES["ruta_imagen"]["tmp_name"], $ruta_imagen);
    }

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

    // Consulta SQL para insertar un nuevo usuario
    if ($accion === "Crear Usuario") {
        $sql = "INSERT INTO usuario (nombre, apellidos, username, password, correo, telefono, ruta_imagen, activo)
            VALUES ('$nombre', '$apellidos', '$username', '$hashed_password', '$correo', '$telefono', '$ruta_imagen', 1)";
    }

    // Ejecutar la consulta solo si la acción es "Crear Usuario"
    if ($accion === "Crear Usuario" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Usuario creado exitosamente.");</script>';
    } elseif ($accion === "Crear Usuario") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al crear el usuario: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a usuario.php después de procesar el formulario
    echo '<script>window.location.href = "usuario.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
