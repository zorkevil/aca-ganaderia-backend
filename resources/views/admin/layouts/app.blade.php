<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel de Administración | ACA Ganadería')</title>

    {{-- Favicons --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">

    @vite([
      'resources/css/app.css',
      'resources/js/admin.js',
    ])
  </head>
  <body>
    <div class="admin-layout">
      @include('admin.partials.sidebar')

      <main class="main-content">
        @yield('content')
      </main>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include('admin.partials.modal-delete')
  </body>
</html>
