@extends('admin.layouts.app')

@section('title', 'Nutrición - Panel de Administración | ACA Ganadería')

@section('content')

  {{-- Header --}}
  <header>
    <div class="row">
      <div class="col-12">
        <h1 class="text-color-3 mb-2 fw-semibold">Nutrición</h1>
        <p class="mb-0">Panel &gt; Nutrición</p>
      </div>
    </div>
  </header>

  <hr>

  {{-- Mensajes --}}
  @include('admin.partials.flash')

  {{-- BLOQUE: BANNER PRINCIPAL --}}
  @include('admin.configuration.blocks.main_banner.index', ['banner' => $banner])

  {{-- BLOQUE: SERVICIOS --}}
  @include('admin.configuration.blocks.service.index', ['services' => $services])

@endsection