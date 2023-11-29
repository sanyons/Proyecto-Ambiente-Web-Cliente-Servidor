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

// Consulta para obtener las mascotas
$sql = "SELECT * FROM mascota";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- boostrap header-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- boostrap --> 
</head>

    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>

<body>
    <!-- boostrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- boostrap -->

    </div>
    <div class="container my-5">
        <div class="row align-items-center"> 
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #42829C" >
                        <h2 style="color: white">Inicio de Sesión</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="procesar_login.php"> <!-- Reemplaza "procesar_login.php" con el archivo que manejará el inicio de sesión -->
                            <div class="form-group row my-3">
                                <label class="col-md-5 my-auto" for="username">Usuario:</label>
                                <div class="col-md-7 my-auto">
                                    <input class="form-control" type="text" name="username" id="username"/>
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <label class="col-md-5 my-auto" for="password">Contraseña:</label>
                                <div class="col-md-7 my-auto">
                                    <input class="form-control" type="password" name="password" id="password"/>
                                </div>
                            </div>
                            <div class="card-footer col text-center">
                                <button class="btn btn-secondary">
                                    <a href="registro/nuevo" class="btn" style="color: white"><i class="fas fa-user-plus"></i> Registrar</a>
                                </button>
                                <button class="btn btn-warning">
                                    <a href="registro/recordar" class="btn" style="color: white"><i class="fas fa-envelope"></i> Recordar</a>
                                </button>
                                <button class="btn" style="background-color: #42829C" type="submit">
                                    <span class="btn" style="color: white"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</span>
                                </button>
                            </div>
                        </form>                            
                    </div>
                </div>
                <?php
                    if (isset($_GET['error']) && $_GET['error'] == true) {
                        echo '<h3>Error en el inicio de sesión</h3>';
                    }
                ?>
            </div>
        </div>           
    </div>
    </section>

    <!-- Agrega aquí el contenido adicional de tu página, como scripts y otros elementos HTML si es necesario -->

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

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
