<?php
 session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $username = $_POST["username"];
    $contrasena = $_POST["password"];
    // Aplicar hash a la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $ruta_imagen = $_FILES["ruta_imagen"]["name"];


    
    // Inicializar la variable $ruta_imagen
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
 //1. Establecer la conexion mysqli
 $conexion = mysqli_connect($server, $user, $password, $dataBase);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO usuario (nombre, apellidos, username, password, correo, telefono, ruta_imagen, activo)
        VALUES ('$nombre', '$apellidos', '$username', '$hashed_password', '$correo', '$telefono', '$ruta_imagen', 1)";


    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear el usuario: " . $conexion->error;
    }

    // Acción: Actualizar Usuario
if ($_POST["accion"] === "Actualizar Usuario") {
    // Redirige al archivo de actualización de usuario
    header("Location: crear_usuario.php");
}

// Acción: Eliminar Usuario
if ($_POST["accion"] === "Eliminar Usuario") {
    // Redirige al archivo de eliminación de usuario
    header("Location: eliminar_usuario.php");
}


    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    echo "Acceso no válido.";
}

?>

