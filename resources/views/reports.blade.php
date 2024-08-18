<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card-header {
            background-color: #007EE5;
            color: white;
        }

        .sidebar {
            height: 100vh;
            background-color: #3D3D3D;
            color: white;
            position: fixed;
            top: 56px;
            left: 0;
            padding-top: 20px;
            width: 250px;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #F4F4F4;
            margin-top: 56px;
        }

        .navbar {
            background-color: #007EE5;
            z-index: 1000;
            position: fixed;
            width: 100%;
            top: 0;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2em;
        }

        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }

        .nav-link {
            margin-right: 20px;
        }

        .sidebar .nav-link {
            color: white !important;
        }

        .content-wrapper {
            margin-top: 56px;
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            width: 250px;
            padding: 10px 20px;
            border-radius: 20px;
            border: none;
            outline: none;
            padding-left: 40px;
            background-color: #FFFFFF;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        .profile-section {
            text-align: center;
            padding-bottom: 20px;
        }

        .profile-section img {
            height: 60px;
            border-radius: 50%;
        }

        .profile-section h4 {
            margin-top: 10px;
            color: white;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FFFFFF;
            color: #3D464D;
        }
    </style>
</head>

<body>
    <!-- Barra lateral -->
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar">
            <div class="profile-section">
                <img src="https://www.movilzona.es/app/uploads-movilzona.es/2023/04/fto-perfil.jpg?x=480&y=375&quality=40" alt="Profile"> <!-- Ajusta el path de la imagen de perfil -->
                <h4>Admin</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="userscrud">
                        <!--<i class="fas fa-user"></i>-->
                        Usuarios
                        <hr>
                    </a>
                </li>
                <li>
                <a class="nav-link active" href="refacciones">
               
                        Refacciones
                        <hr>
                    </a>
                </li>
                <li>
                <a class="nav-link active" href="types">
                        
                        Tipos
                        <hr>
                    </a>
                </li>
                <li>
                <a class="nav-link active" href="locations">
                        
                        Ubicaciones
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="racks">
                        
                        Racks
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="reports">Movimientos
                        <hr>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="dashboard">
            Control de almacén
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="search-bar ml-auto"></div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logoutButton">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <h1>Reportes de Usuarios</h1>

        <!-- Filtros de búsqueda y de fecha/hora -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="searchUser">Usuarios</label>
                <select id="searchUser" class="form-control">
                    <option value="">Buscar por usuario</option>
                    <!-- Opciones de usuarios se cargarán aquí -->
                </select>
            </div>
            <div class="col-md-4">
                <label for="searchRefaction">Refacción</label>
                <select id="searchRefaction" class="form-control">
                    <option value="">Buscar por refacción</option>
                    <!-- Opciones de refacciones se cargarán aquí -->
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button id="filterButton" class="btn btn-primary btn-block">Filtrar</button>
            </div>
            <div class="col-md-2">
                <label for="clearFilterButton">&nbsp;</label>
                <button id="clearFilterButton" class="btn btn-secondary btn-block">Limpiar Filtro</button>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="startDate">Fecha de inicio:</label>
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="startTime">Hora de inicio:</label>
                <input type="time" id="startTime" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="endDate">Fecha de fin:</label>
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="endTime">Hora de fin:</label>
                <input type="time" id="endTime" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p id="resultCount" class="text-muted"></p>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Refacción</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="reportTableBody">
                <!-- Los reportes se cargarán aquí -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var authToken = localStorage.getItem('auth_token');
            var autoFetchEnabled = true;
            console.log("El token es: " + authToken);
            if (!authToken) {
                window.location.href = '{{ url("/views/login") }}';
            } else {
                console.log("Se va a ejecutar la ruta.");
                $.ajax({
                    url: '{{ url("/api/v1/users/get-Myself") }}',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    },
                    success: function(response) {
                        console.log('Usuario autenticado:', response);
                    },
                    error: function(xhr, status, error) {
                        localStorage.removeItem('auth_token');
                        window.location.href = '{{ url("/views/loginweb") }}';
                    }
                });

                // Configurar los encabezados predeterminados para todas las solicitudes AJAX
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    }
                });

                fetchReports();
                // Ejecutar fetchReports() cada 3 segundos si autoFetchEnabled es true
                setInterval(function() {
                    if (autoFetchEnabled) {
                        fetchReports();
                    }
                }, 5000);
                fetchUsers();
                fetchRefactions();

                $('#filterButton').click(function() {
                    // Desactivar la ejecución automática mientras se usan los filtros
                    autoFetchEnabled = false;

                    let searchUser = $('#searchUser').val();
                    let searchRefaction = $('#searchRefaction').val();
                    let startDate = $('#startDate').val();
                    let startTime = $('#startTime').val() || '00:00';
                    let endDate = $('#endDate').val();
                    let endTime = $('#endTime').val() || '23:59';

                    $.get('{{ url("/api/v1/reports/all") }}', function(data) {
                        console.log('Datos recibidos:', data);

                        if (data && data.Data && Array.isArray(data.Data)) {
                            let filteredReports = filterReportsByUserOrDateAndRefaction(data, searchUser, searchRefaction, startDate, startTime, endDate, endTime);
                            populateReportTable({ Data: filteredReports });
                        } else {
                            console.error('Data no tiene el formato esperado o está vacío:', data);
                        }
                    });
                });
                $('#clearFilterButton').click(function() {
                    // Restablecer los campos de filtro a sus valores predeterminados
                    $('#searchUser').val('');
                    $('#searchRefaction').val('');
                    $('#startDate').val('');
                    $('#startTime').val('');
                    $('#endDate').val('');
                    $('#endTime').val('');

                    // Activar la ejecución automática
                    autoFetchEnabled = true;
                    // Volver a ejecutar fetchReports() para mostrar todos los registros
                    fetchReports();
                });

            }
        });

        let allReports = []; // Variable global para almacenar todos los reportes

        function fetchReports() {
            $.get('{{ url("/api/v1/reports/all") }}', function(data) {
                allReports = data.Data; // Guardar los reportes en la variable global
                populateReportTable({ Data: allReports }); // Mostrar todos los reportes inicialmente
            });
        }

        function fetchUsers() {
            $.get('{{ url("/api/v1/users/all-users") }}', function(data) {
                let userSelect = $('#searchUser');
                userSelect.empty();
                userSelect.append('<option value="">Seleccionar usuario</option>'); // Default option

                data.forEach(user => {
                    let userOption = `<option value="${user.id}">${user.f_name} ${user.l_name}</option>`;
                    userSelect.append(userOption);
                });
            });
        }

        function fetchRefactions() {
            $.get('{{ url("/api/v1/refactions/all") }}', function(response) { 

                let refactionSelect = $('#searchRefaction');
                refactionSelect.empty();
                refactionSelect.append('<option value="">Seleccionar refacción</option>'); // Default option

                // Verificar si la respuesta tiene la estructura esperada
                if (response && response.data && Array.isArray(response.data)) {
                    response.data.forEach(refaction => {
                        let refactionOption = `<option value="${refaction.id}">${refaction.name}</option>`;
                        refactionSelect.append(refactionOption);
                    });
                } else {
                    console.error('Respuesta inesperada de refactions/all:', response);
                }
            });
        }

        function populateReportTable(data) {
            let reportTableBody = $('#reportTableBody');
            reportTableBody.empty(); // Limpiar la tabla antes de llenarla con nuevos datos

            // Verificar si data.Data es un array y tiene datos
            if (Array.isArray(data.Data) && data.Data.length > 0) {
                data.Data.forEach(report => {
                    if (report.register_detail && report.user_details) { // Verificar que existen los datos necesarios
                        report.register_detail.forEach(detail => {
                            if (detail && detail.refaction) { // Verificar que existen los detalles y refacción
                                let reportRow = `
                                <tr data-date="${detail.created_at}" data-user-id="${report.user_details.id}" data-refaction-id="${detail.refaction.id}">
                                    <td>${report.user_details.f_name} ${report.user_details.l_name}</td>
                                    <td>${detail.refaction.name}</td>
                                    <td>${detail.quantity}</td>
                                    <td>${new Date(detail.created_at).toLocaleDateString()} ${new Date(detail.created_at).toLocaleTimeString()}</td>
                                </tr>
                                `;
                                reportTableBody.append(reportRow);
                            } else {
                                console.error('Detail o refaction no está definido:', detail);
                            }
                        });
                    } else {
                        console.error('register_detail o user_details no está definido en el reporte:', report);
                    }
                });

                // Actualizar el texto con el número de resultados
                $('#resultCount').text(`Se obtuvieron ${data.Data.length} resultados.`);
            } else {
                console.error('Data no tiene el formato esperado o está vacía:', data.Data);
                $('#resultCount').text('No se obtuvieron resultados.');
            }
        }


        function filterReportsByUserOrDateAndRefaction(data, searchUser, searchRefaction, startDate, startTime, endDate, endTime) {
            // Verifica que data.Data esté definido y sea un array
            if (!data.Data || !Array.isArray(data.Data)) {
                console.error('Data no está definido o no es un array:', data.Data);
                return [];
            }

            // Convertir fechas y horas a tiempo en milisegundos para comparar
            let start = startDate ? new Date(`${startDate}T${startTime || '00:00'}`).getTime() : null;
            let end = endDate ? new Date(`${endDate}T${endTime || '23:59'}`).getTime() : null;

            // Filtrar los reportes basados en usuario, refacción, fecha, hora, o ambos
            let filteredReports = data.Data.filter(report => {
                let reportDate = new Date(report.created_at).getTime();
                let userMatches = searchUser ? report.user_details.id == searchUser : true;
                let dateMatches = true;

                if (start && end) {
                    dateMatches = (reportDate >= start && reportDate <= end);
                } else if (start) {
                    dateMatches = reportDate >= start;
                } else if (end) {
                    dateMatches = reportDate <= end;
                }

                // Verificar si al menos una refacción coincide
                let refactionMatches = true;
                if (searchRefaction) {
                    refactionMatches = report.register_detail.some(detail => detail.refaction.id == searchRefaction);
                }

                return userMatches && dateMatches && refactionMatches;
            });

            return filteredReports;
        }

        $('#logoutButton').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ url("/api/v1/users/log-out") }}',
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                },
                success: function(response) {
                    localStorage.removeItem('auth_token');
                    window.location.href = '{{ url("/views/login") }}';
                },
                error: function(response) {
                    console.error('Error en la solicitud de cierre de sesión', response);
                }
            });
        });

    </script>

</body>

</html>
