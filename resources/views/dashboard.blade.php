<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            width: calc(100% - 250px);
            left: 250px;
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
    </style>
</head>
<body>
    <!-- Barra lateral -->
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <div class="profile-section">
                <img src= "https://www.movilzona.es/app/uploads-movilzona.es/2023/04/fto-perfil.jpg?x=480&y=375&quality=40" alt="Profile"> <!-- Ajusta el path de la imagen de perfil -->
                <h4>Admin</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-user-plus"></i>
                        Añadir usuarios
                    </a>
                </li>
            </ul>
        </div>
    </nav>

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
            </ul>
        </div>
    </nav>

    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>





