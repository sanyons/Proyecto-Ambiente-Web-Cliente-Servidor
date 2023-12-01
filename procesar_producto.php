<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $descripcion = $_POST["descripcion"];
    $detalle = $_POST["detalle"];
    $precio = $_POST["precio"];
    $existencias = $_POST["existencias"];
    $id_categoria = $_POST["id_categoria"];
    $ruta_imagen = "";
    $activo = isset($_POST["activo"]) ? 1 : 0;

    // Verificar si se ha cargado una imagen
    if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
        // Establecer la ubicación donde se guardará la imagen
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

    // Consulta SQL para insertar un nuevo producto
    $sql = "INSERT INTO producto (id_categoria, descripcion, detalle, precio, existencias, ruta_imagen, activo)
            VALUES ('$id_categoria', '$descripcion', '$detalle', '$precio', '$existencias', '$ruta_imagen', '$activo')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Producto creado exitosamente.");</script>';
    } else {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al crear el producto: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a producto.php después de procesar el formulario
    echo '<script>window.location.href = "producto.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
