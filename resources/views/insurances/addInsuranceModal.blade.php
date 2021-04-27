<div class="modal fade" id="modal-insurance" tabindex="-1" role="dialog" aria-labelledby="modal-insurance"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Asignar aseguranza') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            {{--  Number --}}
                            <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="number" id="payment-number"
                                        class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Transferencia') }}">
                                    @if ($errors->has('number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--  Date  --}}
                            <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="date" id="payment-date" onchange="handler(event)"
                                        class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        value="{{ $today->format('Y-m-d')}}" required>
                                    @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--  amount  --}}
                            <div class="form-group{{ $errors->has('amount_paid') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-amount">Cantidad</label>
                                <input type="numeric" name="amount" id="payment-amount"
                                    class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                    placeholder="Cantidad" value=0>

                                @if ($errors->has('amount_paid'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount_paid') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{--  exchange_rate --}}
                            <div class="form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-exchange_rate">Cambio</label>
                                <input type="numeric" name="exchange_rate" id="payment-exchange_rate"
                                    class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}"
                                    placeholder="Cambio" value=0 required>

                                @if ($errors->has('exchange_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('exchange_rate') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{--  method  --}}
                            <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-method">Método</label>
                                <select id='payment-method' class="custom-select" name="method">
                                    <option value='0' selected>Transferencia</option>
                                    <option value='1'>Cheque</option>
                                </select>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-type">¿Quién pagó?</label>
                                <select id='payment-type' class="custom-select" name="type">
                                    <option value='0' selected>Aseguranza</option>
                                    <option value='2'>Paciente</option>
                                </select>
                            </div>

                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="payment-comments"
                                        class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                        value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="save_payment" class="btn btn-success mt-4">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    
    function sendPayment(method, exchange_rate, amount, date, comments, number, type){
        $.ajax({
            url: "{{route('payments.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {{ $invoice->id }},
                "invoice_number": "{{ $invoice->code }}",
                "exchange_rate": exchange_rate,
                "amount_paid": amount,
                "method": method,
                "date": date,
                "comments": comments,
                "number": number,
                "type": type
            },
        success: function (response) {
            $('#modal-insurance').modal('hide');

            }
        });
        return false;
    }

    

    function setStats(response){
        document.getElementById("invoice-type").innerHTML = response.data.type;
        document.getElementById("amount-paid").innerHTML = response.data.amount_paid;
        document.getElementById("amount-due").innerHTML = response.data.amount_due;
        document.getElementById("amount-paidMXN").innerHTML = response.data.amount_paidMXN;
        document.getElementById("amount-dueMXN").innerHTML = response.data.amount_dueMXN;
        document.getElementById("label-status").innerHTML = response.data.status;
        document.getElementById("invoice-status").innerHTML = response.data.status;
        document.getElementById("invoice-statusMXN").innerHTML = response.data.status;
        document.getElementById("invoice-type").innerHTML = response.data.type;
        if(response.data.status_n == 1){ /*completed*/
            document.getElementById("add-payment").style.display = 'none';
            document.getElementById("add-credit").style.display = 'none';
        }
        else {
            document.getElementById("add-payment").style.display = 'block';
            document.getElementById("add-credit").style.display = 'block';
        }
        document.getElementById("payment-exchange_rate").value = 0;
        document.getElementById("input-credit-exchange_rate").value = 0;
    }



    
</script>

@endpush
