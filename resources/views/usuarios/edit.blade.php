@extends('adminlte::page')
@section('title', 'Editar | Usuarios')
@section('content')

<!-- Script para validar la contraseña y mostrarla -->
<script>
    function validatePassword() {
    var password = document.getElementById('password');
    var passwordError = document.getElementById('password-error');
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
    if (!strongRegex.test(password.value)) {
        passwordError.style.display = 'block';
        password.setCustomValidity('La contraseña debe tener al menos 8 caracteres, contener al menos una mayúscula y un número.');
    } else {
        passwordError.style.display = 'none';
        password.setCustomValidity('');
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
    }</script>

<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agregar Usuario</h5>
            <div class="card-body">
                <form action="/User/{{$user->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input id="name" name="name" type="text"  class="form-control" value="{{$user->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario</label>
                        <input id="username" name="username" type="text" class="form-control" value="{{$user->username}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="admin" {{$user->role ? 'selected' : ''}}>Administrador</option>
                            <option value="recepcion" {{!$user->role ? 'selected' : ''}}>Recepcionista</option>
                            <option value="user" {{!$user->role ? 'selected' : ''}}>Usuario</option>
                        </select>
                    </div>        
                    <!--Contraseña-->
                    <div class="form-group">
                        <label for="password">Contraseña actual</label>
                        <input id="password" type="text" class="form-control" name="password" value="{{ $user->password }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="password">Nueva Contraseña</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password" oninput="validatePassword()" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div id="password-error" style="display: none; color: red;">La contraseña debe tener al menos 8 caracteres y contener al menos una mayúscula y un número.</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
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
                
                    <!--botones-->
                    <div class="text-center">
                    <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection