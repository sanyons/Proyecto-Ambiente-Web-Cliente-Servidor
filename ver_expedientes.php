<!DOCTYPE html>
<html>
<head>
    <title>Ver Expedientes Médicos</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
</head>
<body>
    <h1>Expedientes Médicos de Mascotas</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre de la Mascota</th>
                <th>Veterinario</th>
                <th>Padecimiento</th>
                <th>Presión</th>
                <th>Pulso</th>
                <th>Temperatura</th>
                <th>Peso</th>
                <th>Talla</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
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

            // Consulta para obtener los expedientes médicos
            $sql = "SELECT * FROM expediente WHERE activo = 1";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre_mascota'] . "</td>";
                    echo "<td>" . $row['veterinario'] . "</td>";
                    echo "<td>" . $row['padecimiento'] . "</td>";
                    echo "<td>" . $row['presion'] . "</td>";
                    echo "<td>" . $row['pulso'] . "</td>";
                    echo "<td>" . $row['temperatura'] . "</td>";
                    echo "<td>" . $row['peso'] . "</td>";
                    echo "<td>" . $row['talla'] . "</td>";
                    echo "<td>" . $row['edad'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay expedientes médicos disponibles.</td></tr>";
            }

            $conexion->close();
            ?>
        </tbody>
    </table>
</body>
</html>
