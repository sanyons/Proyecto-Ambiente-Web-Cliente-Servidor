<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar la acción del formulario
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    // Recopilar los datos del formulario
    $id_producto = $_POST["id_producto"];
    $descripcion = $_POST["descripcion"];
    $detalle = $_POST["detalle"];
    $precio = $_POST["precio"];
    $existencias = $_POST["existencias"];
    $ruta_imagen = "";
    $activo = isset($_POST["activo"]) ? 1 : 0;
    $id_categoria = $_POST["id_categoria"];

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

    // Consulta SQL para actualizar el producto
    if ($ruta_imagen !== "") {
        // Si se ha cargado una nueva imagen
        $sql = "UPDATE producto SET 
        descripcion = '$descripcion', 
        detalle = '$detalle',
        precio = '$precio',
        existencias = '$existencias',
        ruta_imagen = '$ruta_imagen',
        activo = $activo,
        id_categoria = $id_categoria
        WHERE id_producto = $id_producto";
    } else {
        // Si no se ha cargado una nueva imagen
        $sql = "UPDATE producto SET 
        descripcion = '$descripcion', 
        detalle = '$detalle',
        precio = '$precio',
        existencias = '$existencias',
        activo = $activo,
        id_categoria = $id_categoria
        WHERE id_producto = $id_producto";
    }

    // Ejecutar la consulta solo si la acción es "Actualizar Producto"
    if ($accion === "Actualizar Producto" && mysqli_query($conexion, $sql)) {
        // Mostrar mensaje de éxito con JavaScript
        echo '<script>alert("Producto actualizado exitosamente.");</script>';
    } elseif ($accion === "Actualizar Producto") {
        // Mostrar mensaje de error con JavaScript
        echo '<script>alert("Error al actualizar el producto: ' . mysqli_error($conexion) . '");</script>';
    }

    // Redirigir a producto.php después de procesar el formulario
    echo '<script>window.location.href = "producto.php";</script>';

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no válido.";
}
?>
