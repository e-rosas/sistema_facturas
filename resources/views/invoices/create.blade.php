@extends('layouts.app', ['title' => 'Facturas'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Registrar factura'])   

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- Patient --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Paciente</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                            @csrf
                            @component('components.searchPatients')
                                
                            @endcomponent

                        </form>
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
            {{--  Details  --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Factura</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                {{--  number --}}
                                <div class="col-md-2 col-auto form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-number">{{ __('Number') }}</label>
                                    <input type="text" name="number" id="input-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Number') }}" value="{{ old('number') }}" required>

                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  series --}}
                                <div class="col-md-2 col-auto form-group{{ $errors->has('series') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-series">{{ __('series') }}</label>
                                    <input type="text" name="series" id="input-series" class="form-control form-control-alternative{{ $errors->has('series') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('series') }}" value="{{ old('series') }}" required>

                                    @if ($errors->has('series'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('series') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  concept --}}
                                <div class="col-md-8 col-auto form-group{{ $errors->has('concept') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-concept">{{ __('concept') }}</label>
                                    <input type="text" name="concept" id="input-concept" class="form-control form-control-alternative{{ $errors->has('concept') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('concept') }}" value="{{ old('concept') }}" required>

                                    @if ($errors->has('concept'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('concept') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                            </div>
                            <div class="form-row">
                                {{--  currency --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-currency">Moneda</label>
                                    <input type="text" name="currency" id="input-currency" class="form-control form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}" 
                                    placeholder="Moneda" value="USD" required>

                                    @if ($errors->has('currency'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  method --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Forma de pago</label>
                                    <input type="text" name="method" id="input-method" class="form-control form-control-alternative{{ $errors->has('method') ? ' is-invalid' : '' }}" 
                                    placeholder="Forma de pago" value="Por definir" required>

                                    @if ($errors->has('method'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  date  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input  name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"  type="date" required>
                                    </div>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  exchange_rate --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-exchange_rate">Cambio</label>
                                    <input type="number" name="exchange_rate" id="input-exchange_rate" class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}" 
                                    placeholder="Cambio" value="{{ old('exchange_rate') }}" required>

                                    @if ($errors->has('exchange_rate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('exchange_rate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                {{--  amount_paid  
                                <div class="col-md-4 col-auto form-group{{ $errors->has('amount_paid') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount_paid">{{ __('Amount paid') }}</label>
                                    <input type="numeric" name="amount_paid" id="input-amount_paid" class="form-control form-control-alternative{{ $errors->has('amount_paid') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Amount paid') }}" value="{{ old('amount_paid') }}">

                                    @if ($errors->has('amount_paid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_paid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  amount_due  
                                <div class="col-md-4 col-auto form-group{{ $errors->has('amount_due') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount_due">{{ __('Amount due') }}</label>
                                    <input type="numeric" name="amount_due" id="input-amount_due" class="form-control form-control-alternative{{ $errors->has('amount_due') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Amount due') }}" value="{{ old('amount_due') }}">

                                    @if ($errors->has('amount_due'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_due') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-row">
                                {{--  Comments  --}}
                                <div class="col-md-12 col-auto form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comments">{{ __('Comments') }}</label>
                                    <input type="text" name="comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Comments') }}" value="{{ old('comments') }}">

                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  IVA  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('IVA') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-IVA">{{ __('IVA') }}</label>
                                    <input type="numeric" name="IVA" id="input-IVA" class="form-control form-control-alternative{{ $errors->has('IVA') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('IVA') }}" value="{{ old('IVA') }}" readonly>
                            
                                    @if ($errors->has('IVA'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('IVA') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                                             
                                {{--  subtotal  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('subtotal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subtotal">Subtotal</label>
                                    <input type="numeric" name="subtotal" id="input-subtotal" class="form-control form-control-alternative{{ $errors->has('subtotal') ? ' is-invalid' : '' }}" 
                                    placeholder="0" value="{{ old('subtotal') }}">
                            
                                    @if ($errors->has('subtotal'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subtotal') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{--  IVA_applied  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('IVA_applied') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-IVA_applied">IVA aplicado</label>
                                    <input type="numeric" name="IVA_applied" id="input-IVA_applied" class="form-control form-control-alternative{{ $errors->has('IVA_applied') ? ' is-invalid' : '' }}" 
                                    placeholder="0" value="{{ old('IVA_applied') }}" readonly>

                                    @if ($errors->has('IVA_applied'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('IVA_applied') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            
                                
                            
                                {{--  total  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('total') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">{{ __('Total') }}</label>
                                    <input type="numeric" name="total" id="input-total" class="form-control form-control-alternative{{ $errors->has('total') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Total') }}" value="{{ old('total') }}" readonly>
                            
                                    @if ($errors->has('total'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                            </div>
                            <div class="form-row">                            
                                {{-- Confirm --}}
                                <div class="text-right col-md-11 col-auto">
                                    <button type="button" id="save" class="btn btn-success  text-right">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>               
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script>
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function getCorrectDate(date){
        utcDate = new Date(date); //Date object a day behind
        return new Date(utcDate.getTime() + utcDate.getTimezoneOffset() * 60000)
    }


    const IVA = 0.08;
    IVA = 0;
    subtotal = 0;
    total = 0;


    function getService(id, quantity, price, discounted_price){
        $.ajax({
            url: "{{route('services.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "service_id" : id
            },
        success: function (response) {                
                addServiceToCart(response.id, response.description, 
                    price, discounted_price, quantity, services.length);                                    
            }
        });
            return false;
    }



    function sendInvoice(patient_id, series, number, concept, currency, 
        method,  date, subtotal, exchange_rate, comments){
        $.ajax({
            url: "{{route('invoices.store')}}",
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "patient_id" : patient_id,
                "date" : date,
                "comments" : comments,
                "number" : number,
                "series" : series,
                "concept" : concept,
                "subtotal" : subtotal,
                "currency" : currency,
                "method" : method,
                "exchange_rate" : exchange_rate,
            },
        success: function (response) {
            setTimeout(function() {
                window.location.href = response;
              }, 1000);
                                                   
            }
        });
            return false;
    }


    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    $(document).ready(function(){
        document.getElementById("input-date").value = today;



        
        $("#save").click(function(){
            var subtotal = Number(document.getElementById("input-subtotal").value); 
            var exchange_rate = Number(document.getElementById("input-exchange_rate").value); 
            if(subtotal > 0 && exchange_rate > 0 ) {
                var patient_id= $("#patient_id").children("option:selected").val();
                var date = document.getElementById("input-date").value; 
                var total = Number(document.getElementById("input-total").value); 
                var comments = document.getElementById("input-comments").value;
                var number = document.getElementById("input-number").value;  
                var series = document.getElementById("input-series").value; 
                var concept = document.getElementById("input-concept").value; 
                var currency = document.getElementById("input-currency").value; 
                var method = document.getElementById("input-method").value; 
                sendInvoice(patient_id, series, number, concept, currency, 
                    method,  date, subtotal, exchange_rate, comments);
            }
            
            else {
                alert("Ingrese subtotal y tipo de cambio.");
            }
            

        });
        $("#remove_selected").click(function(){

            

        });
    });
</script>
    
@endpush