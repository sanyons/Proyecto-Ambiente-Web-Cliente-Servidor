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

// Consulta para obtener las mascotas
$sql = "SELECT * FROM mascota";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascotas</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
    <!-- Bootstrap header-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
            <br>
                <!-- Botón que llama a la función para cargar el formulario -->
                <button type="button" class="btn btn-primary btn-block" onclick="cargarFormularioCrearMascota()">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
        </div>
    </div>
    <!-- Bootstrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <!-- Bootstrap -->

    <section>
        <!-- Aquí va el listado de mascotas -->
        <section id="mascotas">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">Listado de Mascotas</h4>
                            </div>
                            <div>
                                <?php if ($result->num_rows > 0): ?>
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Especie</th>
                                                <th>Sexo</th>
                                                <th>Activo</th>
                                                <th>Dueño</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo $row["id_mascota"]; ?></td>
                                                    <td><?php echo $row["nombre"]; ?></td>
                                                    <td><?php echo $row["especie"]; ?></td>
                                                    <td><?php echo $row["sexo"]; ?></td>
                                                    <td><?php echo $row["activo"] ? 'Sí' : 'No'; ?></td>
                                                    <td><?php echo $row["id_usuario"]; ?></td>
                                                    <td><img src="<?php echo $row["ruta_imagen"]; ?>" alt="Imagen de la mascota" style="max-width: 100px;"></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="eliminar_mascota.php?id=<?php echo $row["id_mascota"]; ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Eliminar
                                                            </a>
                                                            <a href="actualizar_mascota.php?id=<?php echo $row["id_mascota"]; ?>" class="btn btn-success">
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
                                        <span>No hay mascotas registradas.</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/6462/6462524.png" alt="mascota"
                                style="width:100%">
                            <div class="container">
                                <h4 class="fs-2">Mascotas</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Contenedor para mostrar el formulario -->
    <div id="formularioContainer"></div>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <!-- Script para manejar la carga del formulario -->
    <script>
        // Función para cargar el formulario de crear mascota
        function cargarFormularioCrearMascota() {
            // Hacer una solicitud AJAX para obtener el contenido del formulario
            fetch('crear_mascota.php')
                .then(response => response.text())
                .then(data => {
                    // Crear un contenedor para el formulario
                    var formularioContainer = document.createElement('div');
                    formularioContainer.innerHTML = data;

                    // Insertar el formulario antes del listado de mascotas
                    var mascotasSection = document.getElementById('mascotas');
                    mascotasSection.parentNode.insertBefore(formularioContainer, mascotasSection);
                });
        }

        // Función para cargar el formulario de crear usuario
        function cargarFormularioCrearUsuario() {
            // Hacer una solicitud AJAX para obtener el contenido del formulario
            fetch('crear_usuario.php')
                .then(response => response.text())
                .then(data => {
                    // Insertar el formulario en el contenedor
                    document.getElementById('formularioContainer').innerHTML = data;
                });
        }
    </script>

    <!-- Script para cargar el header y el footer -->
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
