@extends('admin.layouts.app')

@section('title', 'Informes - Panel de Administración | ACA Ganadería')

@section('content')

  {{-- Header --}}
  <header>
    <div class="row">
      <div class="col-12">
        <h1 class="text-color-3 mb-2 fw-semibold">Informes</h1>
        <p class="mb-0">Panel &gt; Informes</p>
      </div>
    </div>
  </header>

  <hr>

  {{-- Mensajes --}}
  @include('admin.partials.flash')

  {{-- BLOQUE: BANNER PRINCIPAL --}}
  @include('admin.configuration.blocks.main_banner.index', ['banner' => $banner])

  {{-- BLOQUE: PRESENTACIÓN INFORMES --}}
  @include('admin.reports.blocks.market_presenter.index', ['marketPresenter' => $marketPresenter])

  {{-- BLOQUE: INFORMES --}}
  @include('admin.reports.blocks.lists.index', ['reports' => $reports])

@endsection