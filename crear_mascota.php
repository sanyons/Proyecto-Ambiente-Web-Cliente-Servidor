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

// Consulta SQL para obtener la lista de usuarios
$sqlUsuarios = "SELECT id_usuario, CONCAT(nombre, ' ', apellidos) as nombre_completo FROM usuario";
$resultUsuarios = $conn->query($sqlUsuarios);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Mascota</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->

    <!-- Bootstrap header -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>
    <!-- Bootstrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <!-- Bootstrap -->

    <section>
        <h1>Crear Mascota</h1>
        <!-- Formulario para crear una nueva mascota -->
        <form method="POST" action="procesar_mascota.php" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="especie">Especie:</label>
            <input type="text" name="especie" required><br>

            <label for="sexo">Sexo:</label>
            <input type="text" name="sexo" required><br>

            <label for="activo">Activo:</label>
            <input type="checkbox" name="activo"><br>

            <label for="id_usuario">Dueño:</label>
            <select name="id_usuario" required>
                <?php
                while ($rowUsuario = $resultUsuarios->fetch_assoc()) {
                    echo '<option value="' . $rowUsuario['id_usuario'] . '">' . $rowUsuario['nombre_completo'] . ' - ID: ' . $rowUsuario['id_usuario'] . '</option>';
                }
                ?>
            </select><br>

            <label for="ruta_imagen">Imagen de la Mascota:</label>
            <input type="file" name="ruta_imagen"><br>

            <input type="submit" value="Crear Mascota">
            <a href="mascota.php" class="btn btn-secondary btn-block">
            <i class="fas fa-arrow-left"></i> Cerrar</a>
        </form>
    </section>

    <!-- Incluir el footer -->
    <footer id="footer-placeholder">
        <!-- El contenido del footer se cargará aquí -->
    </footer>

    <script>
        // Utilizando fetch para cargar el contenido de templates/header.php y templates/footer.html
        document.addEventListener("DOMContentLoaded", function () {
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
        });
    </script>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
