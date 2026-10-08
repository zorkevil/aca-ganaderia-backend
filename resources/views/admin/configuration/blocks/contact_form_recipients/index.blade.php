<div class="accordion" id="accordionContactFormRecipients">
  <div class="accordion-item">

    <h2 class="accordion-header">
      <button class="accordion-button" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseContactFormRecipients"
              aria-expanded="true"
              aria-controls="collapseContactFormRecipients">
        Emails de Formularios de Contacto
      </button>
    </h2>

    <div id="collapseContactFormRecipients"
         class="accordion-collapse collapse show"
         data-bs-parent="#accordionContactFormRecipients">
      <div class="accordion-body">

        @include('admin.configuration.blocks.contact_form_recipients.table', [
          'recipients' => $contactFormRecipients
        ])

        <div class="mt-3 text-center">
          <button type="button" class="btn btn-link"
                  data-bs-toggle="modal"
                  data-bs-target="#modalCreateContactFormRecipient">
            <i class="bi bi-plus-circle me-1"></i>
            Agregar Email
          </button>
        </div>

      </div>
    </div>

  </div>
</div>

@include('admin.configuration.blocks.contact_form_recipients.modal-create')
@include('admin.configuration.blocks.contact_form_recipients.modal-edit')
