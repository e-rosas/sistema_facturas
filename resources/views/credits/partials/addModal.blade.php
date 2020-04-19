<div class="modal fade" id="modal-credit" tabindex="-1" role="dialog" aria-labelledby="modal-credit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">Nueva nota de crédito</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            {{--  Number --}}
                            {{-- <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" name="number" id="credit-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
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
                                    <input type="date" onchange="credit_handler(event)" name="date" id="input-credit-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                    value="{{ old('date') }}" required>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--  exchange_rate --}}
                            <div class="form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-credit-exchange_rate">Cambio</label>
                                <input type="numeric" name="exchange_rate" id="input-credit-exchange_rate" class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}" 
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
                                    <textarea type="text" rows="3" name="comments" id="input-credit-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                    value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="save_credit" class="btn btn-success mt-4">Guardar</button>
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
    function sendCredit( exchange_rate,  date, comments){
        $.ajax({
            url: "{{route('credits.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {{ $invoice->id }},
                "invoice_number": "{{ $invoice->code }}",
                "exchange_rate": exchange_rate,
                "date": date,
                "comments": comments,
            },
        success: function (response) {         
            displayCredit(response.data);
            displayStats();
            $('#modal-credit').modal('hide');

            }
        });
            return false;
    }

    function displayCredit(data){
        document.getElementById("credit-date").innerHTML = data.date;
        document.getElementById("credit-exchange_rate").innerHTML = data.exchange_rate;
        document.getElementById("credit-number").innerHTML = data.number;
        document.getElementById("credit-concept").innerHTML = data.concept;
        document.getElementById("input-credit-comments").innerHTML = data.comments;
        document.getElementById("credit-amount_due").innerHTML = data.amount_due;
    }

    $("#save_credit").click(function(){

        var date = document.getElementById("input-credit-date").value;
        var exchange_rate = document.getElementById("input-credit-exchange_rate").value;

        var comments = document.getElementById("input-credit-comments").value;

        if(exchange_rate > 0){
            sendCredit(exchange_rate, date, comments);
        }



    });
</script>

@endpush
