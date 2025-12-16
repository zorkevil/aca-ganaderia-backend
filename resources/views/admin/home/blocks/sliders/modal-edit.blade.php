{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditarSlider" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-color-3">Editar Slider</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form
                id="editForm"
                method="POST"
                action="{{ route('admin.home.sliders.update', ['homeSlider' => '__ID__']) }}"
                data-action-template="{{ route('admin.home.sliders.update', ['homeSlider' => '__ID__']) }}"
                enctype="multipart/form-data"
                novalidate
            >
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3 form-floating">
                        <div class="js-quill-basic"
                            class="form-control" 
                            data-input-name="text"
                            data-placeholder="Texto">
                        </div>

                        <input type="hidden" name="text" id="editText">
                    </div>

                    <div class="mb-3">
                        <input type="file" class="form-control" name="image" accept="image/jpeg,image/webp">
                        <div class="form-text">Imagen JPG (ideal 3840x2160px)</div>
                        <div class="form-text">Si subís una nueva, reemplaza la anterior al actualizar</div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="alt" id="editAlt" placeholder="ALT" maxlength="125" required>
                        <label for="editAlt">ALT de la imagen</label>
                    </div>

                    <!--
                    <div class="mb-3 form-floating">
                        <input type="url" class="form-control" name="link" id="editLink" placeholder="https://">
                        <label for="editLink">Link (opcional)</label>
                        <div class="form-text">URL del botón del slider</div>
                    </div>
                    -->

                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-floating"> 
                                <input type="number" class="form-control" name="sort_order" id="editOrder" min="1" placeholder="N° de orden" required>
                                <label link="editOrder">N° de orden</label>
                            </div>                    
                        </div>
                        <div class="col-6 mb-3">                        
                            <div class="form-floating"> 
                                <select class="form-select tom-select" name="is_active" id="editActive" required>
                                    <option value="" selected></option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <label for="editActive">Estado</label>
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