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

// Consulta para obtener las categorías
$sql = "SELECT * FROM categoria";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listado de Categorías</title>
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
    <div class="container" sec:authorize="hasRole('ROLE_ADMIN')">
                <div class="row">
                    <div class="col-md-3">   
                        <button 
                            type="button" 
                            class="btn btn-primary btn-block" 
                            data-bs-toggle="modal" 
                            data-bs-target="#agregarMascota">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>
<section th:fragment="listadoCategorias" id="categorias">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #42829C;">
                        <h4 style="color:white">Listado de Categorías</h4>
                    </div>
                    <div>
                        <?php
                        if ($result->num_rows > 0) {
                            echo '<table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Descripción</th>
                                            <th>Activo</th>';
                            if (tieneRolAdmin()) {
                                echo '<th></th>';
                            }
                            echo '</tr>
                                    </thead>
                                    <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>' . $row["id_categoria"] . '</td>
                                        <td>' . $row["descripcion"] . '</td>
                                        <td>' . ($row["activo"] ? "Activa" : "Inactiva") . '</td>';
                                if (tieneRolAdmin()) {
                                    echo '<td>
                                            <a href="/eliminar_categoria.php?id=' . $row["id_categoria"] . '" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                            <a href="/modificar_categoria.php?id=' . $row["id_categoria"] . '" class="btn btn-success">
                                                <i class="fas fa-pencil"></i> Actualizar
                                            </a>
                                          </td>';
                                }
                                echo '</tr>';
                            }
                            echo '</tbody>
                                  </table>';
                        } else {
                            echo '<div class="text-center p-2">
                                    <span>La lista de categorías está vacía.</span>
                                  </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center mb-3">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/568/669/non_2x/category-line-icon-vector.jpg" alt="categorias" style="width:100%">
                    <div class="container">
                        <h4>Plantilla Categorías</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<?php
// Cerrar la conexión a la base de datos
$conn->close();

// Función para verificar si el usuario tiene el rol de administrador
function tieneRolAdmin() {
    // Aquí puedes implementar la lógica para verificar el rol del usuario
    // Retorna true si el usuario tiene el rol de administrador, de lo contrario, false
    return true;
}
?>
