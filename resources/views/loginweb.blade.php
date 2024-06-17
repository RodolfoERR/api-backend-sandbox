<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .vh-100 {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .vh-100::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://wallpapercave.com/wp/wp10981468.jpg') no-repeat center center/cover;
            filter: blur(5px);
            z-index: -1;
        }
        .card {
            border-radius: 1rem;
            background-color: #FFFFFF; /* Blanco */
        }
        .card-img-left {
            border-radius: 1rem 0 0 1rem;
        }
        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-label {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            transition: 0.3s ease;
            color: #6c757d;
        }
        .form-control:focus ~ .form-label,
        .form-control:not(:placeholder-shown) ~ .form-label {
            top: -0.75rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: #495057;
        }
        .btn-primary {
            background-color: #007EE5; /* Azul de Dropbox */
            border: none;
        }
        .btn-primary:hover {
            background-color: #005bb5;
        }
        .text-primary {
            color: #007EE5 !important; /* Azul de Dropbox */
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://img.freepik.com/foto-gratis/mecanico-automoviles-revisando-aceite-motor-automovil-mientras-trabaja-taller-reparacion-automoviles_637285-4299.jpg"
                                 alt="login form" class="img-fluid card-img-left" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3 text-primary"> </i>
                                        <span class="h1 fw-bold mb-0"> Control de Almacén</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="form2Example17" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example17">Usuario o Correo Electrónico</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="form2Example27" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example27">Contraseña</label>
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="button">Ingresar</button>
                                    </div>
                                    <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






