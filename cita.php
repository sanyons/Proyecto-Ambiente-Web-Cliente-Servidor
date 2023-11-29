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

// Consulta para obtener las citas
$sql = "SELECT * FROM citas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <!-- Bootstrap header -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header class="header" id="header-placeholder"></header>

    <div class="row">
        <div class="col-md-3">   
            <!-- Botón que redirige a la página crear_usuario.php -->
            <button 
                type="button" 
                class="btn btn-primary btn-block" 
                onclick="window.location.href='crear_cita.php'"
            >
                <i class="fas fa-plus"></i> Agregar
            </button>
        </div>
    </div>

    <section>
        <!-- Listado de citas -->
        <section id="citas">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">Listado de Citas</h4>
                            </div>
                            <div class="container">
                            </div>
                            <div>
                                <?php if ($result->num_rows > 0): ?>
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo $row["id_citas"]; ?></td>
                                                    <td><?php echo $row["descripcion"]; ?></td>
                                                    <td><?php echo $row["estado"] ? 'Activa' : 'Inactiva'; ?></td>
                                                    <td>
                                                        <a href="/cita/eliminar/<?php echo $row["id_citas"]; ?>" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                        <a href="/cita/modificar/<?php echo $row["id_citas"]; ?>" class="btn btn-success">
                                                            <i class="fas fa-pencil"></i> Actualizar
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="text-center p-2">
                                        <span>No hay citas registradas.</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/1572/1572132.png" alt="categorias" style="width:100%">
                            <div class="container">
                                <h4 class="fs-2">Citas</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder"></footer>

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
    <!-- Bootstrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
