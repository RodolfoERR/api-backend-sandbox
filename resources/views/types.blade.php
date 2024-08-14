<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos</title>
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
        .navbar-brand, .nav-link {
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
        .table th, .table td {
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
                <!--<li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-comments"></i></a>
                </li>-->
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
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <h1>Tipos</h1>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#typeModal" onclick="openModal('add')">Agregar Tipo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="typeTableBody">
                <!-- Los datos de los tipos se cargarán aquí -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="typeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="typeModalLabel">Agregar/Modificar Tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="typeForm">
                        @csrf
                        <input type="hidden" id="typeId">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
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

                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    }
                });
            }

            fetchTypes();
        });

        function fetchTypes() {
            $.ajax({
                url: '{{ url("/api/v1/types/all-types") }}',
                method: 'GET',
                success: function(response) {
                    var typeTableBody = $('#typeTableBody');
                    typeTableBody.empty();

                    if (response.data && response.data.length) {
                        response.data.forEach(function(type) {
                            var typeRow = `<tr>
                                <td>${type.id}</td>
                                <td>${type.name}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="openModal('edit', ${type.id}, '${type.name}')">Editar</button>
                                    <!--<button class="btn btn-danger" onclick="deleteType(${type.id})">Eliminar</button>-->
                                </td>
                            </tr>`;
                            typeTableBody.append(typeRow);
                        });
                    } else {
                        var emptyRow = `<tr><td colspan="3">No hay tipos disponibles</td></tr>`;
                        typeTableBody.append(emptyRow);
                    }
                },
                error: function(error) {
                    console.error('Error al obtener los tipos:', error);
                }
            });
        }

        function openModal(mode, id = null, name = '') {
            $('#typeForm')[0].reset();
            $('#typeId').val('');
            $('#name').val('');
            
            if (mode === 'edit') {
                $('#typeModalLabel').text('Editar Tipo');
                $('#typeId').val(id);
                $('#name').val(name);
            } else {
                $('#typeModalLabel').text('Agregar Tipo');
            }
            
            $('#typeModal').modal('show');
        }

        $('#typeForm').submit(function(event) {
            event.preventDefault();

            var typeId = $('#typeId').val();
            var url = typeId ? '{{ url("/api/v1/types/update") }}/' + typeId : '{{ url("/api/v1/types/create") }}';
            var method = typeId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    name: $('#name').val()
                },
                success: function(response) {
                    $('#typeModal').modal('hide');
                    fetchTypes();
                },
                error: function(error) {
                    console.error('Error al guardar el tipo:', error);
                }
            });
        });

        function deleteType(id) {
            // Implementar la función de eliminación aquí
        }

        $('#logoutButton').click(function() {
            localStorage.removeItem('auth_token');
            window.location.href = '{{ url("/views/login") }}';
        });
    </script>
</body>
</html>
