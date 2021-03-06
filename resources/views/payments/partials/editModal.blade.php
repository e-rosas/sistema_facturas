<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">Editar pago</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <input type="hidden" id="update-payment-id">
                        <div class="form-group">
                            {{--  Number --}}
                            <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="number" id="update-payment-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}"
                                        placeholder="" required>
                                </div>
                            </div>
                            {{--  Date  --}}
                            <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="date" id="update-payment-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        value="{{ old('date') }}" required>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--  amount  --}}
                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="update-payment-amount">Cantidad</label>
                                <input type="numeric" name="amount" id="update-payment-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Amount') }}" value=0 required>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--  exchange_rate --}}
                            <div class="form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-exchange_rate">Cambio</label>
                                <input type="numeric" name="exchange_rate" id="update-payment-exchange_rate" class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}" 
                                placeholder="Cambio" required>

                                @if ($errors->has('exchange_rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('exchange_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--  method  --}}
                            <div class="form-group {{ $errors->has('method') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="update-payment-method">Método</label>
                                <select id='update-payment-method' class="custom-select" name="method"> 
                                    <option value='0' selected>Transferencia</option>
                                    <option value='1' >Cheque</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="update-payment-type">¿Quién pagó?</label>
                                <select id='update-payment-type' class="custom-select" name="type">
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
                                    <textarea type="text" rows="3" name="comments" id="update-payment-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                    value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="update-payment" class="btn btn-success mt-4">Guardar</button>
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
    function showEditModal(id){
        getPayment(id);
        $('#edit-modal').modal('show')
    }
    function getPayment(id){
        $.ajax({
            url: "{{route('payments.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "payment_id" : id
            },
        success: function (response) {
                displayPaymentModal(response.data.id, response.data.number,
                    response.data.date2, response.data.amount_paid, 
                    response.data.comments,response.data.method2, response.data.exchange_rate, response.data.type2);
            }
        });
        return false;
    }
    function displayPaymentModal(payment_id, number, date, amount, comments, method2, exchange_rate, type2){
        document.getElementById("update-payment-id").value = payment_id;
        document.getElementById("update-payment-number").value = number;
        document.getElementById("update-payment-date").value = date;
        document.getElementById("update-payment-amount").value = parseFloat(amount.replace(/,/g, ''));;
        document.getElementById("update-payment-comments").value = comments;
        document.getElementById("update-payment-exchange_rate").value = parseFloat(exchange_rate.replace(/,/g, ''));;
        document.getElementById("update-payment-method").value = method2;
        document.getElementById("update-payment-type").value = type2;

      }
    function updatePayment(id, amount, date, comments, method, exchange_rate, number, type){
        $.ajax({
            url: "{{route('payments.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "payment_id": id,
                "amount_paid": amount,
                "date": date,
                "comments": comments,
                "method": method,
                "number": number,
                "exchange_rate": exchange_rate,
                "type": type
            },
        success: function (response) {
            DisplayPayments(response.data);
            displayStats();
            $('#edit-modal').modal('hide')

            }
        });
            return false;
    }



    $(document).ready(function(){
        $("#update-payment").click(function(){
            var payment_id = document.getElementById("update-payment-id").value;
            var amount = document.getElementById("update-payment-amount").value;
            var number = document.getElementById("update-payment-number").value;
            

            if(amount > 0 ){
                var date = document.getElementById("update-payment-date").value;

                var comments = document.getElementById("update-payment-comments").value;

                var method = document.getElementById("update-payment-method").value;
                var exchange_rate = document.getElementById("update-payment-exchange_rate").value;
                var type = document.getElementById("update-payment-type").value;
                updatePayment(payment_id, amount, date, comments, method, exchange_rate, number, type);
            }

        });
    });
</script>

@endpush
