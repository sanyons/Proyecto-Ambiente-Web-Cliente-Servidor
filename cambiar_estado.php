<?php
session_start();

// Verificar si se ha recibido un ID de cita
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cita = $_GET['id'];

    
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

    // Consulta para obtener el estado actual de la cita
    $consulta_estado = "SELECT estado FROM citas WHERE id_citas = $id_cita";
    $resultado = $conexion->query($consulta_estado);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        $estado_actual = $fila['estado'];

        // Cambiar el estado (activar o desactivar)
        $nuevo_estado = $estado_actual ? 0 : 1;

        // Actualizar el estado en la base de datos
        $actualizar_estado = "UPDATE citas SET estado = $nuevo_estado WHERE id_citas = $id_cita";
        if ($conexion->query($actualizar_estado) === TRUE) {
            echo "Estado de la cita actualizado correctamente.";
        } else {
            echo "Error al actualizar el estado de la cita: " . $conexion->error;
        }
    } else {
        echo "Cita no encontrada.";
    }

    $conexion->close();
} else {
    echo "ID de cita no válido.";
}
?>
