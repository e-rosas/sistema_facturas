<div class="modal fade" id="modal-charge" tabindex="-1" role="dialog" aria-labelledby="modal-charge" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">Nuevo cargo</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            {{--  Number --}}
                            {{-- <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" name="number" id="charge-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
                                    value="{{ $number ?? '' }}" placeholder="Number" required>
                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            {{--  Date  --}}
                            <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" onchange="charge_handler(event)" name="date" id="input-charge-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
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
                                <label class="form-control-label" for="input-charge-amount_charged">Cantidad</label>
                                <input type="numeric" name="amount_charged" id="input-charge-amount_charged" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                placeholder="Cantidad" value={{ (float) str_replace(',', '', $invoice->amount_due)  }}>

                                @if ($errors->has('amount_paid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount_paid') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--  exchange_rate --}}
                            <div class="form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-charge-exchange_rate">Cambio</label>
                                <input type="numeric" name="exchange_rate" id="input-charge-exchange_rate" class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}" 
                                placeholder="Cambio" value=23 required>

                                @if ($errors->has('exchange_rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('exchange_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="input-charge-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                    value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="save_charge" class="btn btn-success mt-4">Guardar</button>
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
    function sendCharge(exchange_rate,  date, comments, amount_charged){
        $.ajax({
            url: "{{route('charges.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {{ $invoice->id }},
                "invoice_number": "{{ $invoice->code }}",
                "exchange_rate": exchange_rate,
                "date": date,
                "comments": comments,
                "amount_charged": amount_charged
            },
        success: function (response) {         
            displayCharge(response.data);
            displayStats();
            $('#modal-charge').modal('hide');

            }
        });
            return false;
    }

    function displayCharge(data){
        document.getElementById("charge-date").innerHTML = data.date;
        document.getElementById("charge-exchange_rate").innerHTML = data.exchange_rate;
        document.getElementById("charge-number").innerHTML = data.number;
        document.getElementById("charge-status").innerHTML = data.status;
        document.getElementById("charge-concept").innerHTML = data.concept;
        document.getElementById("charge-comments").innerHTML = data.comments;
        document.getElementById("charge-amount_charged").innerHTML = data.amount_charged;
    }

    $("#save_charge").click(function(){

        var date = document.getElementById("input-charge-date").value;
        var exchange_rate = document.getElementById("input-charge-exchange_rate").value;
        var amount_charged = document.getElementById("input-charge-amount_charged").value;
        var comments = document.getElementById("input-charge-comments").value;

        if(exchange_rate > 0){
            sendCharge(exchange_rate, date, comments, amount_charged);
        }



    });
</script>

@endpush
