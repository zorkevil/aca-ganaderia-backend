@extends('admin.layouts.app')

@section('title', 'Configuración - Panel de Administración | ACA Ganadería')

@section('content')

  {{-- Header --}}
  <header>
    <div class="row">
      <div class="col-12">
        <h1 class="text-color-3 mb-2 fw-semibold">Configuración</h1>
        <p class="mb-0">Panel &gt; Configuración</p>
      </div>
    </div>
  </header>

  <hr>

  {{-- Mensajes --}}
  @include('admin.partials.flash')

  {{-- BLOQUE: SERVICIOS PRINCIPALES --}}
  @include('admin.configuration.blocks.general_category.index', ['generalCategories' => $generalCategories])

  {{-- BLOQUE: CATEGORIAS DE PRODUCTOS --}}
  @include('admin.configuration.blocks.category.index', ['categories' => $categories])

  {{-- BLOQUE: SUBCATEGORIAS DE PRODUCTOS --}}
  @include('admin.configuration.blocks.subcategory.index', ['subcategories' => $subcategories])

  {{-- BLOQUE: MODALIDADES DE REMATES --}}
  @include('admin.configuration.blocks.auction_modality.index', ['auctionModalities' => $auctionModalities])

  {{-- BLOQUE: TIPOS DE REMATES --}}
  @include('admin.configuration.blocks.auction_type.index', ['auctionTypes' => $auctionTypes])

  {{-- BLOQUE: CONTACTOS DE WHATSAPP --}}
  @include('admin.configuration.blocks.contacts.index', ['contacts' => $contacts])

@endsection