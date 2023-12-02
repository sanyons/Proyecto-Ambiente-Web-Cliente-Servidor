<?php
session_start();

// Comprobar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $sexo = $_POST["sexo"];
    $ruta_imagen = "";
    $activo = isset($_POST["activo"]) ? 1 : 0;
    $id_usuario = $_POST["id_usuario"];

    // Verificar si se ha cargado una imagen
    if (isset($_FILES["ruta_imagen"]) && $_FILES["ruta_imagen"]["error"] === 0) {
        // Establecer la ubicación donde se guardará la imagen
        $ruta_imagen = "uploads/" . $_FILES["ruta_imagen"]["name"];

        // Mueve la imagen al directorio de destino
        if (move_uploaded_file($_FILES["ruta_imagen"]["tmp_name"], $ruta_imagen)) {
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

            // Consulta SQL para verificar si el usuario existe
            $sqlUsuario = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
            $resultUsuario = mysqli_query($conexion, $sqlUsuario);

            // Verificar si el usuario existe
            if (mysqli_num_rows($resultUsuario) > 0) {
                // Consulta SQL para insertar una nueva mascota
                $sql = "INSERT INTO mascota (nombre, especie, sexo, ruta_imagen, activo, id_usuario)
                        VALUES ('$nombre', '$especie', '$sexo', '$ruta_imagen', $activo, $id_usuario)";

                // Ejecutar la consulta
                if (mysqli_query($conexion, $sql)) {
                    // Mostrar mensaje de éxito con JavaScript
                    echo '<script>alert("Mascota creada exitosamente.");</script>';
                } else {
                    // Mostrar mensaje de error con JavaScript
                    echo '<script>alert("Error al crear la mascota: ' . mysqli_error($conexion) . '");</script>';
                }

                // Redirigir a mascota.php después de procesar el formulario
                echo '<script>window.location.href = "mascota.php";</script>';
            } else {
                // El usuario no existe
                echo '<script>alert("Error: El usuario seleccionado no existe.");</script>';
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            // Error al mover la imagen
            echo '<script>alert("Error al mover la imagen.");</script>';
        }
    } else {
        // No se cargó una imagen
        echo '<script>alert("No se ha cargado una imagen.");</script>';
    }
} else {
    echo "Acceso no válido.";
}
?>
