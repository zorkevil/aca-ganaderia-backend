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

  <div class="accordion" id="accordionRemates">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRemates" aria-expanded="true" aria-controls="collapseRemates">
                  Remates
                </button>
              </h2>
              <div id="collapseRemates" class="accordion-collapse collapse show" data-bs-parent="#accordionRemates" style="">
                <div class="accordion-body">

                  <!-- Editable Text Section -->
                  <div class="mb-4">
                    <div class="d-flex align-items-start justify-content-between gap-3">
                      <div class="flex-grow-1">
                        <p class="mb-0" id="textoRemates">Acompañamos a las cooperativas en la organización de remates físicos y virtuales, brindando respaldo comercial, comunicación y herramientas que facilitan la operación y garantizan transparencia.</p>
                      </div>
                      <button type="button" class="btn btn-link p-1" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarTextoRemates">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </div>
                  </div>

                  <!-- Table -->
                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th scope="col">Fecha</th>
                          <th scope="col">Título</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Modalidad</th>
                          <th scope="col" class="col-actions">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>12/12/2025</td>
                          <td>Remate Televisado</td>
                          <td>De terceros</td>
                          <td>Virtual</td>
                          <td class="col-actions">
                            <button class="btn btn-link p-1" title="Editar">
                              <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-link p-1" title="Eliminar">
                              <i class="bi bi-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>05/12/2025</td>
                          <td>Remate Grupo de Hacienda Cooperativo</td>
                          <td>De terceros</td>
                          <td>Virtual</td>
                          <td class="col-actions">
                            <button class="btn btn-link p-1" title="Editar">
                              <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-link p-1" title="Eliminar">
                              <i class="bi bi-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>20/11/2025</td>
                          <td>Remate Cooperativa la Ganadera de Ramirez</td>
                          <td>De terceros</td>
                          <td>Presencial</td>
                          <td class="col-actions">
                            <button class="btn btn-link p-1" title="Editar">
                              <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-link p-1" title="Eliminar">
                              <i class="bi bi-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Button to add new item -->
                  <div class="mt-3 text-center">
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalRemate">
                      <i class="bi bi-plus-circle me-1"></i>
                      Agregar Remate
                    </button>
                  </div>

                </div>
              </div>
            </div>
          </div>

  {{-- BLOQUE: ALIANZAS --}}
  @include('admin.configuration.blocks.alliance.index', ['alliances' => $alliances])

@endsection