<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            top: 0;
            left: 0;
            padding-top: 20px;
            width: 250px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #F4F4F4; /* Gris claro de Dropbox */
        }
        .navbar {
            background-color: #007EE5; /* Azul de Dropbox */
            z-index: 1000;
            position: fixed;
            width: -webkit-fill-available;
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
        <a class="navbar-brand" href="#">
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
    <br><br>

<!-- Contenido principal -->
<div class="container mt-5">
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
                        <input type="text" class="form-control" id="code" name="code" value="">
                    </div>
                    <div class="form-group">
                        <label for="fingerprint">Huella</label>
                        <input type="text" class="form-control" id="fingerprint" name="fingerprint" value="">
                    </div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function fetchUsers() {
        $.get('/v1/users/all-users', function(data) {
            let userTableBody = $('#userTableBody');
            userTableBody.empty();
            data.forEach(user => {
                userTableBody.append(`
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.f_name}</td>
                        <td>${user.l_name}</td>
                        <td>${user.phone}</td>
                        <td>${user.fingerprint}</td>
                        <td>${user.active ? 'Sí' : 'No'}</td>
                        <td>${user.code}</td>
                        <td>${user.role_id}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#userModal" onclick="openModal('edit', ${user.id})">Modificar</button>
                            <button class="btn btn-danger" onclick="confirmDelete(${user.id})">Eliminar</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function openModal(action, userId = null) {
        const form = $('#userForm');
        form[0].reset();
        if (action === 'add') {
            $('#userModalLabel').text('Agregar Usuario');
            $('#userId').val('');
        } else if (action === 'edit') {
            $('#userModalLabel').text('Modificar Usuario');
            $.get(`/v1/users/show/${userId}`, function(data) {
                $('#userId').val(data.id);
                $('#email').val(data.email);
                $('#f_name').val(data.f_name);
                $('#l_name').val(data.l_name);
                $('#phone').val(data.phone);
                $('#active').val(data.active);
                $('#code').val(data.code);
                $('#role_id').val(data.role_id);
            });
        }
    }

    function confirmDelete(userId) {
        if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
            $.ajax({
                url: `/v1/users/delete/${userId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Usuario eliminado exitosamente');
                    fetchUsers();
                },
                error: function(response) {
                    alert('Error al eliminar el usuario.');
                }
            });
        }
    }

    $('#userForm').submit(function(e) {
        e.preventDefault();
        let id = $('#userId').val();
        let method = id ? 'PUT' : 'POST';
        let url = id ? `/v1/users/update/${id}` : '/v1/users/create';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                alert('Usuario guardado exitosamente');
                $('#userModal').modal('hide');
                fetchUsers();
            },
            error: function(response) {
                alert('Error al guardar los datos.');
            }
        });
    });

    $(document).ready(function() {
        fetchUsers();
        // Cargar roles dinámicamente
        $.get('/v1/roles/all-roles', function(data) {
            let roleSelect = $('#role_id');
            roleSelect.empty(); // Limpiar opciones anteriores
            data.forEach(role => {
                roleSelect.append(new Option(role.name, role.id));
            });
        });
    });

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
                    window.location.href = '{{ url("http://127.0.0.1:8000") }}';
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
