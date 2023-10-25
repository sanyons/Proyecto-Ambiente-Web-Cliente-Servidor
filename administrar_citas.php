<!DOCTYPE html>
<html>
<head>
    <title>Administrar Citas</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    
</head>
<body>
    <h1>Administrar Citas</h1>

    <h2>Listado de Citas</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre de la Mascota</th>
            <th>Nombre del Dueño</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>

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

        // Consulta para obtener las citas
        $sql = "SELECT id_citas, nombre_mascota, nombre_duenno, descripcion, estado FROM citas";

        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_citas'] . "</td>";
                echo "<td>" . $row['nombre_mascota'] . "</td>";
                echo "<td>" . $row['nombre_duenno'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . ($row['estado'] ? "Activa" : "Inactiva") . "</td>";
                echo "<td><a href='cambiar_estado.php?id=" . $row['id_citas'] . "'>Cambiar Estado</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay citas disponibles.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>
</body>
</html>
