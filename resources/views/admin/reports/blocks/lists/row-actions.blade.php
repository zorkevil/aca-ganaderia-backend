{{-- BOTÓN EDITAR --}}
<button class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditarReport"
        data-id="{{ $report->id }}"
        data-title="{{ $report->title }}"
        data-link="{{ $report->link }}"
        data-alt="{{ $report->alt }}"
        data-date="{{ $report->date->format('Y-m-d') }}"
        data-is_active="{{ $report->is_active ? '1' : '0' }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- ELIMINAR --}}
<button
        type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $report->id }}"
        data-action="{{ route('admin.reports.destroy', $report) }}">
  <i class="bi bi-trash"></i>
</button>
