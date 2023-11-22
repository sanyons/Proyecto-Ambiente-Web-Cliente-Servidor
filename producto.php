<!DOCTYPE html>
<html>
<head>
    <title>Producto</title>
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
        <h1>Listado producto</h1>
        <!-- Aqui listado mascota -->
        <section th:fragment="listadoProductos" id="productos">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header"style="background-color: #42829C;">
                                <h4 style="color:white">[[#{producto.listado}]]</h4>
                            </div>
                            <div th:if="${productos != null and !productos.empty}">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr><th>#</th>
                                            <th class="text-center">[[#{producto.descripcion}]]</th>​
                                            <th class="text-center">[[#{producto.precio}]]</th>​
                                            <th class="text-center">[[#{producto.existencias}]]</th>​
                                            <th class="text-center">[[#{producto.total}]]</th>​
                                            <th class="text-center">[[#{producto.activo}]]</th>​
                                            <th class="text-center">[[#{producto.categoria}]]</th>​
                                            
                                            
                                            <th></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr th:each="producto, contador : ${productos}">
                                         <td class="text-center">[[${contador.count}]]</td>​
                                            <td class="fs-6">[[${producto.descripcion}]]</td>​
                                            <td class="text-end">¢[[${#numbers.formatDecimal(producto.precio, 1, 'DEFAULT', 2, 'DEFAULT')}]]</td>​
                                            <td class="text-center">[[${producto.existencias}]]</td>​
                                            <td class="text-end">¢[[${#numbers.formatDecimal(producto.precio*producto.existencias, 1, 'DEFAULT', 2, 'DEFAULT')}]]</td>​
                                            
                                            <td th:text="${producto.activo} ? 'Activa' : 'Inactiva'" />
                                            
                                            <td class="text-center">[[${producto.categoria.descripcion}]]</td>
                                            
                                            <td><a sec:authorize ="hasRole('ROLE_ADMIN')" th:href="@{/producto/eliminar/}+${producto.idProducto}"
                                                   class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> [[#{accion.eliminar}]]</a>
                                                <a sec:authorize ="hasRole('ROLE_ADMIN')" th:href="@{/producto/modificar/}+${producto.idProducto}"
                                                   class="btn btn-success">
                                                    <i class="fas fa-pencil"></i> [[#{accion.actualizar}]]</a></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center p-2" th:if="${productos == null or productos.empty}">
                                <span>[[#{lista.vacia}]]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                        <img src=https://uxwing.com/wp-content/themes/uxwing/download/e-commerce-currency-shopping/find-product-icon.png alt="categorias" style="width:100%">
                        <div class="container">
                        <h4 class="fs-2">[[#{plantilla.productos}]]</h4>
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