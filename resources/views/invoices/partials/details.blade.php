{{--  Details  --}}
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-red border-0">
            <div class="row">
                <div class="col-md-2 col-auto">
                    <h3 style="color:white" class="card-title text-uppercase  mb-0">Factura</h3>
                </div>
                <div class="col-md-2 text-right">
                    <div class="dropdown">
                        <a class="btn  btn-success btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <button type="submit" class="dropdown-item">Ver</button>
                                </form>
                                <form target="_blank" method="post" action="{{ route('invoice.hospitalization', $invoice) }}">
                                    @csrf
                                    <input type="hidden" name="output" value="I">
                                    <button type="submit" class="dropdown-item">Hospitalización</button>
                                </form>
                        </div>
                    </div>

                </div>
                @if ($invoice->status != 1)
                    <div class="col-md-3 col-auto text-right">
                        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-primary">Editar servicios</a>
                    </div>
                @endif
                @if ($invoice->status != 1)
                    <div class="col-md-3 col-auto text-right">
                        <button id="edit-details" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-details">Editar detalles</i></button>
                        <br />
                    </div>
                @endif
                <div class="col-md-2 col-auto text-right">
                    <button type="button" data-toggle="modal" data-target="#modal-person"
                        class="btn btn-sm btn-primary">{{ __('Cambiar paciente') }}</button>
                </div>
                @include('components.selectPersonModal')

                @include('invoices.partials.updateDetailsModal',['invoice'=>$invoice])

            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                {{--  Concept  --}}
                <div class="col-md-10 col-auto form-group">
                    <label class="form-control-label" for="label-concept">Concepto</label>
                    <label id="label-concept">{{ $invoice->concept }}</label>
                </div>
                {{--  DOS  --}}
                <div class="col-md-2 col-auto form-group">
                    <label class="form-control-label" for="label-date">Fecha de servicio</label>
                    <label id="label-date">{{ $invoice->DOS->format('d-m-Y') }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  code --}}
                <div class="col-md-2 col-auto form-group">
                    <label class="form-control-label" for="label-code">No. de Cobro</label>
                    <label id="label-code">{{ $invoice->code }}</label>

                </div>
                {{--  number --}}
                <div class="col-md-2 col-auto form-group">
                    <label class="form-control-label" for="label-number">Folio de CONTPAQ</label>
                    <label id="label-number">{{ $invoice->number }}</label>

                </div>
                {{--  date  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-date">Fecha</label>
                    <label id="label-date">{{ $invoice->date->format('d-m-Y') }}</label>

                </div>
                {{--  number --}}
                <div class="col-md-5 col-auto form-group">
                    <label class="form-control-label" for="label-number">Tipo de cambio</label>
                    <label id="label-exchange_rate">{{ $invoice->exchangeRate() }}</label>

                </div>

            </div>
            <div class="form-row">
                {{--  type --}}
                <div class="col-md-2 col-auto form-group">
                    <label class="form-control-label" for="label-type">Tipo</label>
                    <label id="invoice-type">{{ $invoice->type() }}</label>
                </div>
                {{--  status --}}
                <div class="col-md-2 col-auto form-group">
                    <label class="form-control-label" for="label-status">Estado</label>
                    <label id="label-status">{{ $invoice->status() }}</label>
                </div>
                <div class="col-md-4">
                    <select id='new-status' class="custom-select" name="status">
                        <option value='10'>Cambiar estado</option>
                        <option value='0'>Nota de crédito pendiente.</option>
                        <option value='1'>Completada.</option>
                        <option value='2'>Pendiente de pago.</option>
                        <option value='3'>Pendiente de asignar productos.</option>
                        <option value='4'>Pendiente de facturar.</option>
                        <option value='5'>Aseguranza no pagará.</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button id="update-status" onclick="updateStatus()" class="btn btn-success btn-sm">
                        Cambiar
                      </button>
                </div>
            </div>
            {{--  <div class="form-row">

                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_paid">{{ __('Amount paid') }}</label>
                    <label id="label-amount_paid">{{ $invoice->amount_paid }}</label>

                </div>

                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_due">{{ __('Amount due') }}</label>
                    <label id="label-amount_due">{{ $invoice->getAmountDue() }}</label>

                </div>


            </div>  --}}
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
                    <span class="MXN" style="display: none"> {{ $invoice->IVAF() }} </span><span class="USD"> {{ $invoice->discountedTax() }} </span>

                </div>
                {{--  sub_total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total">Subtotal</label>
                    <span class="MXN" style="display: none"> {{ $invoice->subtotalF() }} </span><span class="USD" > {{ $invoice->subtotalDiscounted() }} </span>

                </div>
                {{--  total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total">Total</label>
                    <span class="MXN" style="display: none"> {{ $invoice->totalF() }} </span><span class="USD" > {{ $invoice->totalDiscounted() }} </span>

                </div>
            </div>
            <div class="form-row">
                @include('components.currencySwitch', ['USD' => 1])
            </div>
            {{-- <div class="form-row">

                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-dtax">IVA con descuento</label>
                    <label id="label-dtax">{{ $invoice->dtax }}</label>

                </div>

                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total_with_discounts">Subtotal con descuento</label>
                    <label id="label-num">{{ $invoice->sub_total_discounted }}</label>

                </div>

                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total_with_discounts">Total con descuento</label>
                    <label id="label-num">{{ $invoice->total_with_discounts }}</label>

                </div>
            </div> --}}
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
