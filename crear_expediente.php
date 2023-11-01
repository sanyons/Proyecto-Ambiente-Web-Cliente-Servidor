<!DOCTYPE html>
<html>
<head>
    <title>Crear Expediente Médico</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
</head>
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
</html>