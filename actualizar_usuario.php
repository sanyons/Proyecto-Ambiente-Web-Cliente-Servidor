<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Usuario</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
</head>
<body>
    <h1>Actualizar Usuario</h1>
    <!-- Formulario para actualizar un usuario existente -->
    <form method="POST" action="procesar_usuario.php" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="Actualizar Usuario">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password"><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" required><br>

        <label for="ruta_imagen">Nueva Imagen de perfil:</label>
        <input type="file" name="ruta_imagen"><br><br>

        <input type="submit" value="Actualizar Usuario">
        <a href="usuario.php" class="btn btn-secondary btn-block">
        <i class="fas fa-arrow-left"></i> Cerrar formulario </a>
    </form>
    <br>
</body>
</html>