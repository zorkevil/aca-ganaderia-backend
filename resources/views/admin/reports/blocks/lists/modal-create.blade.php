{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalAgregarReport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-color-3">Agregar Informe</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form method="POST" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data" novalidate>
                @csrf            
                <div class="modal-body">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Título" required>
                        <label for="title">Título</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="link" id="link" placeholder="Link del informe" required>
                        <label>Link del informe</label>
                    </div>

                    <div class="mb-3">
                        <input type="file" class="form-control" name="image" id="image" accept="image/jpeg,image/webp">
                        <div class="form-text">Imagen JPG o WEBP (ideal 960x540px)</div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="alt" id="alt" placeholder="ALT" maxlength="125" required>
                        <label for="alt">ALT de la imagen</label>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="date" required>
                                <label>Fecha</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <select name="is_active" class="form-select tom-select" required>
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
