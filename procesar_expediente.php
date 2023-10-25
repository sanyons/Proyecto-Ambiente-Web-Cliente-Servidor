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
$veterinario = $_POST["veterinario"];
$padecimiento = $_POST["padecimiento"];
$presion = $_POST["presion"];
$pulso = $_POST["pulso"];
$temperatura = $_POST["temperatura"];
$peso = $_POST["peso"];
$talla = $_POST["talla"];
$edad = $_POST["edad"];

// Insertar el expediente médico en la base de datos
$sql = "INSERT INTO expediente (nombre_mascota, veterinario, padecimiento, presion, pulso, temperatura, peso, talla, edad, activo)
        VALUES ('$nombre_mascota', '$veterinario', '$padecimiento', $presion, $pulso, $temperatura, $peso, $talla, $edad, 1)";

if ($conexion->query($sql) === TRUE) {
    echo "Expediente médico creado exitosamente.";
} else {
    echo "Error al crear el expediente médico: " . $conexion->error;
}

$conexion->close();
?>
