<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Edit payment') }}</h6>
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
                                    <input type="number" name="number" id="update-payment-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
                                     placeholder="Number" required>
                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--  amount  --}}
                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="update-payment-amount">{{ __('Amount paid') }}</label>
                                <input type="numeric" name="amount" id="update-payment-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Amount') }}" value=0>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
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
                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="update-payment-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                    value="{{ old('comments') }}" placeholder="{{ __('Comments') }}"></textarea>
                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="update-payment" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
                    response.data.date, response.data.amount, response.data.comments);
            }
        });
        return false;
    }
    function displayPaymentModal(payment_id, number, date, amount, comments){
        document.getElementById("update-payment-id").value = payment_id;
        document.getElementById("update-payment-number").value = number;
        document.getElementById("update-payment-date").value = date;
        document.getElementById("update-payment-amount").value = parseFloat(amount.replace(/,/g, ''));;
        document.getElementById("update-payment-comments").value = comments;

      }
    function updatePayment(id, number, amount, date, comments){
        $.ajax({
            url: "{{route('payments.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "patient_id": {{ $patient_id }},
                "payment_id": id,
                "number": number,
                "amount": amount,
                "date": date,
                "comments": comments,
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
        setPaymentCount();
        $("#update-payment").click(function(){
            var payment_id = document.getElementById("update-payment-id").value;
            var number = document.getElementById("update-payment-number").value;

            var amount = Number(document.getElementById("update-payment-amount").value);

            var date = document.getElementById("update-payment-date").value;

            var comments = document.getElementById("update-payment-comments").value;

            if(amount > 0 && number > 0){
                updatePayment(payment_id, number, amount, date, comments);
            }

        });
    });
</script>

@endpush
