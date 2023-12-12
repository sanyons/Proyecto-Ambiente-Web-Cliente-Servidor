<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_cita = $_POST["id_cita"];
    $nombre_mascota = $_POST["nombre_mascota"];
    $nombre_duenno = $_POST["nombre_duenno"];
    $descripcion = $_POST["descripcion"];
    $estado = isset($_POST["estado"]) ? 1 : 0;
    $fecha_cita = date("Y-m-d H:i:s", strtotime($_POST["fecha_cita"]));

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

    // Verificar si se ha cargado una nueva imagen
    if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
        // Establece la ubicación donde se guardará la imagen
        $ruta_imagen = "uploads/" . $_FILES["ruta_imagen"]["name"];

        // Mueve la imagen al directorio de destino
        move_uploaded_file($_FILES["ruta_imagen"]["tmp_name"], $ruta_imagen);

        // Consulta SQL para actualizar la cita con nueva imagen
        $sql = "UPDATE citas SET 
        nombre_mascota = '$nombre_mascota', 
        nombre_duenno = '$nombre_duenno',
        descripcion = '$descripcion',
        ruta_imagen = '$ruta_imagen',
        estado = '$estado',
        fecha_cita = '$fecha_cita'
        WHERE id_citas = $id_cita";
    } else {
        $sql = "UPDATE citas SET 
        nombre_mascota = '$nombre_mascota', 
        nombre_duenno = '$nombre_duenno',
        descripcion = '$descripcion',
        estado = '$estado',
        fecha_cita = '$fecha_cita'
        WHERE id_citas = $id_cita";
    }

    // Ejecutar la consulta solo si la acción es "Actualizar Cita"
    if ($accion === "Actualizar Cita" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Cita actualizada exitosamente.");</script>';
    } elseif ($accion === "Actualizar Cita") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar la cita: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a cita.php después de procesar el formulario
    echo '<script>window.location.href = "cita.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
