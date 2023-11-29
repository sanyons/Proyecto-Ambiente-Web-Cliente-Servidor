<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Consulta SQL para insertar un nuevo expediente médico
    $sql = "INSERT INTO expediente (nombre_mascota, veterinario, padecimiento, presion, pulso, temperatura, peso, talla, edad, activo)
            VALUES ('$nombre_mascota', '$veterinario', '$padecimiento', $presion, $pulso, $temperatura, $peso, $talla, $edad, 1)";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Expediente médico creado exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al crear el expediente médico: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a ver_expedientes.php después de procesar el formulario
    echo '<script>window.location.href = "expediente.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
