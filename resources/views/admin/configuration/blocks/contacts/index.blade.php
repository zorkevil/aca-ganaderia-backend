<div class="accordion" id="accordionContactos">
  <div class="accordion-item">

    <h2 class="accordion-header">
      <button class="accordion-button" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseContactos"
              aria-expanded="true"
              aria-controls="collapseContactos">
        Contactos Whatsapp
      </button>
    </h2>

    <div id="collapseContactos"
         class="accordion-collapse collapse show"
         data-bs-parent="#accordionContactos">
      <div class="accordion-body">

        @include('admin.configuration.blocks.contacts.table', [
          'contacts' => $contacts
        ])

        <div class="mt-3 text-center">
          <button type="button" class="btn btn-link"
                  data-bs-toggle="modal"
                  data-bs-target="#modalCreateContact">
            <i class="bi bi-plus-circle me-1"></i>
            Agregar Contacto
          </button>
        </div>

      </div>
    </div>

  </div>
</div>

@include('admin.configuration.blocks.contacts.modal-create')
@include('admin.configuration.blocks.contacts.modal-edit')
