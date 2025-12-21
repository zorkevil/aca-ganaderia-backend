<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Título</th>
        <th scope="col">Imagen</th>
        <th scope="col">ALT de la imagen</th>
        <th scope="col">Link</th>
        <th scope="col">Estado</th>
        <th scope="col" class="col-actions">Acciones</th>
      </tr>
    </thead>
    <tbody>

      @forelse($reports as $report)
        <tr>
          <td>{{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}</td>

          <td>{{ Str::limit($report->title, 50) }}</td>

          <td>
            @if($report->image_url)
              <img src="{{ $report->image_url }}"
                  alt="{{ $report->title }}"
                  class="img-thumbnail"
                  style="object-fit: cover; cursor: pointer;"
                  loading="lazy"
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal{{ $report->id }}">
            @else
              <span class="text-muted">Sin imagen</span>
            @endif
          </td>

          <td>{{ Str::limit($report->alt, 60) }}</td>

          <td>
            @if($report->link)
              <a href="{{ $report->link }}" target="_blank" rel="noopener noreferrer" class="text-truncate d-inline-block">
                {{ Str::limit($report->link, 40) }}
                <i class="bi bi-box-arrow-up-right ms-1"></i>
              </a>
            @else
              <span class="text-muted">-</span>
            @endif
          </td>

          <td>
            @if($report->is_active)
              <span class="badge text-color-3 bg-color-4">
                <i class="bi bi-check-circle me-1"></i>Activo
              </span>
            @else
              <span class="badge text-color-1 bg-color-18">
                <i class="bi bi-x-circle me-1"></i>Inactivo
              </span>
            @endif
          </td>

          <td class="col-actions">
            @include('admin.reports.blocks.lists.row-actions', ['report' => $report])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay informes todavía.</p>
          </td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>

{{-- Links de paginación --}}
<div class="mt-3">
  {{ $reports->links() }}
</div>