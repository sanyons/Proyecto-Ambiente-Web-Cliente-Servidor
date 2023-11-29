<?php
session_start();

// Conexión a la base de datos
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";

// Establecer la conexión mysqli
$conexion = mysqli_connect($server, $user, $password, $dataBase);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// // Verificar si la sesión está iniciada
// if (!isset($_SESSION["id_usuario"])) {
//     // Manejar la falta de sesión de alguna manera (redirigir a la página de inicio de sesión, por ejemplo)
//     echo "Error: La sesión no está iniciada.";
//     exit();
// }
// // Recopilar datos del formulario y escaparlos para prevenir inyección de SQL
// $nombre_mascota = mysqli_real_escape_string($conexion, $_POST["nombre_mascota"]);
// $nombre_duenno = mysqli_real_escape_string($conexion, $_POST["nombre_duenno"]);
// $descripcion = mysqli_real_escape_string($conexion, $_POST["descripcion"]);
// $id_usuario = mysqli_real_escape_string($conexion, $_SESSION["id_usuario"]);
// $id_horario = mysqli_real_escape_string($conexion, $_POST["horario_disponible"]);

// Manejar la carga de archivos
$ruta_imagen = ""; // Inicializa la variable en caso de que no se haya subido ninguna imagen

if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] == UPLOAD_ERR_OK) {
    $ruta_imagen = mysqli_real_escape_string($conexion, $_FILES["ruta_imagen"]["name"]);
    // También puedes mover el archivo a una ubicación específica en tu servidor aquí si es necesario
}

// Insertar la cita en la base de datos con el id_horario
$sql = "INSERT INTO citas (nombre_mascota, nombre_duenno, descripcion, ruta_imagen, estado, activo, id_usuario, id_horario)
        VALUES ('$nombre_mascota', '$nombre_duenno', '$descripcion', '$ruta_imagen', 1, 1, $id_usuario, $id_horario)";

if ($conexion->query($sql) === TRUE) {
    echo "Cita creada exitosamente.";
} else {
    echo "Error al crear la cita: " . $conexion->error;
}

$conexion->close();
?>
