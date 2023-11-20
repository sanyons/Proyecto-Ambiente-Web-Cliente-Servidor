<!DOCTYPE html>
<html>
<head>
    <title>Expediente</title>
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
        <h1>Listado expediente</h1>
        <!-- Aqui listado mascota -->
        
        <section th:fragment="listadoExpedientes" id="expedientes">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" style="background-color: #42829C;">
                                <h4 style="color:white">[[#{expediente.listado}]]</h4>
                            </div>
                            <div th:if="${expedientes != null and !expedientes.empty}">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr><th>#</th>
                                            <th class="text-center">[[#{expediente.paciente}]]</th>
                                            <th class="text-center">[[#{expediente.padecimiento}]]</th> 
                                            <th class="text-center">[[#{expediente.veterinario}]]</th>
                                            <th class="text-center">[[#{expediente.activo}]]</th>
                                            <th></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr th:each="expediente, contador : ${expedientes}">​
                                            <td class="text-center">[[${contador.count}]]</td>​
                                            <td class="text-center">[[${expediente.mascota.nombre}]]</td>
                                            <td class="text-center">[[${expediente.padecimiento}]]</td>                                            
                                            <td class="text-center">[[${expediente.veterinario}]]</td>
                                            <td class="text-center" th:text="${expediente.activo} ? 'Activa' : 'Inactiva'" />
                                            <td><a th:href="@{/expediente/eliminar/}+${expediente.id}"
                                                   class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> [[#{accion.eliminar}]]</a>
                                                <a th:href="@{/expediente/modificar/}+${expediente.id}"
                                                   class="btn btn-success">
                                                    <i class="fas fa-pencil"></i> [[#{accion.actualizar}]]</a></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center p-2" th:if="${expedientes == null or expedientes.empty}">
                                <span>[[#{lista.vacia}]]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center mb-3">
                        <img src=https://cdn-icons-png.flaticon.com/512/2246/2246679.png alt="categorias" style="width:100%">
                        <div class="container">
                        <h4 class="fs-2">[[#{plantilla.expediente}]]</h4>
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