<!DOCTYPE html>
<html>
<head>
    <title>Crear Expediente Médico</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">

   
</head>

     <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>

<body>



    <h1>Crear Expediente Médico</h1>
    
    <form method="POST" action="procesar_expediente.php">
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
        <input type="submit" value="Crear Expediente Médico">
        <br>
        <br>
    </form>


  

</body>
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
</html>