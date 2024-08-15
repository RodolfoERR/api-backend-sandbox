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

        .carousel-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .carousel-image-container img {
            max-width: 80%;
            max-height: 80%;
            height: auto;
            width: 75%;
        }

        .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Barra lateral -->
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar">
            <div class="profile-section">
                <img src="https://www.movilzona.es/app/uploads-movilzona.es/2023/04/fto-perfil.jpg?x=480&y=375&quality=40" alt="Profile">
                <h4>Admin</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="userscrud">Usuarios
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="refacciones">Refacciones
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="types">Tipos
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="locations">Ubicaciones
                        <hr>
                    </a>
                </li>
                <li>
                    <a class="nav-link active" href="racks">Racks
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
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logoutButton">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="centered-text">
            <h2>Bienvenido a Engine Power Components</h2>
        </div>
        <div class="centered-text">
            <p style="text-align: justify; width:70%;">
                En Engine Power Components, podemos proporcionarle árboles de levas y ejes de equilibrio fabricados según sus especificaciones. Ofrecemos prácticamente todo tipo de materiales para aplicaciones de árboles de levas, incluido hierro fundido, hierro dúctil, hierro gris enfriado, hierro dúctil enfriado, forjado, palanquilla de acero y árboles de levas ensamblados.
                También podemos proporcionarle kits que incluyen taqués, seguidores de rodillos, engranajes, pasadores, etc. Nos abastecemos a nivel mundial para poder satisfacer sus necesidades.
            </p>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-image-container">
                        <img src="https://d2hucwwplm5rxi.cloudfront.net/wp-content/uploads/2021/06/11060726/Car-Engines-Parts-Types-Working-More-Cover-110620211103.jpg" class="d-block" alt="Slide 1">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-image-container">
                        <img src="https://d2hucwwplm5rxi.cloudfront.net/wp-content/uploads/2023/03/17063507/car-cylinder-failure-_-Cover-17-3-23.jpg" class="d-block" alt="Slide 2">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-image-container">
                        <img src="https://s41167.pcdn.co/wp-content/uploads/2018/08/Crankshaft-1122x617.jpg" class="d-block" alt="Slide 3">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>

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
                        window.location.href = '{{ url("/views/login") }}';
                    }
                });
            }
        });
    </script>
</body>

</html>
