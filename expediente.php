<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "veterinaria_db";

$conn = new mysqli($server, $user, $password, $dataBase);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los expedientes
$sql = "SELECT * FROM expediente";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Expediente</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>
<body>
    <section>
        <h1>Listado expediente</h1>
        <!-- Aquí va el listado de expedientes -->

        <section id="expedientes">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">Listado de Expedientes</h4>
                            </div>
                            <div>
                                <?php if ($result->num_rows > 0): ?>
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Paciente</th>
                                                <th>Padecimiento</th>
                                                <th>Veterinario</th>
                                                <th>Activo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo $row["id_expediente"]; ?></td>
                                                    <td><?php echo $row["id_mascota"]; ?></td>
                                                    <td><?php echo $row["padecimiento"]; ?></td>
                                                    <td><?php echo $row["veterinario"]; ?></td>
                                                    <td><?php echo $row["activo"] ? 'Activo' : 'Inactivo'; ?></td>
                                                    <td>
                                                        <a href="/expediente/eliminar/<?php echo $row["id_expediente"]; ?>" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                        <a href="/expediente/modificar/<?php echo $row["id_expediente"]; ?>" class="btn btn-success">
                                                            <i class="fas fa-pencil"></i> Actualizar
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="text-center p-2">
                                        <span>No hay expedientes registrados.</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/2246/2246679.png" alt="categorias" style="width:100%">
                            <div class="container">
                                <h4 class="fs-2">Expedientes</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <script>
        // Utilizando fetch para cargar el contenido de templates/header.html y templates/footer.html
        fetch('templates/header.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-placeholder').innerHTML = data;
            });

        fetch('templates/footer.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-placeholder').innerHTML = data;
            });
    </script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
