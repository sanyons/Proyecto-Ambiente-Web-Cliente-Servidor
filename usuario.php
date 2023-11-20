<!DOCTYPE html>
<html>
<head>
    <title>Usuario</title>
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
        <h1>Listado usuario</h1>
        <!-- Aqui listado mascota -->
        
        <section th:fragment="listadoUsuarios" id="usuarios">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header"style="background-color: #42829C;">
                                <h4 style="color:white">[[#{usuario.listado}]]</h4></div>
                            <div th:if="${usuarios != null and !usuarios.empty}">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr><th>#</th>
                                            <th>[[#{usuario.username}]]</th>
                                            <th>[[#{usuario.nombre}]]</th>
                                            <th>[[#{usuario.apellidos}]]</th>
                                            <th></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr th:each="usuario, contador : ${usuarios}">
                                            <td>[[${contador.count}]]</td>
                                            <td>[[${usuario.username}]]</td>
                                            <td>[[${usuario.nombre}]]</td>
                                            <td>[[${usuario.apellidos}]]</td>
                                            <td sec:authorize="hasRole('ROLE_ADMIN')">
                                                <a th:href="@{/usuario/eliminar/}+${usuario.idUsuario}"
                                                   class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> [[#{accion.eliminar}]]</a>
                                                <a th:href="@{/usuario/modificar/}+${usuario.idUsuario}"
                                                   class="btn btn-success">
                                                    <i class="fas fa-pencil"></i> [[#{accion.actualizar}]]</a></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center p-2" th:if="${usuarios == null or usuarios.empty}">
                                <span>[[#{lista.vacia}]]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                        <img src=https://cdn-icons-png.flaticon.com/512/1077/1077063.png alt="categorias" style="width:100%">
                        <div class="container">
                        <h4 class="fs-2">[[#{plantilla.usuarios}]]</h4>
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