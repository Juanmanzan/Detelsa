<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Detelsa</title>
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --detelsa-primary: #2A7B9B;
            --detelsa-secondary: #3CC274;
            --detelsa-gradient: linear-gradient(135deg, var(--detelsa-primary), var(--detelsa-secondary), var(--detelsa-primary));
        }
        
        body {
            background: var(--detelsa-gradient);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-box {
            width: 400px;
            margin: 0 auto;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .login-logo a {
            color: white;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .login-logo .subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            margin-top: 5px;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: none;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            text-align: center;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-right: none;
        }
        
        .form-control {
            border-left: none;
            padding-left: 10px;
            height: 45px;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(26, 42, 108, 0.25);
            border-color: #1a2a6c;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #1a2a6c;
            color: #1a2a6c;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--detelsa-primary), var(--detelsa-secondary));
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-block {
            width: 100%;
        }
        
        .icheck-primary input[type="checkbox"]:checked + label::before {
            background-color: var(--detelsa-primary);
            border-color: var(--detelsa-primary);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        
        .login-footer a {
            color: white;
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            cursor: pointer;
            z-index: 1000;
        }
        
        .login-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            opacity: 0.1;
            z-index: -1;
        }
        
        .welcome-message {
            color: black;
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        @media (max-width: 480px) {
            .login-box {
                width: 100%;
            }
            
            .card-body {
                padding: 25px 20px;
            }
            
            .login-logo a {
                font-size: 28px;
            }
        }
        .logo-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
       }
    </style>
</head>
<body>

    <div class="login-bg"></div>

    <div class="login-box">

        <div class="card">
            <div class="login-logo" style="text-align: center;">
                    <a href="{{ route('admin') }}" style="display: inline-block;">
                        <b style="display: block;  color: black;">Detelsa</b>
                        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" class="logo-img" />
                    </a>
            </div>

                <div class="welcome-message">
                    Autentíquese para iniciar sesión
                </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Usuario --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" name="username" class="form-control"
                               placeholder="Usuario" value="{{ old('username') }}" required autofocus>
                    </div>

                    {{-- Contraseña --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    {{-- Recordarme --}}
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Botón de Acceso --}}
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>Acceder
                            </button>
                        </div>
                    </div>

                    {{-- Mostrar errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/ocultar contraseña
        $(document).on('click', '.toggle-password', function () {
            const input = $('#password');
            const icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    </script>
</body>
</html>