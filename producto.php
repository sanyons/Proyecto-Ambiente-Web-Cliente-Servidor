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

// Consulta para obtener los productos
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listado de Productos</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
    <!-- boostrap header-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- boostrap --> 
</head>
<body>
    <!-- boostrap body -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- boostrap -->
    <!-- Body -->
    <section>
        <h1>Listado de Productos</h1>
        <!-- Aquí va el listado de productos -->
        <section id="productos">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">Listado de Productos</h4>
                            </div>
                            <div>
                                <?php
                                if ($result->num_rows > 0) {
                                    echo '<table class="table table-striped table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>#</th>
                                                    <th class="text-center">Descripción</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Existencias</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Activo</th>
                                                    <th class="text-center">Categoría</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>
                                                <td class="text-center">' . $row["id_producto"] . '</td>
                                                <td class="fs-6">' . $row["descripcion"] . '</td>
                                                <td class="text-end">¢' . number_format($row["precio"], 2) . '</td>
                                                <td class="text-center">' . $row["existencias"] . '</td>
                                                <td class="text-end">¢' . number_format($row["precio"] * $row["existencias"], 2) . '</td>
                                                <td>' . ($row["activo"] ? "Activo" : "Inactivo") . '</td>
                                                <td class="text-center">' . obtenerCategoria($row["id_categoria"]) . '</td>
                                                <td>
                                                    <a href="/eliminar_producto.php?id=' . $row["id_producto"] . '" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </a>
                                                    <a href="/modificar_producto.php?id=' . $row["id_producto"] . '" class="btn btn-success">
                                                        <i class="fas fa-pencil"></i> Actualizar
                                                    </a>
                                                </td>
                                            </tr>';
                                    }
                                    echo '</tbody>
                                          </table>';
                                } else {
                                    echo '<div class="text-center p-2">
                                            <span>La lista de productos está vacía.</span>
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                            <img src="https://uxwing.com/wp-content/themes/uxwing/download/e-commerce-currency-shopping/find-product-icon.png" alt="categorias" style="width:100%">
                            <div class="container">
                                <h4 class="fs-2">Plantilla de Productos</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

// Función para obtener el nombre de la categoría
function obtenerCategoria($idCategoria) {
    // Aquí puedes implementar la lógica para obtener el nombre de la categoría
    return "Categoría " . $idCategoria;
}
?>
