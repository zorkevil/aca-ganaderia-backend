{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditTextoAlliance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-color-3">Editar Presentación de Alianzas</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form
                id="formTextoAlliance"
                method="POST"
                action="{{ route('admin.configuration.alliances.text.update', $allianceText) }}"
                data-action-template="{{ route('admin.configuration.alliances.text.update', $allianceText) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- DESCRIPCIÓN --}}

                    <div class="rich-text-field">
                        <div class="js-quill-basic"
                            class="form-control" 
                            data-input-name="description"
                            data-placeholder="Descripción">
                        </div>

                        <input type="hidden" name="description" id="mpDescription">
                    </div>                        
                    <div class="mb-3 form-text">Podés usar negrita y cursiva</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
