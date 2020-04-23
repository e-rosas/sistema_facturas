{{--  Details  --}}
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-red border-0">
            <div class="row">
                <div class="col-8 col-auto">
                    <h3 style="color:white" class="card-title text-uppercase  mb-0">Factura</h3>
                </div>
                <div class="col-4 col-auto text-right">
                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-primary">Editar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                {{--  code --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-code">No. de Cobro</label>
                    <label id="label-code">{{ $invoice->code }}</label>

                </div>
                {{--  number --}}
                <div class="col-md-5 col-auto form-group">
                    <label class="form-control-label" for="label-number">Folio de CONTPAQ</label>
                    <label id="label-number">{{ $invoice->code() }}</label>

                </div>
                {{--  date  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-date">Fecha</label>
                    <label id="label-date">{{ $invoice->date->format('d-m-Y') }}</label>

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
                    <label class="form-control-label" for="label-status">Estatus</label>
                    <label id="label-status">{{ $invoice->status() }}</label>
                </div>
                <div class="col-md-4">
                    <select id='new-status' class="custom-select" name="status"> 
                        <option value='10'>Cambiar status</option>
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
                {{--  tax  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-tax">IVA</label>
                    <label id="label-tax">{{ $invoice->tax }}</label>

                </div>
                {{--  sub_total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total">Subtotal</label>
                    <label id="label-sub_total">{{ $invoice->sub_total }}</label>

                </div>
                {{--  total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total">Total</label>
                    <label id="label-total">{{ $invoice->total }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  dtax --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-dtax">IVA con descuento</label>
                    <label id="label-dtax">{{ $invoice->dtax }}</label>

                </div>
                {{--  sub_total_with_discounts  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total_with_discounts">Subtotal con descuento</label>
                    <label id="label-num">{{ $invoice->sub_total_discounted }}</label>

                </div>
                {{--  total_with_discounts  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total_with_discounts">Total con descuento</label>
                    <label id="label-num">{{ $invoice->total_with_discounts }}</label>

                </div>
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