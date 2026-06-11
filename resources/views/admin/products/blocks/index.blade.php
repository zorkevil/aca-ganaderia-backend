<div class="d-flex flex-column gap-3">
    <div class="accordion" id="accordionProductos">
        <div class="accordion-item">

            <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseProductos"
                    aria-expanded="true">
                Listado de Productos
            </button>
            </h2>

            <div id="collapseProductos"
                class="accordion-collapse collapse show"
                data-bs-parent="#accordionProductos">

            <div class="accordion-body">

                @include('admin.products.blocks.table', ['products' => $products])

                <div class="mt-3 text-center d-flex gap-2 justify-content-center flex-wrap">
                <button type="button" class="btn btn-link"
                        data-bs-toggle="modal"
                        data-bs-target="#modalProductoNutricion">
                    <i class="bi bi-plus-circle me-1"></i>
                    Agregar Producto Nutrición
                </button>

                <button type="button" class="btn btn-link"
                        data-bs-toggle="modal"
                        data-bs-target="#modalProductoSanidad">
                    <i class="bi bi-plus-circle me-1"></i>
                    Agregar Producto Sanidad
                </button>

                <button type="button" class="btn btn-link"
                        data-bs-toggle="modal"
                        data-bs-target="#modalProductoIdentElectronica">
                    <i class="bi bi-plus-circle me-1"></i>
                    Agregar Producto Identificación Electrónica
                </button>

                <button type="button" class="btn btn-link"
                        data-bs-toggle="modal"
                        data-bs-target="#modalProductoSemillas">
                    <i class="bi bi-plus-circle me-1"></i>
                    Agregar Producto Semillas
                </button>
                </div>

            </div>
            </div>
        </div>
    </div>
</div>

@include('admin.products.blocks.modal-create-nutrition')
@include('admin.products.blocks.modal-create-sanidad')
@include('admin.products.blocks.modal-create-identificacion-electronica')
@include('admin.products.blocks.modal-create-semillas')
@include('admin.products.blocks.modal-edit-nutrition')
@include('admin.products.blocks.modal-edit-sanidad')
@include('admin.products.blocks.modal-edit-identificacion-electronica')
@include('admin.products.blocks.modal-edit-semillas')
