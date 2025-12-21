@extends('admin.layouts.guest')

@section('title', 'Iniciar Sesión | ACA Ganadería')

@section('content')
<div class="container-fluid svh-100">
  <div class="row h-100">

    {{-- Columna izquierda --}}
    <div class="col-lg-7 d-none d-lg-block p-0"
         style="background-image: url('{{ asset('assets/admin/img/login-bg.webp') }}');
                background-size: cover;
                background-position: center;">
    </div>

    {{-- Columna derecha --}}
    <div class="col-12 col-lg-5 bg-color-3 d-flex align-items-center justify-content-center p-4">
      <div class="w-100" style="max-width: 480px;">

        {{-- Logo --}}
        <div class="text-center mb-5">
          <img src="{{ asset('assets/admin/img/aca-logo.svg') }}"
               alt="ACA Ganadería"
               style="height: 80px;"
               class="mb-4">
        </div>

        {{-- Card --}}
        <div class="bg-color-10 p-4 p-md-5 rounded-4 shadow">

          <h1 class="text-center mb-3">Iniciar sesión</h1>

          <p class="text-center text-color-1 mb-4">
            Completa tu información para acceder a la administración del sitio
          </p>

          {{-- ERRORES --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          {{-- FORM --}}
          <form 
            method="POST" 
            action="{{ route('login') }}" 
            novalidate
          >
            @csrf

            {{-- Email --}}
            <div class="form-floating mb-3">
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

            {{-- Password --}}
            <div class="form-floating mb-3">
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                id="password"
                placeholder="Contraseña"
                required
                autocomplete="current-password">

              <label for="password">Contraseña</label>
            </div>

            {{-- Forgot --}}
            <div class="text-end mb-4">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn btn-link p-0">
                  ¿Olvidaste tu contraseña?
                </a>
              @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100">
              Entrar
            </button>

          </form>

        </div>

      </div>
    </div>

  </div>
</div>
@endsection