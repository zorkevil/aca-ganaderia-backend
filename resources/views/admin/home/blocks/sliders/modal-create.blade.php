{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalAgregarSlider" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-color-3">Agregar Slider</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form method="POST" action="{{ route('admin.home.sliders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 rich-text-field">
                        <div class="js-quill-basic"
                            class="form-control" 
                            data-input-name="text"
                            data-placeholder="Texto">
                        </div>

                        <input type="hidden" name="text">
                    </div>

                    <div class="mb-3">
                        <input type="file" class="form-control" name="image" id="image" accept="image/jpeg,image/webp">
                        <div class="form-text">Imagen JPG o WEBP (ideal 3840x2160px)</div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="alt" id="alt" placeholder="ALT" maxlength="125" required>
                        <label for="alt">ALT de la imagen</label>
                    </div>

                    <!--
                    <div class="mb-3 form-floating">
                        <input type="url" class="form-control" name="link" id="link" placeholder="https://">
                        <label for="link">Link (opcional)</label>
                        <div class="form-text">URL del botón del slider</div>
                    </div>
                    -->

                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="sort_order"
                                    id="sort_order"
                                    min="1"
                                    value="{{ $nextSortOrder }}"
                                    placeholder="N° de orden"
                                    required
                                >
                                <label for="sort_order">N° de orden</label>
                            </div>
                        </div>                    
                        <div class="col-6 mb-3">
                            <div class="form-floating"> 
                                <select class="form-select tom-select" name="is_active" id="is_active" required>
                                    <option value="" selected></option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            <label>Estado</label>
                            </div>                        
                        </div>
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