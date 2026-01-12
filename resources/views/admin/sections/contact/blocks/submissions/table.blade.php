<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
          <th>Fecha</th>
          <th>Sección/Área</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Celular</th>
          <th>Localidad</th>
          <th>Rol</th>
          <th>Mensaje</th>
      </tr>
    </thead>
    <tbody>
      @forelse($submissions as $submission)
        <tr>                
          <td>{{ $submission->created_at->format('d/m/Y') }}</td>      
          <td>{{ $submission->section }}</td>
          <td>{{ $submission->nombre }}</td>
          <td>{{ $submission->apellido }}</td>
          <td>{{ $submission->email }}</td>
          <td>{{ $submission->telefono }}</td>
          <td>{{ $submission->localidad }}</td>
          <td>
              {{ $submission->rol }}
              @if(!empty($submission->otro_rol))
                  - {{ $submission->otro_rol }}
              @endif
          </td>
          <td>{{ $submission->mensaje }}</td>
        </tr>      
      @empty
        <tr>
          <td colspan="9" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay contactos todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>