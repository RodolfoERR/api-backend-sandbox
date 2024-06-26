<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    </style>
</head>
<body>
    <!-- Barra lateral -->
    <nav class="col-md-2 d-none d-md-block sidebar">
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

    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
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
    <script>
        $(document).ready(function() {
        // Verificar si hay un token en localStorage
        var authToken = localStorage.getItem('auth_token');

        if (!authToken) {
            // Redirigir al login si no hay token
            window.location.href = '{{ url("/views/login") }}';
        } else {
            // Opcional: Verificar el token con una solicitud al servidor para asegurarse de que es válido
            $.ajax({
                url: '{{ url("/api/v1/users/get-Myself") }}', // Ruta para obtener información del usuario autenticado
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + authToken
                },
                success: function(response) {
                    // Token válido, el usuario puede permanecer en la página
                    console.log('Usuario autenticado:', response);
                },
                error: function(xhr, status, error) {
                    // Token no válido, redirigir al login
                    localStorage.removeItem('auth_token');
                    window.location.href = '{{ url("/views/loginweb") }}';
                }
            });
        }
    });
    </script>
</body>
</html>
