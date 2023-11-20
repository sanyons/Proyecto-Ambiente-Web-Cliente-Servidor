<!DOCTYPE html>
<html>
<head>
    <title>Mascota</title>
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
        <h1>Listado mascota</h1>
        <!-- Aqui listado mascota -->
        <?php
// Tu código de conexión a la base de datos aquí
$conexion = mysqli_connect("localhost", "root", "", "veterinaria_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Botón Agregar Mascota
echo "<button onclick='agregarMascota()'>Agregar Mascota</button>";

$query = "SELECT * FROM mascota";
$result = mysqli_query($conexion, $query);

// Verificar si hay resultados
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Información de la mascota
        echo "<p>{$row['nombre']} - {$row['especie']} - {$row['sexo']}</p>";

        // Botones de eliminar y actualizar al lado derecho
        echo "<button onclick='eliminarMascota({$row['id_mascota']})'>Eliminar</button>";
        echo "<button onclick='actualizarMascota({$row['id_mascota']})'>Actualizar</button>";
    }
} else {
    echo "No hay mascotas registradas.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<script>
    function agregarMascota() {
        // Redirigir a la página de agregar mascota
        window.location.href = 'crear_mascota.php';
    }

    function eliminarMascota(idMascota) {
        var confirmacion = confirm("¿Estás seguro de que quieres eliminar esta mascota?");
        if (confirmacion) {
            // Hacer una solicitud AJAX para eliminar la mascota por su ID
            // Puedes usar fetch o jQuery.ajax para esto
            // Después de eliminar, recargar la página o actualizar la lista de mascotas
            // Ejemplo usando fetch:
            fetch('eliminar_mascota.php?id=' + idMascota, {
                method: 'POST',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Mascota eliminada con éxito.");
                    location.reload(); // Recargar la página (puedes mejorar esto con AJAX)
                } else {
                    alert("Error al eliminar la mascota.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function actualizarMascota(idMascota) {
        // Redirigir a la página de actualización de mascotas con el ID como parámetro
        window.location.href = 'actualizar_mascota.php?id=' + idMascota;
    }
</script>




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
