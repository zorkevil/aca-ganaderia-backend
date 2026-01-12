@extends('admin.layouts.guest')

@section('title', 'Recuperar Contraseña | ACA Ganadería')

@section('content')
<div class="container-fluid vh-100">
    <div class="row h-100">

        {{-- Columna izquierda: Imagen de fondo --}}
        <div class="col-lg-7 d-none d-lg-block p-0" 
             style="background-image: url('{{ asset('assets/admin/img/login-bg.webp') }}'); 
                    background-size: cover; 
                    background-position: center;">
        </div>

        {{-- Columna derecha: Formulario --}}
        <div class="col-12 col-lg-5 bg-color-3 d-flex align-items-center justify-content-center p-4">
            <div class="w-100" style="max-width: 480px;">

                {{-- Logo --}}
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/admin/img/aca-logo.svg') }}" 
                         alt="ACA Ganadería" 
                         style="height: 80px;" 
                         class="mb-4">
                </div>

                {{-- Card del Formulario --}}
                <div class="bg-color-10 p-4 p-md-5 rounded-4 shadow">

                    <h1 class="text-center mb-3">Cambio de contraseña</h1>

                    <p class="text-center text-color-1 mb-4">
                        Escribe tu e-mail para recibir un link de recuperación
                    </p>

                    {{-- Estado de la sesión (Mensaje de éxito de Laravel) --}}
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form method="POST" action="{{ route('password.email') }}" class="needs-validation">
                        @csrf

                        {{-- Campo Email --}}
                        <div class="form-floating mb-4">
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="nombre@ejemplo.com"
                                required
                                autofocus
                                autocomplete="email">
                            
                            <label for="email">Correo electrónico</label>
                        </div>

                        {{-- Botón Submit --}}
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Enviar link de recuperación
                        </button>

                        {{-- Link Volver al Login --}}
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="btn btn-link p-0">
                                Volver al inicio de sesión
                            </a>
                        </div>

                    </form>

                </div> {{-- End Card --}}

            </div>
        </div>

    </div>
</div>
@endsection