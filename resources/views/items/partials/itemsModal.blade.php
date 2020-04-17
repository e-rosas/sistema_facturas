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
                        <div class="form-row">
                            {{--  price  --}}
                            <div class="col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="custom-product-price">Precio</label>
                                <input type="numeric"  name="product-price" id="custom-product-price" class="form-control form-control-alternative" 
                                placeholder="0" required>
                            
                            </div>
                            {{--  discounted-price  --}}
                            <div class="col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="custom-product-discounted-price">Descuento</label>
                                <input type="numeric" min="1" name="product-discounted-price" id="custom-product-discounted-price" class="form-control form-control-alternative" 
                                placeholder="0"  required>
                            
                            </div>
                            {{--  quantity  --}}
                            <div class=" col-lg-3 col-auto form-group">
                                <label class="form-control-label" for="input-product-quantity">Cantidad</label>
                                <input type="numeric" min="1" name="product-quantity" id="input-product-quantity" class="form-control form-control-alternative" 
                                placeholder="1" value="1" required>                          
                            </div>
                            {{-- tax --}}
                            <div class="col-lg-1 col-auto form-group custom-control custom-control-alternative custom-checkbox">                                   
                                <input type="checkbox" name="product-tax" id="custom-product-tax" class="custom-control-input">        
                                <label class="custom-control-label" for="product-tax">IVA</label>       
                            </div>
                            {{-- Add --}}
                            <div class="col-lg-2">
                                <label class="form-control-label"></label>
                                <button type="button" id="add_item" class="btn btn-outline-success">Agregar</button>
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
