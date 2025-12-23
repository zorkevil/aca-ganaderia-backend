@extends('admin.layouts.app')

@section('title', 'Productos - Panel de Administración | ACA Ganadería')

@section('content')

{{-- Header --}}
<header>
  <div class="row">
    <div class="col-12">
      <h1 class="text-color-3 mb-2 fw-semibold">Productos</h1>
      <p class="mb-0">Panel &gt; Productos</p>
    </div>
  </div>
</header>

<hr>

{{-- Mensajes --}}
@include('admin.partials.flash')

{{-- BLOQUE: PRODUCTOS --}}
@include('admin.products.blocks.index', ['products' => $products, 'categoriesNutrition' => $categoriesNutrition])

@endsection
