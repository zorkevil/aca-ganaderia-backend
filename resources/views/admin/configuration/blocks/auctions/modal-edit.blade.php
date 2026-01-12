{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditarAuction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title text-color-3">Editar Remate</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form
                id="editAuctionForm"
                method="POST"
                action="{{ route('admin.configuration.auctions.update', ['auction' => '__ID__']) }}"
                data-action-template="{{ route('admin.configuration.auctions.update', ['auction' => '__ID__']) }}"
                enctype="multipart/form-data"
                novalidate
            >
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- Título --}}
                    <div class="mb-3 form-floating">
                        <input type="text"
                               class="form-control"
                               name="title"
                               id="editTitle"
                               placeholder="Título"
                               required>
                        <label>Título</label>
                    </div>

                    {{-- Imagen --}}
                    <div class="mb-3">
                        <input type="file"
                               class="form-control"
                               name="image"
                               id="editImage"
                               accept="image/jpeg,image/png,image/webp">
                        <div class="form-text">
                            Imagen JPG o WEBP (ideal 800x400px)
                        </div>
                        <div class="form-text">
                            Si subís una nueva, reemplaza la anterior al actualizar
                        </div>
                    </div>

                    {{-- ALT imagen --}}
                    <div class="mb-3 form-floating">
                        <input type="text"
                               class="form-control"
                               name="image_alt"
                               id="editImageAlt"
                               placeholder="ALT de la imagen">
                        <label>ALT de la imagen</label>
                    </div>

                    
                    <div class="row">
                        {{-- Modalidad --}}                        
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <select name="auction_modality_id"
                                        id="editModality"
                                        class="form-select tom-select"
                                        required>
                                    <option value=""></option>
                                    @foreach ($modalities as $modality)
                                        <option value="{{ $modality->id }}">
                                            {{ $modality->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Modalidad</label>
                            </div>
                        </div>

                        {{-- Tipo --}}                                         
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <select name="auction_type_id"
                                        id="editType"
                                        class="form-select tom-select"
                                        required>
                                    <option value=""></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Tipo de Remate</label>
                            </div>
                        </div>
                    </div>                    

                    {{-- Fecha + Horario --}}
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <input type="date"
                                       class="form-control"
                                       name="date"
                                       id="editDate"
                                       required>
                                <label>Fecha</label>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control"
                                    name="time"
                                    id="editTime"
                                    placeholder="Ej: 09:30 / 15:00"
                                    required>
                                <label>Horario</label>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3 form-floating">
                        <textarea class="form-control"
                                  name="description"
                                  id="editDescription"
                                  placeholder="Descripción"
                                  style="height: 120px"></textarea>
                        <label>Descripción</label>
                    </div>

                    {{-- Link --}}
                    <div class="form-floating mb-3">
                        <input type="text"
                            name="link"
                            id="editLink"
                            class="form-control"
                            placeholder="Link">
                        <label>Link</label>
                    </div>

                    
                    <div class="form-floating mb-3">  
                        <select class="form-select tom-select" name="is_active" id="editActive" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <label for="editActive">Estado</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-primary"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
