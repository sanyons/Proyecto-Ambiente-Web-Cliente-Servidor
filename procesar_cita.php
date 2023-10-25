<?php
session_start();
// Conexión a la base de datos 
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";
//1. Establecer la conexion mysqli
$conexion = mysqli_connect($server, $user, $password, $dataBase);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recopilar datos del formulario
$nombre_mascota = $_POST["nombre_mascota"];
$nombre_duenno = $_POST["nombre_duenno"];
$descripcion = $_POST["descripcion"];
$ruta_imagen = $_FILES["ruta_imagen"]["name"];
$id_usuario = $_POST["id_usuario"];  // Deberás proporcionar el id del usuario propietario de la mascota
$id_horario = $_POST["horario_disponible"];  // Recupera el id del horario seleccionado

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


