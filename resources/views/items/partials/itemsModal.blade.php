<div class="modal fade bd-example-modal-lg" id="modal-items" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Service items') }}</h5>
                        {{--  Items --}}
                        {{-- Selecting item --}}
                        <div class="row">
                            <div class="col-auto">
                                @include('items.partials.searchItems')
                            </div>
                            {{--  quantity  --}}
                            <div class=" col-auto form-group">
                                <input type="numeric" min="1" name="product-quantity" id="input-product-quantity" class="form-control form-control-alternative" 
                                placeholder="1" value="1" required>                          
                            </div>
                            {{-- Add --}}
                            <div class="col-auto">
                                <button type="button" id="add_item" class="btn btn-outline-success">{{ __('Add') }}</button>
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
