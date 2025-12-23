@extends('admin.layouts.app')

@section('title', 'Hacienda - Panel de Administración | ACA Ganadería')

@section('content')

  {{-- Header --}}
  <header>
    <div class="row">
      <div class="col-12">
        <h1 class="text-color-3 mb-2 fw-semibold">Hacienda</h1>
        <p class="mb-0">Panel &gt; Hacienda</p>
      </div>
    </div>
  </header>

  <hr>

  {{-- Mensajes --}}
  @include('admin.partials.flash')

  {{-- BLOQUE: BANNER PRINCIPAL --}}
  @include('admin.configuration.blocks.main_banner.index', ['banner' => $banner])

  {{-- BLOQUE: ALIANZAS --}}
  @include('admin.configuration.blocks.alliance.index', ['alliances' => $alliances])

@endsection