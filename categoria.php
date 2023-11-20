<!DOCTYPE html>
<html>
<head>
    <title>Categoría</title>
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>
<body>
    <section>
        <h1>Listado categoría</h1>
        <!-- Aqui listado mascota -->
        
        <section th:fragment="listadoCategorias" id="categorias">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">[[#{categoria.listado}]]</h4>
                            </div>
                            <div th:if="${categorias != null and !categorias.empty}">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr><th>#</th>
                                            <th>[[#{categoria.descripcion}]]</th>
                                            <th>[[#{categoria.activo}]]</th>
                                            <th sec:authorize ="hasRole('ROLE_ADMIN')"></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr th:each="categoria, contador : ${categorias}">
                                            <td>[[${contador.count}]]</td>
                                            <td>[[${categoria.descripcion}]]</td>
                                            <td th:text="${categoria.activo} ? 'Activa' : 'Inactiva'" />
                                            <td sec:authorize ="hasRole('ROLE_ADMIN')"><a th:href="@{/categoria/eliminar/}+${categoria.idCategoria}"
                                                   class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> [[#{accion.eliminar}]]</a>
                                                <a th:href="@{/categoria/modificar/}+${categoria.idCategoria}"
                                                   class="btn btn-success">
                                                    <i class="fas fa-pencil"></i> [[#{accion.actualizar}]]</a></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center p-2" th:if="${categorias == null or categorias.empty}">
                                <span>[[#{lista.vacia}]]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                        <img src=https://static.vecteezy.com/system/resources/previews/004/568/669/non_2x/category-line-icon-vector.jpg alt="categorias" style="width:100%">
                        <div class="container">
                        <h4>[[#{plantilla.categorias}]]</h4>
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