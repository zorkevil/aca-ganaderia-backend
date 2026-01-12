<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionSubmissions">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseSubmissions"
                aria-expanded="true">
            Contactos a través del Formulario                
        </button>
      </h2>

      <div id="collapseSubmissions"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionSubmissions">

        <div class="accordion-body">

          @include('admin.sections.contact.blocks.submissions.table', [
            'submissions' => $submissions
          ])

        </div>
      </div>

    </div>
  </div>
</div>
