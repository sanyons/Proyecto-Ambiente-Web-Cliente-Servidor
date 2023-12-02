<!DOCTYPE html>
<html>

<head>
    <title>Crear Producto</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap JS (si es necesario) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</head>

<body>
    <section class="container mt-5">
        <h1>Crear Producto</h1>
        <!-- Formulario para crear un nuevo producto -->
        <form method="POST" action="procesar_producto.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" required>
            </div>

            <div class="mb-3">
                <label for="detalle" class="form-label">Detalle:</label>
                <textarea class="form-control" name="detalle" required></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="existencias" class="form-label">Existencias:</label>
                <input type="number" class="form-control" name="existencias" required>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría:</label>
                <select class="form-select" name="id_categoria" required>
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
                    $sql = "SELECT id_categoria, descripcion FROM categoria";
                    $result = $conn->query($sql);

                    // Mostrar opciones del dropdown con las categorías
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id_categoria']}'>{$row['descripcion']}</option>";
                    }

                    // Cerrar la conexión a la base de datos
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="ruta_imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="ruta_imagen">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="activo">
                <label class="form-check-label" for="activo">Activo</label>
            </div>

            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <!-- Bootstrap JS (si es necesario) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> 

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
