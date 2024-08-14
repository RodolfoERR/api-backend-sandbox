<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refacciones</title>
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
            Control de Almacén
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

    <!-- ... -->

<div class="main-content">
    <h1>Refacciones</h1>
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#refactionModal" onclick="openModal('add')">Agregar Refacción</button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad Total</th>
                <th>Precio Unitario</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="refactionTableBody">
            <!-- Los datos de las refacciones se cargarán aquí -->
        </tbody>
    </table>
</div>

<!-- Modal para agregar/modificar refacciones -->
<div class="modal fade" id="refactionModal" tabindex="-1" role="dialog" aria-labelledby="refactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refactionModalLabel">Agregar/Modificar Refacción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="refactionForm">
                    @csrf
                    <input type="hidden" id="refactionId">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="total_quantity">Cantidad Total</label>
                        <input type="number" class="form-control" id="total_quantity" name="total_quantity" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Precio Unitario</label>
                        <input type="number" class="form-control" id="unit_price" name="unit_price" min="0" required>
                        <span id="display-value"></span>
                        <span id="error-message" style="color: red; display: none;"></span>
                    </div>
                    <div class="form-group">
                        <label for="type_id">Tipo</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option selected>Selecciona opción</option>
                            <!-- Los tipos se cargarán aquí -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location_id">Ubicación</label>
                        <select class="form-control" id="location_id" name="location_id" required>
                            <option selected>Selecciona opción</option>
                            <!-- Las ubicaciones se cargarán aquí -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var authToken = localStorage.getItem('auth_token');
            console.log("El token es: "+ authToken);
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
                // Configure default headers for all AJAX requests
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    }
                });
                fetchRefactions();
                // Llamar a las funciones para cargar los tipos y ubicaciones
                fetchTypes();
                fetchLocations();
            }
        });


        function fetchRefactions() {
        $.get('{{ url("/api/v1/refactions/all") }}', function(data) {
            let refactionTableBody = $('#refactionTableBody');
            refactionTableBody.empty();
            data.data.forEach(refaction => {
            if (refaction.active === 1) { // Filtrar solo los registros con active = 1
                let refactionRow = `
                <tr>
                    <td>${refaction.id}</td>
                    <td>${refaction.name}</td>
                    <td>${refaction.description}</td>
                    <td>${refaction.total_quantity}</td>
                    <td>${refaction.unit_price}</td>
                    <td>${refaction.type.name}</td>
                    <td>${refaction.location.name}</td>
                    <td><img src="${refaction.image_url}" alt="Imagen de la refacción" width="50"></td>
                    <td>
                    <button class="btn btn-warning" onclick="openModal('edit', ${refaction.id})">Editar</button>
                    <button class="btn btn-danger" onclick="deleteRefaction(${refaction.id})">Eliminar</button>
                    </td>
                </tr>
                `;
                refactionTableBody.append(refactionRow);
            }
            });
        });
        }

        function openModal(mode, id) {
            $('#refactionForm')[0].reset();

            if (mode === 'edit' && id) {
            $.ajax({
                url: '/api/v1/refactions/by/' + id,
                method: 'GET',
                success: function(response) {
                    let refaction = response.data;
                    $('#refactionId').val(refaction.id);
                    $('#name').val(refaction.name);
                    $('#description').val(refaction.description);
                    $('#total_quantity').val(refaction.total_quantity);
                    $('#unit_price').val(refaction.unit_price);
                    $('#type_id').val(refaction.type.id);
                    $('#location_id').val(refaction.location.id);
                    
                    // Agregar el nombre de la imagen al input de tipo file
                    $('#image').attr('data-image-name', refaction.image);
                    
                    // Mostrar la previsualización de la imagen
                    var imageUrl = '{{ url("/images/") }}/' + refaction.image;
                    var imagePreview = $('<img>').attr('src', imageUrl).attr('width', '100px');
                    $('#image-preview').html(imagePreview);
                },
                error: function(xhr, status, error) {
                    var errorMsg = xhr.responseJSON.message || 'Error al cargar los datos de la refacción.';
                    alert(errorMsg);
                }
            });
        }

            $('#refactionModalLabel').text(mode === 'edit' ? 'Editar Refacción' : 'Agregar Refacción');
            $('#refactionModal').modal('show');
        }

        $('#refactionForm').on('submit', function(event) {
            event.preventDefault();

            var refactionId = $('#refactionId').val();
            var url = refactionId? '{{ url("/api/v1/refactions/update") }}/' + refactionId : '{{ url("/api/v1/refactions/create") }}';
            var method = refactionId? 'POST' : 'POST';

            var formData = new FormData(this);
            var fileInput = $('#image')[0];
            var file = fileInput.files[0];

            if (file) {
                formData.append('image', file);
            }

            $.ajax({
                url: url,
                method: method,
                data: formData, 
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#refactionModal').modal('hide');
                    fetchRefactions();
                    console.log("El modo que se eligió fue: " + url);
                },
                error: function(xhr, status, error) {
                    if (xhr.status!== 200) {
                        alert('Error al guardar: ' + xhr.responseText);
                    }
                }
            });
        });

        function deleteRefaction(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta refacción?')) {
                $.ajax({
                    url: '{{ url("/api/v1/refactions/delete") }}/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        fetchRefactions();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        }

        // Cargar tipos y ubicaciones en los selectores
        function fetchTypes() {
            $.get('{{ url("/api/v1/types/all-types") }}', function(data) {
                let typeSelect = $('#type_id');
                typeSelect.empty();
                data.data.forEach(type => {
                    let typeOption = `<option value="${type.id}">${type.name}</option>`;
                    typeSelect.append(typeOption);
                });
            });
        }

        function fetchLocations() {
            $.get('{{ url("/api/v1/locations/all-locations") }}', function(data) {
                let locationSelect = $('#location_id');
                locationSelect.empty();
                data.data.forEach(location => {
                    let locationOption = `<option value="${location.id}">${location.name}</option>`;
                    locationSelect.append(locationOption);
                });
            });
        }

        const cantidadInput = document.getElementById("unit_price");
        const errorMessage = document.getElementById("error-message");
        const displayValue = document.getElementById("display-value"); // Add a new element to display the formatted value

        cantidadInput.addEventListener("input", function() {
        let valor = parseFloat(this.value.replace(/[$,]/g, '')); // Remove any non-numeric characters

        if (valor < 0) {
            errorMessage.textContent = "Solo se permiten valores mayores a 0.";
            valor = 1; // Si el valor es negativo, se establece en 0
            errorMessage.style.display = "block"; // Mostrar el mensaje de error
        } else {
            errorMessage.textContent = ""; // Limpiar el mensaje de error
            errorMessage.style.display = "none"; // Ocultar el mensaje de error
        }

        // Formato de moneda
        const formattedValue = valor.toLocaleString('en-US', { style: 'currency', currency: 'MXN' });
        displayValue.textContent = formattedValue; // Update the display element with the formatted string
        });

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
