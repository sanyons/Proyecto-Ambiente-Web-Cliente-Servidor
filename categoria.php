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

// Consulta para obtener las categorías
$sql = "SELECT * FROM categoria";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoría</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="preload" href="css/index.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                onclick="cargarFormularioCrearCategoria()">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
        </div>
    </div>

    <!-- Contenedor para mostrar el formulario -->
    <div id="formularioContainer"></div>

<section id="categorias">
    <div class="container" style="margin-bottom: 20px;">
        <div class="row">
        <div class="col-md-9">
                    <div class="card">
                        <div class="card-header" style="background-color: #42829C;">
                            <h4 style="color:white">Listado de Categorias</h4>
                        </div>
                        <div>
                            <?php if ($result->num_rows > 0) : ?>
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Imagen</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row["id_categoria"]; ?></td>
                                                <td><?php echo $row["descripcion"]; ?></td>
                                                <td><img src="<?php echo $row["ruta_imagen"]; ?>" alt="Imagen de perfil" style="width: 50px; height: 50px;"></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="eliminar_categoria.php?id=<?php echo $row["id_categoria"]; ?>" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar</a>
                                                        <a href="actualizar_categoria.php?id=<?php echo $row["id_categoria"]; ?>" class="btn btn-success">
                                                            <i class="fas fa-pencil"></i> Actualizar
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <div class="text-center p-2">
                                    <span>No hay categorias registradas.</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <div class="col-md-3">
                <div class="card text-center mb-3">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/568/669/non_2x/category-line-icon-vector.jpg" alt="categorias" style="width:100%">
                    <div class="container">
                        <h4>Categorías</h4>
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

 <!-- Script para manejar la carga del formulario -->
 <script>
        // Función para cargar el formulario de crear usuario
        function cargarFormularioCrearCategoria() {
            // Hacer una solicitud AJAX para obtener el contenido del formulario
            fetch('crear_categoria.php')
                .then(response => response.text())
                .then(data => {
                    // Insertar el formulario en el contenedor
                    document.getElementById('formularioContainer').innerHTML = data;
                });
        }
        </script>

<!-- Cerrar la conexión a la base de datos -->
<?php $conn->close(); ?>

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