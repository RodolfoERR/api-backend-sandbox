<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
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
            background-color: #FFFFFF;
        }
        .verification-card {
            border-radius: 1rem;
            padding: 2rem;
            background: #e0e0e0;
            text-align: center;
        }
        .verification-card .form-control {
            display: inline-block;
            width: 40px;
            text-align: center;
            margin: 0 5px;
        }
        .btn-custom {
            background-color: #007EE5; /* Azul de Dropbox */
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
        }
        .btn-custom:hover {
            background-color: #005bb5;
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
                                <!-- Imagen de lado izquierdo -->
                                <img src="https://img.freepik.com/foto-gratis/mecanico-automoviles-revisando-aceite-motor-automovil-mientras-trabaja-taller-reparacion-automoviles_637285-4299.jpg" alt="login form" class="img-fluid card-img-left" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <!-- Formulario de inicio de sesión -->
                                    <form id="loginForm" method="POST" action="{{ url('/api/v1/users/log-in') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3 text-primary"> </i>
                                            <span class="h1 fw-bold mb-0"> Control de Almacén</span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>
                                        <div class="form-outline mb-4" id="loginFields">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" required />
                                            <label class="form-label" for="form2Example17">Usuario o Correo Electrónico</label>
                                        </div>
                                        <div class="form-outline mb-4" id="passwordField">
                                            <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" required />
                                            <label class="form-label" for="form2Example27">Contraseña</label>
                                        </div>
                                        <div class="pt-1 mb-4" id="loginButtonField">
                                            <button class="btn btn-primary btn-lg btn-block" type="button" id="loginButton">Ingresar</button>
                                        </div>
                                        <!-- Mensaje de error -->
                                        <div id="error-message" class="alert alert-danger d-none"></div>
                                        <!-- Campo de código de verificación (inicialmente oculto) -->
                                        <div class="form-outline mb-4 d-none" id="verificationField">
                                            <input type="text" id="form2Example37" class="form-control form-control-lg" name="code" required value="" />
                                            <br>
                                            <label class="form-label" for="form2Example37">Código de verificación</label>
                                            <br>
                                            <button id="verificationButton" type="button" class="btn btn-primary">Verificar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginButton').click(function(e) {
                e.preventDefault(); // Previene el comportamiento por defecto del botón (enviar el formulario)

                var form = $('#loginForm'); // Selecciona el formulario de inicio de sesión por su ID

                // Envía una solicitud AJAX al servidor
                $.ajax({
                    url: form.attr('action'), // URL a la que se enviará la solicitud (definida en el atributo 'action' del formulario)
                    method: form.attr('method'), // Método HTTP de la solicitud (GET, POST, etc., definido en el atributo 'method' del formulario)
                    data: form.serialize(), // Datos del formulario serializados para enviar al servidor

                    // Función que se ejecuta si hay un error en la solicitud AJAX
                    error: function(response) {
                        // Si la respuesta tiene el mensaje específico de error de verificación
                        if (response.responseJSON.message === 'unsuccessful...' && response.responseJSON.errors && response.responseJSON.errors.code) {
                            // Ocultar los campos de login y mostrar el campo de verificación
                            $('#loginFields, #passwordField, #loginButtonField').addClass('d-none');
                            $('#verificationField').removeClass('d-none');

                            // Opcional: Puedes mostrar un mensaje adicional al usuario si lo deseas
                            alert('Por favor, revisa tu correo electrónico. Se ha generado y enviado un código.');
                        } else {
                            // Si no es la respuesta esperada, muestra un mensaje genérico de error
                            $('#error-message').removeClass('d-none').text('Datos incorrectos, verifíquelos.');
                        }
                    }
                });
            });

            $('#verificationButton').click(function(e) {
                e.preventDefault(); // Previene el comportamiento por defecto del botón (enviar el formulario)

                var form = $('#loginForm'); // Selecciona el formulario de inicio de sesión por su ID

                // Envía una solicitud AJAX al servidor para la verificación del código
                $.ajax({
                    url: form.attr('action'), // URL a la que se enviará la solicitud (definida en el atributo 'action' del formulario)
                    method: form.attr('method'), // Método HTTP de la solicitud (GET, POST, etc., definido en el atributo 'method' del formulario)
                    data: form.serialize(), // Datos del formulario serializados para enviar al servidor

                    // Función que se ejecuta si la solicitud AJAX es exitosa
                    success: function(response) {
                        if (response.message === 'Welcome' && response.token) {
                            // Almacenar el token en localStorage
                            localStorage.setItem('auth_token', response.token);
                            // Verificar si el token está presente en localStorage
                            var authToken = localStorage.getItem('auth_token');
                            // Verificar si el usuario intenta acceder a una ruta protegida sin token
                            if (!authToken && window.location.pathname !== '{{ url("/api/v1/users/log-in") }}') {
                                window.location.href = '{{ url("/api/v1/users/log-in") }}'; // Redirigir al login si no hay token
                            }else{
                                // Redirige a la página del dashboard (Falta proteger la ruta del dashboard)
                                window.location.href = '{{ url("/dashboard") }}';
                            }

                        } else {
                            // Muestra un mensaje genérico de error
                            $('#error-message').removeClass('d-none').text('Error en la verificación. Por favor, inténtelo de nuevo.');
                        }
                    },
                    error: function(response) {
                        // Muestra un mensaje genérico de error
                        $('#error-message').removeClass('d-none').text('Error en la verificación. Por favor, inténtelo de nuevo.');
                    }
                });
            });
        });
    </script>
</body>
</html>