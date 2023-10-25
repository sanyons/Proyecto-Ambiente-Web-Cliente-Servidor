<?php
 session_start();

 // Conexión a la base de datos 
 $server = "localhost";
 $user = "root";
 $password = "";
 $dataBase = "veterinaria_db";
 //1. Establecer la conexion mysqli
 $conexion = mysqli_connect($server, $user, $password, $dataBase);
 
 if (!$conexion) {
     die("Error de conexión a la base de datos: " . mysqli_connect_error());
 }
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Acción: Actualizar Usuario
     if ($_POST["accion"] === "Actualizar Usuario") {
         // Recopilar los nuevos datos del formulario
         $nuevoNombre = $_POST["nuevoNombre"];
         $nuevosApellidos = $_POST["nuevosApellidos"];
         $nuevoCorreo = $_POST["nuevoCorreo"];
         $nuevoTelefono = $_POST["nuevoTelefono"];
         $username_actualizar = $_POST["username_actualizar"];
 
         // Consulta SQL para actualizar el usuario
         $sql = "UPDATE usuario
                 SET nombre = '$nuevoNombre', apellidos = '$nuevosApellidos', correo = '$nuevoCorreo', telefono = '$nuevoTelefono'
                 WHERE username = '$username_actualizar'";
 
         if (mysqli_query($conexion, $sql)) {
             // Redirige o muestra un mensaje de éxito
             header("Location: usuario_actualizado.php");
         } else {
             // Redirige o muestra un mensaje de error
             header("Location: error_actualizar_usuario.php");
         }
     }
 }
 
 // Cierra la conexión a la base de datos
 mysqli_close($conexion);
 ?>
 

 ********************
 <!-- Formulario para actualizar un usuario -->
<form method="POST" action="actualizar_usuario.php">
        <!-- Campos para actualizar un usuario (ingresar el username del usuario a actualizar) -->
        <label for="username_actualizar">Username del Usuario a Actualizar:</label>
        <input type="text" name="username_actualizar" required><br>

        <input type="submit" name="accion" value="Actualizar Usuario">
    </form>

    <!-- Formulario para eliminar un usuario -->
    <form method="POST" action="eliminar_usuario.php">
        <!-- Campos para eliminar un usuario (ingresar el username del usuario a eliminar) -->
        <label for="username_eliminar">Username del Usuario a Eliminar:</label>
        <input type="text" name="username_eliminar" required><br>

        <input type="submit" name="accion" value="Eliminar Usuario">
    </form>