<div class="modal fade" id="modal-update-call" role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Editar llamada') }}</h6>                 
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div>                  
                            <div class="form-group">
                                {{--  Call --}}
                                <input readonly type="hidden" name="call_id" id="update-call_id" class="form-control"
                                 required>
                                
                                {{--  Number --}}
                                <div class="form-group ">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="numeric" readonly name="number" id="update-number" class="form-control" required>
                                    </div>
                                </div>
                                
                                {{--  Claim  --}}
                                <div class="form-group {{ $errors->has('claim') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="claim" id="update-claim" class="form-control {{ $errors->has('claim') ? ' is-invalid' : '' }}" 
                                        value="{{ old('claim') }}" placeholder="{{ __('Claim') }}">
                                        @if ($errors->has('claim'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim') }}</strong>
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
                                        <input onchange="handler(event);" type="date" name="date" id="update-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" 
                                        value="{{ old('date') }}" required>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  status  --}}
                                <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <select multiple class="form-control" id="update-status">
                                            <option value="0">{{ __('En proceso') }}</option>
                                            <option value="1">{{ __('Deducibles') }}</option>
                                            <option value="2">{{ __('Negada por cargos no cubiertos') }}</option>
                                            <option value="3">{{ __('Pagada') }}</option>
                                            <option value="4">{{ __('Negada por ') }}</option>
                                            <option value="5">{{ __('Otro') }}</option>
                                          </select>
                                    </div>
                                </div>
                                {{--  comments  --}}
                                <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <textarea type="text" rows="3" name="comments" id="update-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}" 
                                        value="{{ old('comments') }}" placeholder="{{ __('Comments') }}"></textarea>
                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                   
                                <div class="text-center">
                                    <button id="update_call" class="btn btn-block btn-success">{{ __('Save') }}</button>
                                </div>
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
    function setCallCount(){
        var n = document.getElementById("calls_table").rows.length;
        document.getElementById("input-number").value = n;
    }
    function updateCall(id, number, claim, date, 
    comments, status){
        $.ajax({
            url: "{{route('calls.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "number": number,
                "claim": claim,
                "date": date,
                "comments": comments,
                "status": status
            },
        success: function (response) {
            var calls = response.data;
            displayCalls(calls); //on callsModal
                
            $('#modal-update-call').modal('hide')
            }
        });
            return false;
    }

    function CallData(call_id, number, claim, date, 
        comments, status){
            document.getElementById("update-call_id").value = call_id;
            document.getElementById("update-number").value = number;
            document.getElementById("update-claim").value = claim;
            document.getElementById("update-date").value = date;
            document.getElementById("update-comments").value = comments;
            
    }

    function getCallData(id){
        $.ajax({
            url: "{{route('calls.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : id
            },
        success: function (data) {          
            CallData(data.id,data.number, data.claim, 
                    data.date, data.comments, data.status);                                 
            }
        });
            return false;
    }

    function DeleteCall(id){
        var r = confirm("Confirmar la eliminacion de la llamada");
        if(r){
            $.ajax({
                url: "{{route('calls.destroy')}}",
                dataType: 'json',
                type:"delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "call_id" : id
                },
            success: function (response) {
                displayCalls(response.data);
                }
            });
            return false;
        }

    }

    $(document).ready(function(){
        $('#calls_table').on("click", ".update-call", function(event) {
            var id = $(this).data('call');
            getCallData(id);


        })
        
        $("#update_call").click(function(){
            var call_id = document.getElementById("update-call_id").value;
            var number = document.getElementById("update-number").value;
            var claim = document.getElementById("update-claim").value;
            var date = document.getElementById("update-date").value;
            var comments = document.getElementById("update-comments").value;
            var status = document.getElementById("update-status").value;

            updateCall(call_id, number, claim, date, comments, status);
            
        });
    });
</script>
    
@endpush