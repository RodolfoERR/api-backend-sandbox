<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        <tbody>
            <tr>
                <td>1</td>
                <td>Juan</td>
                <td>Pérez</td>
                <td>1234567890</td>
                <td>Pendiente</td>
                <td>Sí</td>
                <td>1234</td>
                <td>Administrador</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#userModal" onclick="openModal('edit', 1)">Modificar</button>
                    <button class="btn btn-danger" onclick="confirmDelete(1)">Eliminar</button>
                </td>
            </tr>
            <!-- Añadir más filas según sea necesario -->
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
                        <input type="text" class="form-control" id="phone" name="phone">
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
                        <input type="text" class="form-control" id="code" name="code">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                            <!-- Añadir más roles según sea necesario -->
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openModal(action, userId = null) {
        const form = document.getElementById('userForm');
        if (action === 'add') {
            document.getElementById('userModalLabel').innerText = 'Agregar Usuario';
            form.reset();
        } else if (action === 'edit') {
            document.getElementById('userModalLabel').innerText = 'Modificar Usuario';
            // Aquí se puede llenar el formulario con los datos del usuario si estuviera conectado a un back-end
            // Ejemplo: document.getElementById('f_name').value = 'Juan';
        }
    }

    function confirmDelete(userId) {
        if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
            // Aquí se puede agregar la lógica para eliminar el usuario si estuviera conectado a un back-end
            console.log('Usuario eliminado: ' + userId);
        }
    }
</script>
</body>
</html> 
