<?php
// Tu código de conexión a la base de datos aquí
$conexion = mysqli_connect("localhost", "root", "", "veterinaria_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el ID de la mascota a eliminar
$idMascota = $_POST['id']; // Asegúrate de validar y sanitizar esta entrada

// Query para eliminar la mascota
$query = "DELETE FROM mascota WHERE id_mascota = $idMascota";

// Ejecutar la consulta
$result = mysqli_query($conexion, $query);

// Verificar si la eliminación fue exitosa
if ($result) {
    $response = ['success' => true];
} else {
    $response = ['success' => false];
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>