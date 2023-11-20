<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usario</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="preload" href="css/index.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- Incluir el header -->
    <header class="header" id="header-placeholder">
        <!-- El contenido del header se cargará aquí -->
    </header>
</head>
<body>
        <h1>Listado usuario</h1>
        <!-- Aqui listado mascota -->
        
        <section th:fragment="listadoUsuarios" id="usuarios">
            <div class="container" margin-bottom: 20px;>
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

    <footer id="footer-placeholder" class="container">
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