<!-- contrasena.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Credenciales | Detelsa</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-box {
            width: 400px;
            margin: 0 auto;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: none;
            background: white;
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
        
        .btn-primary {
            background: linear-gradient(to right, var(--detelsa-primary), var(--detelsa-secondary));
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .password-strength {
            height: 5px;
            background: #eee;
            border-radius: 3px;
            margin-top: 10px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0%;
            background: #b21f1f;
            transition: width 0.3s;
        }
        
        .hidden {
            display: none;
        }
        
        .alert {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .logo-container {
            text-align: center;
            padding: 15px 0;
        }
        
        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--detelsa-primary);
        }
        
        .app-name {
            font-size: 24px;
            font-weight: bold;
            color: var(--detelsa-primary);
            margin-top: 10px;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--detelsa-primary);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            color: var(--detelsa-secondary);
            text-decoration: underline;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #444;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            color: white;
            font-size: 14px;
        }
        
        .footer a {
            color: white;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        .input-group {
            margin-bottom: 15px;
        }
        
        .note {
            font-size: 13px;
            color: #6c757d;
            margin-top: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="card">
            <div class="logo-container">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Detelsa" class="logo-img">
                <div class="app-name">Detelsa</div>
            </div>
            
            <div class="card-header">
                <span id="formHeader">Actualizar Credenciales</span>
            </div>
            
            <div class="card-body">
                <div class="alert alert-success hidden" id="successMessage"></div>
                <div class="alert alert-danger hidden" id="errorMessage"></div>
                
                <!-- Formulario de verificación -->
                <div id="verificationForm">
                    <div class="form-title">Confirma tu identidad para actualizar tus credenciales</div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" id="currentPassword" class="form-control" 
                               placeholder="Contraseña actual" required autofocus>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="verifyBtn" class="btn btn-primary">
                                <i class="fas fa-check-circle mr-2"></i>Verificar identidad
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Formulario de actualización (inicialmente oculto) -->
                <div id="updateForm" class="hidden">
                    <div class="form-title">Actualiza tus credenciales</div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="Administrador" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-crown"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-at"></i>
                            </span>
                        </div>
                        <input type="text" id="username" class="form-control" 
                               placeholder="Nuevo nombre de usuario (dejar vacío para mantener actual)" 
                               value="{{ Auth::user()->username }}">
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" id="newPassword" class="form-control" 
                               placeholder="Nueva contraseña (dejar vacío para mantener actual)">
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter" id="strengthMeter"></div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" id="confirmPassword" class="form-control" 
                               placeholder="Confirmar nueva contraseña">
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="updateBtn" class="btn btn-primary">
                                <i class="fas fa-sync-alt mr-2"></i>Actualizar Credenciales
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Enlace para volver -->
                <a href="{{ route('admin') }}" id="backToAdminPanel" class="back-link">
                    <i class="fas fa-arrow-left mr-1"></i>Volver al panel de administración
                </a>
            </div>
        </div>
        
    </div>

    <script>
        // Estado de la aplicación
        let isVerified = false;
        let currentUser = "{{ Auth::user()->username }}";
        
        // Elementos del DOM
        const verificationForm = document.getElementById('verificationForm');
        const updateForm = document.getElementById('updateForm');
        const verifyBtn = document.getElementById('verifyBtn');
        const updateBtn = document.getElementById('updateBtn');
        const backToAdminPanel = document.getElementById('backToAdminPanel');
        const formHeader = document.getElementById('formHeader');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const newPasswordInput = document.getElementById('newPassword');
        const strengthMeter = document.getElementById('strengthMeter');
        const usernameInput = document.getElementById('username');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordNote = document.getElementById('passwordNote');
        
        // Función para mostrar mensajes
        function showMessage(element, message) {
            element.textContent = message;
            element.classList.remove('hidden');
            setTimeout(() => element.classList.add('hidden'), 5000);
        }
        
        // Función para mostrar formulario de actualización
        function showUpdateForm() {
            verificationForm.classList.add('hidden');
            updateForm.classList.remove('hidden');
            formHeader.textContent = 'Actualizar Credenciales';
            isVerified = true;
        }
        
        // Función para cerrar formulario de actualización
        function closeUpdateForm() {
            verificationForm.classList.remove('hidden');
            updateForm.classList.add('hidden');
            formHeader.textContent = 'Actualizar Credenciales';
            isVerified = false;
            
            // Limpiar campos
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
            strengthMeter.style.width = '0%';
            passwordNote.textContent = 'La contraseña debe tener al menos 6 caracteres';
            passwordNote.style.color = '#6c757d';
        }
        
        // Validación de contraseña en tiempo real
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length > 0 && password.length < 6) {
                passwordNote.textContent = 'La contraseña debe tener al menos 6 caracteres';
                passwordNote.style.color = '#b21f1f';
                strengthMeter.style.width = '0%';
                return;
            }
            
            // Restablecer mensaje si cumple la longitud mínima
            if (password.length >= 6) {
                passwordNote.textContent = 'Fortaleza de la contraseña:';
                passwordNote.style.color = '#6c757d';
            }
            
            let strength = 0;
            if (password.length >= 6) strength += 30;
            if (password.length > 7) strength += 10;
            if (/[A-Z]/.test(password)) strength += 20;
            if (/\d/.test(password)) strength += 20;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            strength = Math.min(strength, 100);
            strengthMeter.style.width = strength + '%';
            
            // Cambiar color según fortaleza
            if (strength < 50) {
                strengthMeter.style.backgroundColor = '#b21f1f';
            } else if (strength < 75) {
                strengthMeter.style.backgroundColor = '#e67e22';
            } else {
                strengthMeter.style.backgroundColor = '#27ae60';
            }
        });
        
        // Botón de verificación
        verifyBtn.addEventListener('click', async function() {
            const password = document.getElementById('currentPassword').value;
            
            if (!password) {
                showMessage(errorMessage, 'Por favor ingresa tu contraseña actual');
                return;
            }
            
            // Mostrar carga
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verificando...';
            verifyBtn.disabled = true;
            
            try {
                const response = await fetch("{{ route('verificar.password') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        password: password
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showUpdateForm();
                    showMessage(successMessage, 'Identidad verificada correctamente');
                } else {
                    showMessage(errorMessage, result.message || 'Contraseña incorrecta');
                }
            } catch (error) {
                showMessage(errorMessage, 'Error de conexión con el servidor');
            } finally {
                verifyBtn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Verificar identidad';
                verifyBtn.disabled = false;
            }
        });
        
        // Botón de actualización
        updateBtn.addEventListener('click', async function() {
            const username = usernameInput.value.trim();
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            // Limpiar mensajes previos
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            // Validación básica en el cliente
            if (newPassword && newPassword.length < 6) {
                showMessage(errorMessage, 'La contraseña debe tener al menos 6 caracteres');
                return;
            }
            
            if (newPassword && newPassword !== confirmPassword) {
                showMessage(errorMessage, 'Las contraseñas no coinciden');
                return;
            }

            // Preparar datos para enviar al servidor
            const updateData = {};
            if (username && username !== currentUser) updateData.username = username;
            if (newPassword) {
                updateData.password = newPassword;
                updateData.password_confirmation = confirmPassword;
            }

            // Si no hay cambios, mostrar mensaje
            if (Object.keys(updateData).length === 0) {
                showMessage(errorMessage, 'No se han realizado cambios');
                return;
            }

            // Mostrar carga
            updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Actualizando...';
            updateBtn.disabled = true;

            try {
                const response = await fetch("{{ route('contrasena.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(updateData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showMessage(successMessage, 'Credenciales actualizadas correctamente. Cerrando sesión...');
                    
                    // Redirigir después de 2 segundos
                    setTimeout(() => {
                        if (result.redirect) {
                            window.location.href = result.redirect;
                        }
                    }, 2000);
                } else {
                    showMessage(errorMessage, result.message || 'Error al actualizar las credenciales');
                }
            } catch (error) {
                showMessage(errorMessage, 'Error de conexión con el servidor');
            } finally {
                updateBtn.innerHTML = '<i class="fas fa-sync-alt mr-2"></i>Actualizar Credenciales';
                updateBtn.disabled = false;
            }
        });
        
        // Manejar el botón "atrás" del navegador
        window.addEventListener('popstate', function() {
            if (isVerified) {
                closeUpdateForm();
                history.pushState(null, null, window.location.href);
            }
        });
        
        // Inicializar el estado de navegación
        history.pushState(null, null, window.location.href);
    </script>
</body>
</html>