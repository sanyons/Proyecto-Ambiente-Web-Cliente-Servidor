<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_expediente = $_POST["id_expediente"];
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

    // Consulta SQL para actualizar el expediente médico
    if ($accion === "Actualizar Expediente") {
        $sql = "UPDATE expediente SET 
        nombre_mascota = '$nombre_mascota', 
        veterinario = '$veterinario',
        padecimiento = '$padecimiento',
        presion = '$presion',
        pulso = '$pulso',
        temperatura = '$temperatura',
        peso = '$peso',
        talla = '$talla',
        edad = '$edad'
        WHERE id_expediente = $id_expediente";

    }

    // Ejecutar la consulta solo si la acción es "Actualizar Expediente"
    if ($accion === "Actualizar Expediente" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Expediente médico actualizado exitosamente.");</script>';
    } elseif ($accion === "Actualizar Expediente") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar el expediente médico: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a expediente.php después de procesar el formulario
    echo '<script>window.location.href = "expediente.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
