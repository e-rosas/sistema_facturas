<div class="modal fade bd-example-modal-lg" id="modal-items" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">Productos del servicio <span id="modal-service-description"></span></h5>
                        <div class="form-row">
                            <div class="col-md-4 ">
                                <h3 class="text-uppercase text-default ls-1 mb-1">Total del servicio: </h3>
                                <h5 id="modal-service-discounted_total" class="text-primary"></h5>
                            </div>
                            <div class="col-md-8">
                                <h3 class="text-uppercase text-default ls-1 mb-1">Total de productos: </h3>
                                <h5 id="modal-items-discounted_total" class="text-yellow"></h5>
                            </div>
                        </div>
                        {{--  Items --}}
                        {{-- Selecting item --}}
                        <div class="form-row">
                            <div class="col-xl-12 order-xl-1">
                                @include('items.partials.searchItems')
                            </div>
                        </div>

                        <form action="">
                            <div class="form-row">
                                {{--  name  --}}
                                <div class="col-lg-11 col-auto form-group">
                                    <label class="form-control-label" for="custom-product-name">Name</label>
                                    <input type="text" name="product-name" id="custom-product-name" autocomplete="on"
                                        class="form-control form-control-alternative" placeholder="0" required>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" id="search_service" name="search-service" class="btn btn-info btn-fab btn-icon"
                                        onclick="searchService()">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  nombre  --}}
                                <div class="col-lg-12 col-auto form-group">
                                    <label class="form-control-label" for="custom-product-nombre">Nombre</label>
                                    <input type="text" name="product-nombre" id="custom-product-nombre"
                                        autocomplete="on" class="form-control form-control-alternative" placeholder="0"
                                        required>
                                </div>
                            </div>
                        </form>

                        <div class="form-row">
                            {{--  date  --}}
                            <div class="col-lg-3 col-auto">
                                <label class="form-control-label" for="input-date_item">Fecha</label>
                                <input name="date_item" id="input-date_item"
                                    class="form-control form-control-alternative" type="date" required>
                            </div>
                            {{--  price  --}}
                            <div class="col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="custom-product-price">Precio</label>
                                <input type="numeric"  name="product-price" id="custom-product-price" class="form-control form-control-alternative"
                                placeholder="0" required>

                            </div>
                            <input type="hidden" min="1" name="product-discounted-price" id="custom-product-discounted-price"
                                class="form-control form-control-alternative" placeholder="0" required>
                            {{--  discounted-price
                            <div class="col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="custom-product-discounted-price">Descuento</label>
                                <input type="numeric" min="1" name="product-discounted-price" id="custom-product-discounted-price" class="form-control form-control-alternative"
                                placeholder="0"  required>
                            </div> --}}
                            {{--  quantity  --}}
                            <div class=" col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="input-product-quantity">Cantidad</label>
                                <input type="numeric" min="1" name="product-quantity" id="input-product-quantity" class="form-control form-control-alternative"
                                placeholder="1" value="1" required>
                            </div>
                            {{-- tax --}}
                            <div class="col-lg-1 custom-control custom-checkbox">
                                <input type="checkbox" name="product-tax" id="custom-product-tax" class="custom-control-input">
                                <label class="custom-control-label" for="custom-product-tax">IVA</label>
                            </div>

                        </div>
                        <div class="form-row">
                            {{-- Add --}}
                            <div class="col-lg-12">
                                <label class="form-control-label"></label>
                                <button type="button" id="add_item" class="btn btn-block btn-outline-success">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @include('items.partials.itemsTable')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<!-- Script -->
<script type="text/javascript">
    function searchService(){
        var service = document.getElementById("custom-product-name").value;
        var item_id = document.getElementById("item_id").value;
        if(service.length > 0 && item_id > 0){
            searchServiceName(service);
        }
        else{
            alert("Seleccionar el producto de laboratorio.")
        }
    }

    function searchServiceName(service){
        $.ajax({
            url: "{{route('services.findName')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "service_name" : service,
            },
        success: function (response) {
            var data = response.data;
            document.getElementById("custom-product-price").value = parseFloat(data.price.replace(/,/g,''));
            document.getElementById("custom-product-name").value = data.description;
            document.getElementById("custom-product-nombre").value = data.descripcion;
            document.getElementById("custom-product-discounted-price").value = data.code;
            }
        });
        return false;
    }

</script>
@endpush
