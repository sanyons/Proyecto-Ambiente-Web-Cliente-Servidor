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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <!-- Botón que llama a la función para cargar el formulario -->
                <button type="button" class="btn btn-primary btn-block" 
                onclick="cargarFormularioCrearCita()">
                    <i class="fas fa-plus"></i> Agregar Cita
                </button>
            </div>
        </div>
    </div>

    <!-- Contenedor para mostrar el formulario -->
    <div id="formularioContainer"></div>

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
                                            <th>Nombre Mascota</th>
                                            <th>Nombre Dueño</th>
                                            <th>Descripción</th>
                                            <th>Imagen</th>
                                            <th>Fecha Cita</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row["id_citas"]; ?></td>
                                                <td><?php echo $row["nombre_mascota"]; ?></td>
                                                <td><?php echo $row["nombre_duenno"]; ?></td>
                                                <td><?php echo $row["descripcion"]; ?></td>
                                                <td><img src="<?php echo $row["ruta_imagen"]; ?>" alt="Imagen de perfil" style="width: 50px; height: 50px;"></td>
                                                <td><?php echo $row["fecha_cita"]; ?></td>
                                                <td><?php echo $row["estado"] ? 'Activa' : 'Inactiva'; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="eliminar_cita.php?id=<?php echo $row["id_citas"]; ?>" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                        <a hhref="actualizar_cita.php?id=<?php echo $row["id_citas"]; ?>" class="btn btn-success">
                                                            <i class="fas fa-pencil"></i> Actualizar
                                                        </a>
                                                    </div>
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

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <script>
        // Función para cargar el formulario de crear cita
        function cargarFormularioCrearCita() {
            // Hacer una solicitud AJAX para obtener el contenido del formulario
            fetch('crear_cita.php')
                .then(response => response.text())
                .then(data => {
                    // Insertar el formulario en el contenedor
                    document.getElementById('formularioContainer').innerHTML = data;
                });
        }
    </script>

    <?php
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>

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
