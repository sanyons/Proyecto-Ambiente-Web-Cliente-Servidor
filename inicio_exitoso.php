<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ... (resto del encabezado) ... -->
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Este es el área protegida.</p>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
