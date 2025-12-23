@extends('admin.layouts.app')

@section('title', 'Home - Panel de Administración | ACA Ganadería')

@section('content')

  {{-- Header --}}
  <header>
    <div class="row">
      <div class="col-12">
        <h1 class="text-color-3 mb-2 fw-semibold">Home</h1>
        <p class="mb-0">Panel &gt; Home</p>
      </div>
    </div>
  </header>

  <hr>

  {{-- Mensajes --}}
  @include('admin.partials.flash')

  {{-- BLOQUE: SLIDER PRINCIPAL --}}
  @include('admin.home.blocks.sliders.index', ['sliders' => $sliders])

@endsection