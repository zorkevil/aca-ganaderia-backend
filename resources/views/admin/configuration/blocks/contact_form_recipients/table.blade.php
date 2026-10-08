<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Email</th>
        <th>Sección</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($recipients as $recipient)
        <tr>
          <td>{{ $recipient->email }}</td>
          <td>{{ $recipient->section->label() }}</td>

          <td>
            @if($recipient->is_active)
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
            @include('admin.configuration.blocks.contact_form_recipients.row-actions', [
              'recipient' => $recipient
            ])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay emails cargados todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
