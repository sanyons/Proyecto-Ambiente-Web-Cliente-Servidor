<!DOCTYPE html>
<html>

<head>
    <title>Crear Mascota</title>
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
        <h1>Crear Mascota</h1>
        <!-- Formulario para crear un nuevo usuario -->
        <form method="POST" action="procesar_mascota.php" enctype="multipart/form-data">

        <label for="nombre_mascota">Nombre:</label>
            <input type="text" name="nombre_mascota" required><br>

            <label for="especie">Especie:</label>
            <input type="text" name="especie" required><br>

            <label for="sexo">Sexo:</label>
            <input type="text" name="sexo" required><br>

            <label for="ruta_imagen">Imagen de la Mascota:</label>
            <input type="file" name="ruta_imagen"><br>

            <input type="submit" value="Crear Mascota">
        </form>
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