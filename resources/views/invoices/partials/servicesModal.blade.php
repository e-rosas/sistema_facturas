<div class="modal fade bd-example-modal-lg" id="modal-services" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading align-centered text-center mb-4">Servicios y productos de la factura {{ $invoice->code }}</h5>
                        <div class="form-row">
                            <div class="col-md-12 text-left">
                                <h3 class="text-uppercase text-default ls-1 mb-1">Total de servicios:
                                    <span class="text-success">{{ $invoice->totalDiscounted() }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-left">
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                <h4>{{ $category->name }}</h4>
                                    @foreach ($category->services as $service)
                                        <div class="shadow-sm p-3 mb-3 bg-white rounded">
                                            <li class="text-uppercase list-group-item">Servicio:
                                                <span
                                                    class="text-primary font-weight-bold">{{ $service->descripcion .' - '. $service->code()}}
                                                    <span class="text-default font-weight-light">Cantidad:
                                                    </span>{{ $service->quantity  }}
                                                </span>
                                                <ul>
                                                    @foreach ($service->items as $item)
                                                    <li class="font-weight-bold">{{$item->descripcion .' - '.   $item->code() }}
                                                        <span class="text-default font-weight-light">Cantidad:
                                                        </span>{{ $item->quantity  }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </div>
                                    @endforeach
                                <span class="text-default text-right font-weight-light">Subtotal:
                                    {{ $category->total()  }}
                                </span>
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
