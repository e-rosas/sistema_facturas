{{--  Details  --}}
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-secondary border-0">
            <div class="row">
                <div class="col-md-8 col-auto">
                    <h3  class="card-title text-uppercase  mb-0">Factura</h3>
                </div>
                @if ($invoice->status != 1)
                <div class="col-md-2 col-auto">
                    <button id="edit-details" type="button" class="btn btn-sm btn-outline-default" data-toggle="modal"
                        data-target="#modal-details">Editar detalles</i></button>
                    <br />
                </div>
                @endif
                <div class="col-md-2 text-right">
                    <div class="dropdown">
                        <a class="btn  btn-success btn-sm" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            PDF
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <form target="_blank" method="post" action="{{ route('invoice.pdf', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="D">
                                <button type="submit" class="dropdown-item">Descargar</button>
                            </form>
                            <form target="_blank" method="post" action="{{ route('invoice.pdf', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="I">
                                @if (config('app.initial') == "C")
                                <div class="ml-3">
                                    <small class="text-muted">Con nombre</small>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="description" class="custom-control-input">
                                        .
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                                   
                                @endif
                              
                                <button type="submit" class="dropdown-item">Ver</button>
                                
                            </form>
                            
                            <form target="_blank" method="post"
                                action="{{ route('invoice.hospitalization', $invoice) }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Hospitalización</button>
                            </form>
                            <form target="_blank" method="post" action="{{ route('invoice.categories', $invoice) }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Categorias</button>
                            </form>
                            <form target="_blank" method="get" action="{{ route('invoice.letter', $invoice) }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Carta</button>
                            </form>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <div class="card-body">
            <div class="form-row">


               
                <div class="col-md-12 col-auto text-right">
                    <button type="button" data-toggle="modal" data-target="#modal-person"
                        class="btn btn-sm btn-outline-primary">{{ __('Cambiar paciente') }}</button>
                </div>
                @include('components.selectPersonModal')

                @include('invoices.partials.updateDetailsModal',['invoice'=>$invoice])
            </div>
            <div class="form-row">
                {{--  Concept  --}}
                <div class="col-md-6 col-auto form-group">
                    <label class="form-control-label" for="label-concept">Concepto</label>
                    <label id="label-concept">{{ $invoice->concept }}</label>
                </div>
                {{--  DOS  --}}
                <div class="col-md-6 col-auto form-group">
                    <label class="form-control-label" for="label-date">Fecha de servicio</label>
                    <label id="label-DOS">{{ $invoice->DOS->format('M-d-Y') }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  code --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-code">No. de Cobro</label>
                    <label id="label-code">{{ $invoice->code }}</label>

                </div>
                {{--  number --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-number">Folio de CONTPAQ</label>
                    <label id="label-number">{{ $invoice->number }}</label>

                </div>
                {{--  date  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-date">Fecha</label>
                    <label id="label-date">{{ $invoice->date->format('M-d-Y') }}</label>

                </div>
                {{--  rate --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-number">Tipo de cambio</label>
                    <label id="label-exchange_rate">{{ $invoice->exchangeRate() }}</label>

                </div>

            </div>
            <div class="form-row">
                {{--  type --}}
                <div class="col-md-5 col-auto form-group">
                    <label class="form-control-label" for="label-type">Tipo</label>
                    <label id="invoice-type">{{ $invoice->type() }}</label>
                </div>

            </div>
            <div class="form-row">
                {{--  status --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-status">Estado</label>
                    <label id="label-status">{{ $invoice->status() }}</label>
                </div>
                <div class="col-md-4 col-auto form-group">
                    <select id='new-status' class="custom-select" name="status">
                        <option value='10'>Cambiar estado</option>
                        <option value='0'>Nota de crédito pendiente.</option>
                        <option value='1'>Completa.</option>
                        <option value='2'>Pendiente de pago.</option>
                        <option value='3'>Pendiente de asignar productos.</option>
                        <option value='4'>Pendiente de facturar.</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button id="update-status" onclick="updateStatus()" class="btn btn-success btn-lg btn-block">
                        Cambiar
                    </button>
                </div>
            </div>

            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tab-general-tab" data-toggle="tab" href="#tab-general"
                            role="tab" aria-controls="tab-general" aria-selected="true"><i
                                class="fas fa-procedures mr-2"></i>{{ __('Datos generales') }}</a>
                    </li>
                    @if ($invoice->dental)
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tab-dental-tab" data-toggle="tab" href="#tab-dental"
                            role="tab" aria-controls="tab-dental" aria-selected="false"><i
                                class="fas fa-dollar-sign  mr-2"></i>{{ __('Dental') }}</a>
                    </li>
                    @include('invoices.partials.dentalServiceInfoModal')
                    @endif
                    @if ($invoice->hospitalization)
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tab-hospitalization-tab" data-toggle="tab" href="#tab-hospitalization" role="tab"
                            aria-controls="tab-hospitalization" aria-selected="false"><i
                                class="fas fa-hospital mr-2"></i>{{ __('Hospitalización') }}</a>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="tab-content" id="invoice-data">
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel" aria-labelledby="tab-general-tab">
                    <div class="card shadow">
                        <div class="card-header bg-secondary border-0">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3  class="card-title text-uppercase  mb-0">Datos generales</h3>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3">
                                @if (config('app.initial') == "C")
                                <div class="col-lg-2 custom-control custom-checkbox">
                                    <input type="checkbox" name="cash" id="cash" class="custom-control-input"
                                        {{ $invoice->cash ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="cash">Cash</label>
                                </div>
                                @else
                                <input type="checkbox" name="cash" id="cash" class="custom-control-input" style="display: none">
                                @endif
                            </div>
                        </div>
            
                        <div class="form-row">
                            {{--  Comments  --}}
                            <div class="col-md-12 col-auto form-group">
                                <label class="form-control-label" for="label-comments">Observaciones</label>
                                <label id="label-comments">{{ $invoice->comments }}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            {{--  Doctor  --}}
                            <div class="col-md-12 col-auto form-group">
                                <label class="form-control-label" for="label-doctor">Doctor</label>
                                <label id="label-doctor">{{ $invoice->doctor }}</label>
                            </div>
            
                        </div>
                        <div class="form-row">
                            {{--  tax  --}}
                            <div class="col-md-3 col-auto form-group">
                                <label class="form-control-label" for="label-tax">IVA</label>
                                <span class="MXN" style="display: none"> {{ $invoice->IVAF() }} </span><span class="USD">
                                    {{ $invoice->discountedTax() }} </span>
            
                            </div>
                            {{--  sub_total  --}}
                            <div class="col-md-3 col-auto form-group">
                                <label class="form-control-label" for="label-sub_total">Subtotal</label>
                                <span class="MXN" style="display: none"> {{ $invoice->subtotalF() }} </span><span class="USD">
                                    {{ $invoice->subtotalDiscounted() }} </span>
            
                            </div>
                            {{--  total  --}}
                            <div class="col-md-3 col-auto form-group">
                                <label class="form-control-label" for="label-total">Total</label>
                                <span class="MXN" style="display: none"> {{ $invoice->totalF() }} </span><span class="USD">
                                    {{ $invoice->totalDiscounted() }} </span>
            
                            </div>
                        </div>
                        @include('locations.components.details', ['location'=>$invoice->location])
                        <div class="row">
                            <div class="col-md-4 col-auto">
                                <button type="button" data-toggle="modal" data-target="#modal-location"
                                    class="btn btn-sm btn-outline-default">{{ __('Cambiar ubicación') }}</button>
                            </div>
                            @include('components.selectLocationModal')
                        </div>
            
                        <div class="form-row">
                            @include('components.currencySwitch', ['USD' => 1])
                        </div>
                    </div>
                </div>
                @if ($invoice->dental)
                <div class="tab-pane fade" id="tab-dental" role="tabpanel" aria-labelledby="tab-dental-tab">
                    <div class="form-row">
                        <div class="col-xl-12">
                            @include('invoices.partials.dentalDetails', ['dental' => $invoice->dental_details])
                        </div>
                    </div>
                </div>
                @endif
                @if ($invoice->hospitalization)
                <div class="tab-pane fade" id="tab-hospitalization" role="tabpanel" aria-labelledby="tab-hospitalization-tab">
                    <div class="form-row">
                        <div class="col-xl-12">
                            @include('invoices.partials.hospitalizationDetails', ['hospitalization' => $invoice->hospitalization_details])
                        </div>
                    </div>
                </div>
                @endif
            </div>


            
           
            
            

            
        </div>
    </div>
</div>
@push('js')
<script>
    function updateStatus(){
        var status = document.getElementById("new-status").value;
        if(status != 10){
            $.ajax({
                url: "{{route('invoices.status')}}",
                dataType: 'json',
                type:"patch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "invoice_id": {{ $invoice->id }},
                    "status": status,
                },
            success: function () {
                displayStats();

                }
            });
            return false;
        }

    }
</script>
@endpush
