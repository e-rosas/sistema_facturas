<div class="modal fade bd-example-modal-lg" id="modal-services" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">Servicios y productos de la factura {{ $invoice->code }}</h5>
                        <div class="form-row">
                            <div class="col-md-4 ">
                                <h3 class="text-uppercase text-default ls-1 mb-1">Total de servicios: 
                                    <span class="text-success">{{ $invoice->total_with_discounts }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @foreach ($invoice->services as $service)
                            <h5 class="text-uppercase text-default ls-1 mb-1">Servicio: 
                                <span class="text-primary">{{ $service->code .' '.  $service->description }}</span>
                            </h5>
                            <div class="form-row">
                                @foreach ($service->items as $item)
                                    <span class="font-weight-light">{{ $item->code .' '.  $item->description . ' Cantidad: ' . $item->quantity }}</span>
                                @endforeach
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
