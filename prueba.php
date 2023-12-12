<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $server = "localhost";
    $user = "root";
    $db_password = "";
    $dataBase = "veterinaria_db";

    $conn = new mysqli($server, $user, $db_password, $dataBase);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }



     // Utilizar sentencias preparadas para prevenir inyección de SQL
     $stmt = $conn->prepare("SELECT id_usuario, username, password, ruta_imagen FROM usuario WHERE username = ?");
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->store_result();
 
     if ($stmt->num_rows == 1) {
         // Encontrar el usuario, obtener la contraseña hash
         $stmt->bind_result($id_usuario, $db_username, $db_password_hash, $ruta_imagen);
         $stmt->fetch();
 
         // Verificar la contraseña
         if (password_verify($password, $db_password_hash)) {
             // Inicio de sesión exitoso
             $_SESSION['id_usuario'] = $id_usuario;
             $_SESSION['username'] = $db_username;
             $_SESSION['ruta_imagen'] = $ruta_imagen;  
             
 
             // Redirigir a la página de inicio después del inicio de sesión exitoso con un parámetro
             header("Location: index.html?loginSuccess=true");
             exit();
         } else {
             // Error en las credenciales
             header("Location: login.php?error=true");
             exit();
         }
     } else {
         // Error en las credenciales
         header("Location: login.php?error=true");
         exit();
     }
 
     // Cerrar la conexión y liberar recursos
     $stmt->close();
     $conn->close();
 } else {
     // Acceso directo al script, redirigir al formulario de inicio de sesión
     header("Location: login.php");
     exit();
 }

 echo "<pre>";
 print_r($_SESSION);
 echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="preload" href="css/index.css" />
    <link rel="stylesheet" href="css/index.css" />
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark container-fluid">
      <div class="container">
          <a class="navbar-brand" href="index.html">
              <img src="img/logoraw.png" alt="Logotipo" height="100" class=rounded-circle>
          </a>
    
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cita.php">Cita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="expediente.php">Expediente</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="mascota.php">Mascota</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categoria.php">Categoría</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="producto.php">Produto</a>
            </li>
    
              
          </ul>                
              <ul class="navbar-nav ms-auto"> <!-- Alineación a la derecha -->
                <img src="<?php echo ($_SESSION['ruta_imagen'])  ?>" alt="Imagen de perfil" />;
    
                  <li class="nav-item">
                      <a href="login.php" class="nav-link" style="color: white;">Login</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" style="color: white;" href="usuario.php">Registro</a>
                  </li>
              </ul>
          </div>
      </div>
    </nav>