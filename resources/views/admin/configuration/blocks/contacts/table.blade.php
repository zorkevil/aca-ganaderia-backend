<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Nombre de Contacto</th>
        <th>Teléfono</th>
        <th>Sección</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($contacts as $contact)
        <tr>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->phone }}</td>
          <td>{{ $contact->generalCategory?->name ?? '-' }}</td>

          <td>
            @if($contact->is_active)
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
            @include('admin.configuration.blocks.contacts.row-actions', [
              'contact' => $contact
            ])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay contactos todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
