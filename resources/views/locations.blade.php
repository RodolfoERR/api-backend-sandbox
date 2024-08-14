<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones</title>
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

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn {
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .modal-header {
            background-color: #007EE5;
            color: #FFFFFF;
        }

        .modal-content {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="dashboard">
            Control de almacén
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="search-bar ml-auto">
                <!--<i class="fas fa-search"></i>
                <input type="search" placeholder="Buscar">-->
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logoutButton">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

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
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <h1>Ubicaciones</h1>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#locationModal" onclick="openModal('add')">Agregar Ubicación</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="locationTableBody">
                <!-- Los datos de las ubicaciones se cargarán aquí -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Agregar/Modificar Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="locationForm">
                        @csrf
                        <input type="hidden" id="locationId">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Nivel</label>
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option selected>Selecciona opción</option>
                                <option value="1">lvl1</option>
                                <option value="2">lvl2</option>
                                <option value="3">lvl3</option>
                                <option value="4">lvl4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rack_id">Rack</label>
                            <select class="form-control" id="rack_id" name="rack_id" required>
                                <option selected>Selecciona un rack</option>
                                <!-- Los racks se cargarán aquí -->
                            </select>
                        </div>

                        <!--<div class="form-group">
                            <label for="active">Activo</label>
                            <select class="form-control" id="active" name="active" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>-->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var authToken = localStorage.getItem('auth_token');

            if (!authToken) {
                window.location.href = '{{ url("/views/login") }}';
            } else {
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

                // Configure default headers for all AJAX requests
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    }
                });

                fetchLocations();
                fetchRacks();
            }
        });

        function fetchLocations() {
            $.get('{{ url("/api/v1/locations/all-locations") }}', function(data) {
                let locationTableBody = $('#locationTableBody');
                locationTableBody.empty();
                data.data.forEach(location => {
                    let locationRow = `
                        <tr>
                            <td>${location.id}</td>
                            <td>${location.name}</td>
                            <td>${location.level.name}</td>
                            <td>
                                <button class="btn btn-warning" onclick="openModal('edit', ${location.id})">Editar</button>
                                <button class="btn btn-danger" onclick="deleteLocation(${location.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    locationTableBody.append(locationRow);
                });
            });
        }
        function fetchRacks() {
            $.get('{{ url("/api/v1/racks/all") }}', function(data) {
                let rackSelect = $('#rack_id');
                rackSelect.empty();
                data.data.forEach(rack => {
                    let rackOption = `<option value="${rack.id}">${rack.name}</option>`;
                    rackSelect.append(rackOption);
                });
            });
        }


        function openModal(mode, id) {
            $('#locationForm')[0].reset();

            if (mode === 'edit' && id) {
                $.ajax({
                    url: '/api/v1/locations/by/' + id,
                    method: 'GET',
                    success: function(response) {
                        let location = response.data;
                        $('#locationId').val(location.id);
                        $('#name').val(location.name);
                        $('#level_id').val(location.level.id); // Asegúrate de usar location.level.id si así se llama en la respuesta del servidor
                        $('#rack_id').val(location.rack_id);
                        console.log("El id es "+location.id);
                    },
                    error: function(xhr, status, error) {
                        var errorMsg = xhr.responseJSON.message || 'Error al cargar los datos de la ubicación.';
                        alert(errorMsg);
                    }
                });
            }

            $('#locationModalLabel').text(mode === 'edit' ? 'Editar Ubicación' : 'Agregar Ubicación');
            $('#locationModal').modal('show');
        }


        $('#locationForm').on('submit', function(event) {
            event.preventDefault();

            var locationId = $('#locationId').val();
            var url = locationId ? '{{ url("/api/v1/locations/update") }}/' + locationId : '{{ url("/api/v1/locations/create") }}';
            var method = locationId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    $('#locationModal').modal('hide');
                    fetchLocations();
                    fetchRacks();
                },
                error: function(xhr) {
                    alert('Error al guardar: ' + xhr.responseText);
                }
            });
        });

        function deleteLocation(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta ubicación?')) {
                $.ajax({
                    url: '{{ url("/api/v1/locations/delete") }}/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        fetchLocations();
                        fetchRacks();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        }

        $('#logoutButton').click(function() {
            localStorage.removeItem('auth_token');
            window.location.href = '{{ url("/views/login") }}';
        });
    </script>
</body>

</html>