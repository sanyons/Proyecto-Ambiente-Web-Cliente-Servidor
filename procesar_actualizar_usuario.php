
<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $username = $_POST["username"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $ruta_imagen = $_POST["ruta_imagen"];
 
     // Verificar si se ha cargado una imagen
     if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
         // Establece la ubicación donde se guardará la imagen
         $ruta_imagen = "uploads/" . $_FILES["ruta_imagen"]["name"];
 
         // Mueve la imagen al directorio de destino
         move_uploaded_file($_FILES["ruta_imagen"]["tmp_name"], $ruta_imagen);
     }
    // Otros campos del formulario

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

    // Consulta SQL para actualizar el usuario
    if ($accion === "Actualizar Usuario") {
        $sql = "UPDATE usuario SET 
        nombre = '$nombre', 
        apellidos = '$apellidos',
        username = '$username',
        correo = '$correo',
        telefono = '$telefono',
        ruta_imagen = '$ruta_imagen' WHERE id_usuario = $id_usuario";
    }

    // Ejecutar la consulta solo si la acción es "Actualizar Usuario"
    if ($accion === "Actualizar Usuario" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Usuario actualizado exitosamente.");</script>';
    } elseif ($accion === "Actualizar Usuario") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar el usuario: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a usuario.php después de procesar el formulario
    echo '<script>window.location.href = "usuario.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
