<!DOCTYPE html>
<html>

<head>
    <title>Crear Categoría</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->

    <!-- boostrap header-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- boostrap -->
</head>

<header class="header" id="header-placeholder">
    <!-- El contenido del header se cargará aquí -->
</header>

<body>

    <!-- boostrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- boostrap -->

    <section>
        <h1>Crear Categoría</h1>
        <!-- Formulario para crear una nueva categoría -->
        <form method="POST" action="procesar_categoria.php" enctype="multipart/form-data">

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" required><br>

            <label for="ruta_imagen">Ruta de la imagen:</label>
            <input type="file" name="ruta_imagen"><br>

            <label for="activo">Activo:</label>
            <input type="checkbox" name="activo"><br>

            <input type="submit" value="Crear Categoría">
            <a href="categoria.php" class="btn btn-secondary btn-block">
            <i class="fas fa-arrow-left"></i> Cerrar</a>
        </form>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <script>
        // Utilizando fetch para cargar el contenido de templates/header.php y templates/footer.html
        fetch('templates/header.php')
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
