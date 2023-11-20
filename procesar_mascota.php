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

// Recopilar datos del formulario
$nombre_mascota = $_POST["nombre_mascota"];
$especie = $_POST["especie"];
$sexo = $_POST["sexo"];
$id_usuario = $_SESSION["id_usuario"];  // Asume que tienes almacenado el ID del usuario en la sesión

// Manejar la carga de la imagen
$ruta_imagen = "";
if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] == UPLOAD_ERR_OK) {
    $nombre_temporal = $_FILES["ruta_imagen"]["tmp_name"];
    $nombre_archivo = $_FILES["ruta_imagen"]["name"];
    $ruta_imagen = "carpeta_destino/" . $nombre_archivo;  // Cambia "carpeta_destino" a la carpeta donde deseas almacenar las imágenes

    if (move_uploaded_file($nombre_temporal, $ruta_imagen)) {
        echo "Imagen subida con éxito.";
    } else {
        echo "Error al subir la imagen.";
    }
}

// Insertar la mascota en la base de datos
$sqlMascota = "INSERT INTO mascota (nombre, especie, sexo, ruta_imagen, activo, id_usuario)
              VALUES ('$nombre_mascota', '$especie', '$sexo', '$ruta_imagen', 1, $id_usuario)";

if ($conexion->query($sqlMascota) === TRUE) {
    echo "Mascota creada exitosamente.";
} else {
    echo "Error al crear la mascota: " . $conexion->error;
}

$conexion->close();
?>