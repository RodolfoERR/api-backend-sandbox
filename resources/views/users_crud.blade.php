<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card-header {
            background-color: #007EE5; /* Azul de Dropbox */
            color: white;
        }
        .sidebar {
            height: 100vh;
            background-color: #3D3D3D; /* Gris oscuro de Dropbox */
            color: white;
            position: fixed;
            top: 56px; /* Altura de la barra de navegación */
            left: 0;
            padding-top: 20px;
            width: 250px;
            overflow-y: auto;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #F4F4F4; /* Gris claro de Dropbox */
            margin-top: 56px; /* Altura de la barra de navegación */
        }
        .navbar {
            background-color: #007EE5; /* Azul de Dropbox */
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
            margin-top: 56px; /* Altura de la barra de navegación */
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
            background-color: #FFFFFF; /* Blanco */
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
    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="dashboard">
            Control de almacén
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="search-bar ml-auto">
                <i class="fas fa-search"></i>
                <input type="search" placeholder="Buscar">
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-comments"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logoutButton">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Barra lateral -->
    <nav class="sidebar">
        <div class="sidebar-sticky">
            <div class="profile-section">
                <img src="https://www.movilzona.es/app/uploads-movilzona.es/2023/04/fto-perfil.jpg?x=480&y=375&quality=40" alt="Profile"> <!-- Ajusta el path de la imagen de perfil -->
                <h4>Admin</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="userscrud">
                        <i class="fas fa-user-plus"></i>
                        Usuarios
                        <hr>
                    </a>
                </li>
                <li>
                <a class="nav-link active" href="refacciones">
                        <i class="fas fa-user-plus"></i>
                        Refacciones
                        <hr>
                    </a>
                </li>
                <li>
                <a class="nav-link active" href="historyrefacciones">
                        <i class="fas fa-user-plus"></i>
                        Historial de Refacciones
                        <hr>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="main-content">
        <h1>Usuarios</h1>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal" onclick="openModal('add')">Agregar Usuario</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Huella</th>
                    <th>Activo</th>
                    <th>Código</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Los datos de los usuarios se cargarán aquí -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Agregar/Modificar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        <input type="hidden" id="userId">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="f_name">Nombre</label>
                            <input type="text" class="form-control" id="f_name" name="f_name" required>
                        </div>
                        <div class="form-group">
                            <label for="l_name">Apellido</label>
                            <input type="text" class="form-control" id="l_name" name="l_name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="active">Activo</label>
                            <select class="form-control" id="active" name="active">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="hidden" class="form-control" id="code" name="code" value="000000">
                        </div>
                        <!--<div class="form-group">
                            <label for="fingerprint">Huella</label>
                            <input type="text" class="form-control" id="fingerprint" name="fingerprint" value="">
                        </div>-->

                        <div class="form-group">
                            <label for="role_id">Rol</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <!-- Opciones de rol se cargarán dinámicamente -->
                            </select>
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

                fetchUsers();
                loadRoles();
            }
        });

        function fetchUsers() {
            $.get('{{ url("/api/v1/users/all-users") }}', function(data) {
                let userTableBody = $('#userTableBody');
                userTableBody.empty();
                data.forEach(user => {
                    let userRow = `
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.f_name}</td>
                            <td>${user.l_name}</td>
                            <td>${user.phone}</td>
                            <td>${user.fingerprint}</td>
                            <td>${user.active}</td>
                            <td>${user.code}</td>
                            <td>${user.role_id}</td>
                            <td>
                                <button class="btn btn-warning" onclick="openModal('edit', ${user.id})">Editar</button>
                                <button class="btn btn-danger" onclick="deleteUser(${user.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    userTableBody.append(userRow);
                });
            });
        }

        function loadRoles() {
            $.get('{{ url("/api/v1/roles/all-roles") }}', function(data) {
                let roleSelect = $('#role_id');
                roleSelect.empty();
                data.forEach(role => {
                    let roleOption = `<option value="${role.id}">${role.name}</option>`;
                    roleSelect.append(roleOption);
                });
            });
        }

        function openModal(type, id = null) {
            $('#userForm')[0].reset();
            $('#userId').val('');

            if (type === 'edit' && id) {
                $.ajax({
                    url: '/api/v1/users/show/' + id,
                    method: 'GET',
                    success: function(data) {
                        $('#userId').val(data.id);
                        $('#email').val(data.email);
                        $('#f_name').val(data.f_name);
                        $('#l_name').val(data.l_name);
                        $('#phone').val(data.phone);
                        $('#active').val(data.active);
                        $('#code').val(data.code);
                        $('#fingerprint').val(data.fingerprint);
                        $('#role_id').val(data.role_id);
                    },
                    error: function(xhr, status, error) {
                        var errorMsg = xhr.responseJSON.message || 'Error al cargar los datos del usuario.';
                        alert(errorMsg);
                    }
                });
            }

            $('#userModal').modal('show');
        }


        $('#userForm').submit(function(e) {
            e.preventDefault();
            let id = $('#userId').val();
            let method = id ? 'PUT' : 'POST';
            let url = id ? '/api/v1/users/update/' + id : '/api/v1/users/create';

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    alert('Usuario guardado exitosamente');
                    $('#userModal').modal('hide');
                    fetchUsers();
                },
                error: function(xhr, status, error) {
                    let errorMsg = 'Error al guardar los datos.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                }
            });
        });

        function deleteUser(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: '/api/v1/users/delete/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        alert('Usuario eliminado exitosamente');
                        fetchUsers();
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = 'Error al eliminar el usuario.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        alert(errorMsg);
                    }
                });
            }
        }

        $(document).ready(function() {
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
        });
    </script>
</body>
</html>
