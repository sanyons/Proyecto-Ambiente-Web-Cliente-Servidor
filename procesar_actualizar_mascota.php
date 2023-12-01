<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_mascota = $_POST["id_mascota"];
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $sexo = $_POST["sexo"];
    $ruta_imagen = "";
    $activo = isset($_POST["activo"]) ? 1 : 0;
    $id_usuario = $_POST["id_usuario"];

    // Verificar si se ha cargado una nueva imagen
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

    // Establecer la conexión mysqli
    $conexion = mysqli_connect($server, $user, $password, $dataBase);

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para actualizar la mascota
    if ($ruta_imagen !== "") {
        // Si se ha cargado una nueva imagen
        $sql = "UPDATE mascota SET 
        nombre = '$nombre', 
        especie = '$especie',
        sexo = '$sexo',
        ruta_imagen = '$ruta_imagen',
        activo = $activo,
        id_usuario = $id_usuario
        WHERE id_mascota = $id_mascota";
    } else {
        // Si no se ha cargado una nueva imagen
        $sql = "UPDATE mascota SET 
        nombre = '$nombre', 
        especie = '$especie',
        sexo = '$sexo',
        activo = $activo,
        id_usuario = $id_usuario
        WHERE id_mascota = $id_mascota";
    }

    // Ejecutar la consulta solo si la acción es "Actualizar Mascota"
    if ($accion === "Actualizar Mascota" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Mascota actualizada exitosamente.");</script>';
    } elseif ($accion === "Actualizar Mascota") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar la mascota: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a mascota.php después de procesar el formulario
    echo '<script>window.location.href = "mascota.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
