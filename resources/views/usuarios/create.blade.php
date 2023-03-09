@extends('adminlte::page')
@section('title', 'Registrar | Usuarios')
@section('content')

    <!-- Script para validar la contraseña y mostrarla -->
    <script>
        function validatePassword() {
            var password = document.getElementById('password');
            var passwordError = document.getElementById('password-error');
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
            if (!strongRegex.test(password.value)) {
                passwordError.style.display = 'block';
                password.setCustomValidity(
                    'La contraseña debe tener al menos 8 caracteres, contener al menos una mayúscula y un número.');
            } else {
                passwordError.style.display = 'none';
                password.setCustomValidity('');
            }
        }

        function validatePasswordConfirm() {
        var password = document.getElementById('password');
        var passwordConfirm = document.getElementById('password_confirmation');
        var passwordConfirmError = document.getElementById('password-confirm-error');
        if (password.value !== passwordConfirm.value) {
            passwordConfirmError.style.display = 'block';
            passwordConfirm.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            passwordConfirmError.style.display = 'none';
            passwordConfirm.setCustomValidity('');
        }
    }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            // Cambiar el tipo de entrada del campo de contraseña de "password" a "text" y viceversa
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

    <!-- Card -->
    <div class="d-flex">
        <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
            <h5 class="card-header text-center text-white bg-dark">Agregar Usuario</h5>
            <div class="card-body">
                <!-- Formulario -->
                <form action="/usuarios" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" required="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario</label>
                        <input id="username" name="username" type="text" class="form-control" required="">
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Asignar Rol</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="">Seleccionar un Rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Recepcionista</option>
                        </select>
                    </div>
                    <!--Contraseña-->
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password"
                                oninput="validatePassword()" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div id="password-error" style="display: none; color: red;">La contraseña debe tener al menos 8
                            caracteres y contener al menos una mayúscula y un número.</div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" oninput="validatePassword()" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label>
                            <input type="checkbox" onclick="togglePassword()"> Mostrar contraseña
                        </label>
                    </div>
                    <!--Contraseña-->

                    <!-- Botones -->
                    <div class="text-center">
                        <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <!-- Botones -->
                </form>
            </div>
        </div>
    </div>
    <!-- Card -->

@endsection
