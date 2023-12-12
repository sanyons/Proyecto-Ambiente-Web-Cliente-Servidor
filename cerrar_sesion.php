<?php
session_start();
session_destroy();
header("Location: index.html"); // Puedes cambiar la página de destino después de cerrar sesión
exit();
?>