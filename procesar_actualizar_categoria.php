<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_categoria = $_POST["id_categoria"];
    $descripcion = $_POST["descripcion"];
    $activo = isset($_POST["activo"]) ? 1 : 0;

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

        // Consulta SQL para actualizar la categoría con nueva imagen
        $sql = "UPDATE categoria SET 
        descripcion = '$descripcion', 
        ruta_imagen = '$ruta_imagen',
        activo = '$activo'
        WHERE id_categoria = $id_categoria";
    } else {
        // Consulta SQL para actualizar la categoría sin cambiar la imagen
        $sql = "UPDATE categoria SET 
        descripcion = '$descripcion', 
        activo = '$activo'
        WHERE id_categoria = $id_categoria";
    }

    // Ejecutar la consulta solo si la acción es "Actualizar Categoría"
    if ($accion === "Actualizar Categoría" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Categoría actualizada exitosamente.");</script>';
    } elseif ($accion === "Actualizar Categoría") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar la categoría: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a categoria.php después de procesar el formulario
    echo '<script>window.location.href = "categoria.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
