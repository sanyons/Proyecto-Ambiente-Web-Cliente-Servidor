<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Expediente Médico</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>

<body>

    <h1>Crear Expediente Médico</h1>

    <!-- Agregar un identificador al formulario para facilitar su manipulación desde JavaScript -->
    <form id="formularioExpediente" method="POST" action="procesar_expediente.php">
        <label for="nombre_mascota">Nombre de la Mascota:</label>
        <input type="text" name="nombre_mascota" required><br>

        <label for="veterinario">Veterinario:</label>
        <input type="text" name="veterinario" required><br>

        <label for="padecimiento">Padecimiento:</label>
        <textarea name="padecimiento" required></textarea><br>

        <label for="presion">Presión:</label>
        <input type="number" step="0.01" name="presion" required><br>

        <label for="pulso">Pulso:</label>
        <input type="number" step="0.01" name="pulso" required><br>

        <label for="temperatura">Temperatura:</label>
        <input type="number" step="0.01" name="temperatura" required><br>

        <label for="peso">Peso:</label>
        <input type="number" step="0.01" name="peso" required><br>

        <label for="talla">Talla:</label>
        <input type="number" step="0.01" name="talla" required><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad" required><br>
        <br>
        <input type="submit" value="Crear Expediente">
        <a href="expediente.php" class="btn btn-secondary btn-block">
        <i class="fas fa-arrow-left"></i> Cerrar</a>
       
    </form>

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

        // Función para cargar el formulario de crear expediente
        function cargarFormularioCrearExpediente() {
            // Hacer una solicitud AJAX para obtener el contenido del formulario
            fetch('crear_expediente.php')
                .then(response => response.text())
                .then(data => {
                    // Crear un contenedor para el formulario
                    var formularioContainer = document.createElement('div');
                    formularioContainer.innerHTML = data;

                    // Insertar el formulario antes del listado de expedientes
                    var expedientesSection = document.getElementById('expedientes');
                    expedientesSection.parentNode.insertBefore(formularioContainer, expedientesSection);
                });
        }

        // Asignar la función al evento click del botón
        var botonAgregarExpediente = document.getElementById('botonAgregarExpediente');
        botonAgregarExpediente.addEventListener('click', cargarFormularioCrearExpediente);
    </script>
</body>
</html>
