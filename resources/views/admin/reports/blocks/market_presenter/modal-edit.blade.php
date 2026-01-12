{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditarTextoMarketPresenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-color-3">Editar Presentación de Informes</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form
                id="formTextoMarketPresenter"
                method="POST"
                action="{{ route('admin.market-presenter.update', ['marketPresenter' => '__ID__']) }}"
                data-action-template="{{ route('admin.market-presenter.update', ['marketPresenter' => '__ID__']) }}"
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

                    {{-- IMAGEN --}}
                    <div class="mb-3">
                        <input type="file" class="form-control" name="image" id="mpImage" accept="image/jpeg,image/webp">
                        <div class="form-text">Imagen JPG o WEBP (ideal 300x300px)</div>
                        <div class="form-text">Si subís una nueva, reemplaza la anterior al actualizar</div>
                    </div>

                    {{-- ALT --}}
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="alt" id="mpAlt" placeholder="ALT" maxlength="125" required>
                        <label for="mpAlt">ALT de la imagen</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
