<?php
// Verificar si se proporciona un ID de expediente válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $expedienteId = $_GET['id'];

    // Conexión a la base de datos
    $server = "localhost";
    $user = "root";
    $password = "";
    $dataBase = "veterinaria_db";

    $conn = new mysqli($server, $user, $password, $dataBase);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para obtener información del expediente
    $sql = "SELECT * FROM expediente WHERE id_expediente = $expedienteId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Ejemplo: Descargar los datos como un archivo de texto
        $filename = "expediente_$expedienteId.txt";
        header('Content-Type: text/plain');
        header("Content-Disposition: attachment; filename=$filename");

        // Salida de datos
        echo "Nombre de la Mascota: " . $row['nombre_mascota'] . "\n";
        echo "Veterinario: " . $row['veterinario'] . "\n";
        echo "Edad: " . $row['edad'] . "\n";
        echo "Padecimiento: " . $row['padecimiento'] . "\n";
        echo "Temperatura: " . $row['temperatura'] . "\n";
        echo "Presión: " . $row['presion'] . "\n";
        echo "Peso: " . $row['peso'] . "\n";

    } else {
        echo "Expediente no encontrado.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "ID de expediente no válido.";
}
?>
