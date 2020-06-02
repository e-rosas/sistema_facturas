@extends('layouts.app', ['title' => 'Facturas'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Editar Factura'])   

    <div class="container-fluid mt--7">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="row">
            {{-- Patient --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Paciente') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-primary">Regresar a la factura</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{--  Names  --}}
                        <div class="row">
                            <div class="form-group col-md-6 col-auto">
                                <label class="form-control-label" for="person_name">{{ __('Paciente') }}</label>
                                <h3>
                                    <a href="{{ route('patients.show', $invoice->patient) }}" class="mr-4">{{ $invoice->patient->full_name }} </a>
                                    
                                </h3>
                            </div>     
                            {{-- <div class="form-group col-md-6 col-auto text-right">
                                <button type="button" data-toggle="modal" data-target="#modal-person" class="btn btn-outline-info">Change</button>
                            </div>  --}}                   
                        </div>
                        
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
            {{--  Details  --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-red border-0">
                        <div class="row">
                            <div class="col-4 col-auto">
                                <h3 style="color:white" class="card-title text-uppercase  mb-0">Factura</h3>
                            </div>
                            {{--  @if ($invoice->status != 1) 
                                <div class="col-4 col-auto text-right">
                                    <button id="edit-details" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-details">Editar detalles</i></button>
                                    <br />
                                </div>
                            @endif
                            
                            @include('invoices.partials.updateDetailsModal',['invoice'=>$invoice])  --}}
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                            @csrf
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
                                    <label id="label-exchange_rate">{{ $invoice->exchange_rate }}</label>
                
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
                            <div class="form-row">
                                {{--  amount_due  --}}
                                <div class="col-md-2 col-auto form-group{{ $errors->has('amount_due') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount_due">Debe</label>
                                    <input type="numeric" name="amount_due" id="input-amount_due" class="form-control form-control-alternative{{ $errors->has('amount_due') ? ' is-invalid' : '' }}" 
                                    placeholder="0" value="{{ $invoice->amount_due }}" readonly>

                                    @if ($errors->has('amount_due'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_due') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="form-row">
                                {{--  tax  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('tax') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tax">{{ __('Tax') }}</label>
                                    <input type="numeric" name="tax" id="input-tax" class="form-control form-control-alternative{{ $errors->has('tax') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Tax') }}" value="" readonly>
                            
                                    @if ($errors->has('tax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                {{--  sub_total  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('sub_total') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-sub_total">{{ __('Subtotal') }}</label>
                                    <input type="numeric" name="sub_total" id="input-sub_total" class="form-control form-control-alternative{{ $errors->has('sub_total') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Subtotal') }}" value="" readonly>
                            
                                    @if ($errors->has('sub_total'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sub_total') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{--  total  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('total') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">{{ __('Total') }}</label>
                                    <input type="numeric" name="total" id="input-total" class="form-control form-control-alternative{{ $errors->has('total') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Total') }}" value="" readonly>
                            
                                    @if ($errors->has('total'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                            </div>
                            <div class="form-row">
                                {{--  dtax  --}}
                                <div class="col-md-4 col-auto form-group">
                                    <label class="form-control-label" for="input-dtax">IVA con descuento</label>
                                    <input type="numeric" name="dtax" id="input-dtax" class="form-control form-control-alternative" 
                                    placeholder="0" value="{{ $invoice->dtax }}" readonly>
                                </div>
                                {{--  sub_total_discounts  --}}
                                <div class="col-md-4 col-auto form-group">
                                    <label class="form-control-label" for="input-sub_total_discounts">Subtotal con descuento</label>
                                    <input type="numeric" name="sub_total_discounts" id="input-sub_total_discounts" class="form-control form-control-alternative" 
                                    placeholder="0" value="{{ $invoice->sub_total_discounted }}" readonly>
                                </div>
                                {{--  total_with_discounts  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('total_with_discounts') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total_with_discounts">Total con descuento</label>
                                    <input type="numeric" name="total_with_discounts" id="input-total_with_discounts" class="form-control form-control-alternative{{ $errors->has('total_with_discounts') ? ' is-invalid' : '' }}" 
                                    placeholder="0" value="{{ $invoice->total_with_discounts }}" readonly>
                            
                                    @if ($errors->has('total_with_discounts'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_with_discounts') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
            {{-- Diagnosticos --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Diagnósticos') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('diagnoses.create') }}" class="btn btn-sm btn-primary">{{ __('Registar nuevo diagnóstico') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{--  Diagnoses  --}}
                        <div class="form-row">
                            @include('components.searchDiagnoses')  
                            <div class="col-md-2">
                                <label class="form-control-label"></label>
                                <button type="button" onclick="addDiagnosisList()" id="add_diagnosis" class="btn btn-outline-success btn-lg">Agregar</button>
                            </div>
                            {{-- <div id="diagnoses_list">

                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <table id="diagnoses_table" class="table align-items-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">{{ __('Seleccionar') }}</th>
                                        <th scope="col">{{ __('Código') }}</th>
                                        <th scope="col">{{ __('Nombre') }}</th>
                                        <th scope="col">{{ __('Remover') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
            {{-- Services --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Servicios') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">{{ __('Registrar un nuevo servicio') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Selecting service --}}
                        <div class="col-xl-12 order-xl-1">
                                @include('components.searchServices')                        
                        </div>
                        <br />
                        <div class="form-row">
                            {{--  date  --}}
                            <div class="col-lg-3 col-auto">
                                <label class="form-control-label"   for="input-date_service">Fecha de servicio (de)</label>
                                <input name="date_service" onchange="service_handler(event)" id="input-date_service" class="form-control form-control-alternative"  type="date" required>
                            </div>
                            {{--  date  --}}
                            <div class="col-lg-3 col-auto">
                                <label class="form-control-label" for="input-date_service-to">Fecha de servicio (a)</label>
                                <input name="date_service-to" id="input-date_service-to" class="form-control form-control-alternative"  type="date" required>
                            </div>
                            {{--  price  --}}
                            <div class="col-lg-2 col-auto form-group">
                                <label class="form-control-label" for="custom-price">Precio</label>
                                <input type="numeric"  name="service-price" id="custom-price" class="form-control form-control-alternative" 
                                placeholder="0" required>
                            
                            </div>
                            {{--  discounted-price  
                            <div class="col-lg-2 col-auto form-group">
                                <label class="form-control-label" for="custom-discounted-price">Descuento</label>
                                <input type="numeric" min="1" name="service-discounted-price" id="custom-discounted-price" class="form-control form-control-alternative" 
                                placeholder="0"  required>
                            
                            </div>--}}
                            <input type="hidden" min="1" name="service-discounted-price" id="custom-discounted-price" class="form-control form-control-alternative" 
                            placeholder="0"  required>
                            {{--  quantity  --}}
                            <div class="col-lg-1 col-auto form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-quantity">Cantidad</label>
                                <input type="numeric" min="1" name="quantity" id="input-quantity" class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                placeholder="1" value=1 required>
                            
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Add --}}
                            <div class=" col-lg-1 col-md-3 form-group col-auto text-right">
                                <label class="form-control-label"></label>
                                <button type="button" id="add_service" class="btn btn-outline-success btn-lg">Agregar</button>
                            </div>
                        </div>
                        {{-- Table of services --}}
                        <div  class="table-responsive">
                            <table id="services_table" class="table table-sm align-services-center table-flush ">
                                <thead class="thead-light ">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Fecha') }}</th>
                                        <th scope="col">{{ __('Descripción') }}</th>
                                        <th scope="col">{{ __('Diagnóstico') }}</th>
                                        <th scope="col">{{ __('Precio') }}</th>
                                        <th scope="col">{{ __('Cantidad') }}</th>
                                        <th scope="col">{{ __('Total') }}</th>
                                        <th scope="col">{{ __('Articulos') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <div class="form-row">                            
                            {{-- Remove --}}
                            <div class="col-md-3 col-auto">
                                <button type="button" id="remove_selected" class="btn btn-danger btn-sm">Remover servicio seleccionado</button>
                            </div>
                            {{-- Confirm --}}
                            <div class="text-right col-md-9 col-auto">
                                <button type="button" id="save" class="btn btn-success text-right">Confirmar</button>
                            </div>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>

        @include('items.partials.itemsModal')

        {{-- @include('components.selectPersonModal', ['invoice_id' => $invoice->id]) --}}
        
        @include('layouts.footers.auth')
    </div>
@endsection
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
    function handler(e){
        var date = document.getElementById("input-date").value;
        document.getElementById("input-date_service").value = date;
        getExchangeRate(date);
      }
      function service_handler(e){
        var date = document.getElementById("input-date_service").value;
        document.getElementById("input-date_service-to").value = date;
    }
    function getExchangeRate(date){
        $.ajax({
            url: "{{route('rate.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "date": date,
            },
        success: function (response) {
            document.getElementById("invoice-exchange_rate").value = response.value;
            }
        });
        return false;
    }
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function getCorrectDate(date){
        utcDate = new Date(date); //Date object a day behind
        return new Date(utcDate.getTime() + utcDate.getTimezoneOffset() * 60000)
    }
    function addDiagnosisList(){
        var diagnosis_id = Number(document.getElementById("diagnosis_id").value);
        findDiagnosis(diagnosis_id);
        
    }

    function displayDiagnosisList(){
        var output = "";
        for(var i in diagnosesList) {
            output += "<tr value="+diagnosesList[i].diagnosis_id+">"
                + "<td>  <input type='checkbox'  name='active'></td>"
                + "<td id=diagnosis"+diagnosesList[i].diagnosis_id+">" + diagnosesList[i].diagnosis_code + "</td>"
                + "<td>" + diagnosesList[i].name + "</td>"
                + "<td><button onclick='removeDiagnosis("+diagnosesList[i].diagnosis_id+")' class='delete-item btn btn-sm btn-danger' id=" + diagnosesList[i].diagnosis_id+ ">X</button></td>"
                +  "</tr>";
        }
        $('#diagnoses_table tbody').html(output);
        /*var output = "<div class='form-row'>";
        for(var i in diagnosesList) {
            var r = i % 4;
            if(i != 0 && r === 0){ //new rows
                output += "</div><div class='form-row'>";
            }
            output += "<div class='col-auto custom-control custom-checkbox custom-control-inline'>"
                + "<input type='checkbox' class='custom-control-input' id=diag" + diagnosesList[i].diagnosis_id + " data-id=" + diagnosesList[i].diagnosis_id + " data-code="+diagnosesList[i].diagnosis_code +">"     
                + "<label class='custom-control-label' for=diag" + diagnosesList[i].diagnosis_id + ">"+diagnosesList[i].name +"        </label>" 
                + "<button onclick='removeDiagnosis("+diagnosesList[i].diagnosis_id+")' class='delete-item btn btn-sm btn-danger' id=" + diagnosesList[i].diagnosis_id+ ">X</button>"
                +"</div>";
          
        }
        $('#diagnoses_list').html(output);*/
    }
    class Diagnosis {
        diagnosis_id = 0;
        diagnosis_code = "";
        name = "";
        nombre = "";
        constructor(diagnosis_id, diagnosis_code, name, nombre){
            this.diagnosis_id = diagnosis_id;
            this.diagnosis_code = diagnosis_code;
            this.name = name;
            this.nombre = nombre;
        }
    }
    class Service {
        quantity = 1;
        items = [];
        tax = 0;
        dtax = 0;
        sub_total = 0;
        sub_total_discounted = 0;
        total_price = 0;
        total_discounted_price = 0;
        diagnoses_pointers = "";
        DOS = new Date();
        DOS_to = this.DOS;

        items_sub_total = 0;
        items_sub_total_discounted = 0;
        items_total_price = 0;
        items_total_discounted_price = 0;

        constructor(service_id, description, price, discounted_price, quantity, id, 
            DOS,DOS_to, descripcion, code, pointers) {
            this.service_id = service_id;
            this.description = description;
            this.base_price = price;
            this.base_discounted_price = discounted_price;
            this.price = this.base_price;
            this.discounted_price = this.base_discounted_price;
            this.quantity = quantity;
            this.total_price = quantity * price;
            this.total_discounted_price = quantity * discounted_price;
            this.id = id;
            this.descripcion = descripcion;
            this.code = code;
            this.date2 = getCorrectDate(DOS);
            this.DOS = this.date2.toISOString().split('T')[0]+' '+this.date2.toTimeString().split(' ')[0];
            this.date3 = getCorrectDate(DOS_to);
            this.DOS_to = this.date3.toISOString().split('T')[0]+' '+this.date3.toTimeString().split(' ')[0];
            this.diagnoses_pointers = pointers;
        }

        get date(){
            return this.date2.toLocaleDateString();
        }

        // Add to cart
        addItemToCart(item_id, description, price, discounted_price, quantity, 
            id, taxable, descripcion, code) {
            for(var item in this.items) {
                if(this.items[item].item_id === item_id && this.items[item].discounted_price === discounted_price) {
                    this.items[item].quantity += Number(quantity);
                    displayItems(this);
                    return;
                }
            }
            
            var item = new Item(item_id, description, price, discounted_price, quantity, 
                id, taxable, descripcion, code);
            this.items.push(item);   
            displayItems(this);  
        }

        // Remove item from cart
        removeItemFromCart(id) {
            for(var item in this.items) {
                if(this.items[item].service_id === service_id) {
                    this.items[item].quantity --;
                    if(this.items[item].quantity === 0) {
                        this.items.splice(item, 1);
                    }
                    break;
                }
            };
        }

        removeItemFromCartAll(id) {
            for(var item in this.items) {
              if(this.items[item].id === id) {
                this.items.splice(item, 1);
                break;
              }
            }
            displayItems(this);  
        }

        // Total cart
        totalItemsCart() {

            this.tax = 0;
            this.dtax = 0;
            this.sub_total = this.base_price * this.quantity;
            this.sub_total_discounted = this.base_discounted_price * this.quantity;
            this.total_price = this.sub_total;
            this.total_discounted_price = this.sub_total_discounted;

            this.items_sub_total = 0;
            this.items_sub_total_discounted = 0;
            this.items_total_price = 0;
            this.items_total_discounted_price = 0;

            for(var item in this.items) {
                this.items[item].calcTotals();
                this.tax += this.items[item].itax;
                this.dtax += this.items[item].idtax;
                this.items_sub_total += this.items[item].sub_total_price;
                this.items_sub_total_discounted += this.items[item].sub_total_discounted_price;
                this.items_total_price += this.items[item].total_price;
                this.items_total_discounted_price += this.items[item].total_discounted_price;
            }
        }
        
    }

    class Item {
        quantity = 1;
        itax = 0;
        idtax = 0;
        constructor(item_id, description, price, discounted_price, quantity,
             id, taxable, descripcion, code) {
            this.item_id = item_id;
            this.description = description;
            this.price = parseFloat(price.replace(/,/g,''));
            this.discounted_price = parseFloat(discounted_price.replace(/,/g,''));
            this.quantity = quantity;
            this.sub_total_price = quantity * price;
            this.sub_total_discounted_price = quantity * discounted_price;
            this.id = id;
            this.taxable = taxable
            this.descripcion = descripcion;
            this.code = code;
            this.calcTotals();          
        }

        calcTotals() {
            this.sub_total_price = this.quantity * this.price;
            this.sub_total_discounted_price = this.quantity * this.discounted_price;
            if(this.taxable){
                this.itax = this.sub_total_price * TAX;
                this.idtax = this.sub_total_discounted_price * TAX;
            }
            this.total_price = this.sub_total_price + this.itax;
            this.total_discounted_price = this.sub_total_discounted_price + this.idtax;
        }
    }

    const TAX = 0.08;

    services = [];
    diagnosesList = [];
    tax = 0;
    dtax = 0;
    sub_total = 0;
    sub_total_discounted = 0;
    total = 0;
    total_with_discounts = 0;

    function addDiagnosis(diagnosis_id, diagnosis_code, name, nombre){
        for(var d in this.diagnosesList) {
            if(this.diagnosesList[d].diagnosis_id === diagnosis_id) {
                return;
            }
        }
        var diagnosis = new Diagnosis(diagnosis_id, diagnosis_code, name, nombre);
        this.diagnosesList.push(diagnosis);
        displayDiagnosisList();
    }

    function removeDiagnosis(id) {
        for(var diagnosis in this.diagnosesList) {
            if(this.diagnosesList[diagnosis].diagnosis_id === id) {
                this.diagnosesList.splice(diagnosis, 1);
                break;
            }
        };
        displayDiagnosisList();
    }

     // Add to cart
     function addServiceToCart(service_id, description, price, discounted_price,
         quantity, id, descripcion, code, pointers) {
        for(var service in this.services) {
            if(this.services[service].service_id === service_id) {
                this.services[service].quantity += Number(quantity);
                displayCart();
                return;
            }
        }

        var DOS = document.getElementById("input-date_service").value;
        var DOS_to = document.getElementById("input-date_service-to").value;
        var service = new Service(service_id, description, price, discounted_price, 
            quantity, id, DOS,DOS_to, descripcion, code, pointers);
        this.services.push(service);   
        displayCart();  
    }
    function addDiagnosisFromInvoice(diagnosis_id, name, code, nombre) {
        
        var diagnosis = new Diagnosis(diagnosis_id, name,  code, nombre);
        this.diagnosesList.push(diagnosis);

        
    }
    function addServiceToCartFromInvoice(service_id, description, price, discounted_price,
         quantity, id, DOS, items, descripcion, code, pointers, DOS_to) {
        
        var service = new Service(service_id, description, price, discounted_price, quantity, 
                services.length, DOS, DOS_to, descripcion, code, pointers);
        for(var i in items){
            var tax = false;
            if(items[i].itax > 0) tax = true;
            service.addItemToCart(items[i].item_id, items[i].description,items[i].price, items[i].discounted_price, 
            items[i].quantity, services.length, tax, items[i].descripcion, items[i].code);
        }
        this.services.push(service);
    }

    function removeServiceFromCartAll(service_id) {
        for(var service in this.services) {
          if(this.services[service].id=== service_id) {
            services.splice(service, 1);
            break;
          }
        }
        displayCart();
    }
    // Clear cart
    function clearCart(){
        this.services = [];
    }
    // Count cart 
    function totalCount() {
        var totalCount = 0;
        for(var service in this.services) {
            totalCount += this.services[service].quantity;
        }
        return totalCount;
    }
    // Total cart
    function totalCart() {
        this.tax = 0;
        this.dtax = 0;
        this.sub_total = 0;
        this.sub_total_discounted = 0;
        this.total = 0;
        this.total_with_discounts = 0;
        for(var service in this.services) {
            this.services[service].totalItemsCart();

            this.tax += this.services[service].tax;
            this.dtax += this.services[service].dtax;
            this.sub_total += this.services[service].sub_total;
            this.sub_total_discounted += this.services[service].sub_total_discounted;
            this.total += this.services[service].total_price;
            this.total_with_discounts += this.services[service].total_discounted_price;
        }
    }

    function totalDiscounts() {
        return Number(this.total_with_discounts);
    }

    function getInvoiceServices(id){
        $.ajax({
            url: "{{route('invoice.services')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id" : id
            },
        success: function (response) {
            for(var i = 0; i < response.length; i++){
                addServiceToCartFromInvoice(response[i].service_id, response[i].description, 
                    response[i].price, response[i].discounted_price, response[i].quantity, 
                    response[i].id, response[i].DOS, response[i].items, 
                    response[i].descripcion, response[i].code, response[i].diagnoses_pointers, response[i].DOS_to);   
            }
            displayCart();                
                                                 
            }
        });
            return false;
    }

    function getInvoiceDiagnoses(id){
        $.ajax({
            url: "{{route('invoice.diagnoses')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id" : id
            },
        success: function (response) {
            for(var i = 0; i < response.data.length; i++){
                addDiagnosisFromInvoice(response.data[i].diagnosis_id, response.data[i].diagnosis_name, 
                    response.data[i].diagnosis_code, response.data[i].diagnosis_nombre, response.data[i].quantity);   
            }
            displayDiagnosisList();            
                                                 
            }
        });
        return false;
    }

    function findDiagnosis(diagnosis_id){
        $.ajax({
            url: "{{route('diagnoses.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "diagnosis_id" : diagnosis_id
            },
        success: function (response) {      
                addDiagnosis(diagnosis_id, response.code, response.name, response.nombre);                            
            }
        });
            return false;
    }

    function getService(id, quantity, price, discounted_price, pointers){
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
                    price, discounted_price, quantity, services.length,
                    response.descripcion, response.code, pointers);                                    
            }
        });
            return false;
    }

    function getItem(service_id, item_id, quantity, price, discounted_price, tax){
        $.ajax({
            url: "{{route('items.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "item_id" : item_id
            },
        success: function (response) {                
                addItemToService(service_id, response.id, response.description, 
                    price, discounted_price, tax, quantity,
                     services.length, response.descripcion, response.code);                                    
            }
        });
            return false;
    }

    function addItemToService(service_id, item_id, description, price, discounted_price,
         tax, quantity, id, descripcion, code){

        //Find service in array
        var service = this.services.find(s => s.id == service_id);

        service.addItemToCart(item_id, description, price, 
                discounted_price, quantity, services.length, tax, descripcion, code);
    }

    function sendInvoice(){
            var DOS = document.getElementById("input-date_service-to").value;
        $.ajax({
            url: "{{route('invoice.update')}}",
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {!! $invoice->id !!},
                "diagnoses" : this.diagnosesList,
                "services" : this.services,
                "total" : total,
                "sub_total" : sub_total,
                "sub_total_discounted" : sub_total_discounted,
                "total_with_discounts" : total_with_discounts,
                "tax" : tax,
                "dtax" : dtax,
                "amount_due" : total_with_discounts,
                "DOS": DOS
            },
        success: function (response) {
            setTimeout(function() {
                window.location.href = response;
              }, 1000);              
            }
        });
            return false;
    }

    var selectedServiceId;


    function showProductsModal(id){
        selectedServiceId = id;
        //Find service in array
        var service = services.find(s => s.id == id);
        
        displayItems(service);
        $('#modal-items').modal('show')

    }

    function displayItems(service) {
        displayCart(); //displayCart -> totalCart -> totalItemsCart
        var output = "";
        document.getElementById("modal-service-description").innerHTML = service.description;
        document.getElementById("modal-service-discounted_total").innerHTML = service.total_discounted_price;
        if(service.items_total_discounted_price > service.total_discounted_price){
            document.getElementById("modal-items-discounted_total").className = "text-danger"; 
            document.getElementById("save").disabled = true;
        }
        else if(service.items_total_discounted_price < service.total_discounted_price) {
            document.getElementById("modal-items-discounted_total").className = "text-yellow";
        }
        else {
            document.getElementById("modal-items-discounted_total").className = "text-success"; 
        }
        document.getElementById("modal-items-discounted_total").innerHTML = service.items_total_discounted_price;
        for(var i in service.items) {
          output += "<tr value="+service.items[i].id+">"
            + "<td>" + service.items[i].description + "</td>"
            + "<td>" + service.items[i].price + "</td>" 
            + "<td>" + service.items[i].discounted_price + "</td>"
            + "<td>" + service.items[i].quantity + "</td>"
            + "<td>" + service.items[i].total_price + "</td>"
            + "<td>" + service.items[i].total_discounted_price +"</td>"
            + "<td><button class='delete-item btn btn-sm btn-danger' data-service=" + service.id + " data-id=" + service.items[i].id + ">X</button></td>"
        +"</tr>";
        }
        $('#items_table tbody').html(output);

        
         
    }
   

    function displayCart() {
        totalCart();
        var output = "";
        for(var i in this.services) {

          output += "<tr value="+this.services[i].id+">"
            + "<td><button class='delete-service btn btn-sm btn-danger' data-id=" + this.services[i].id + ">X</button></td>"
            + "<td>" + this.services[i].date + "</td>"
            + "<td>" + this.services[i].description + "</td>"
            + "<td>" + this.services[i].diagnoses_pointers + "</td>"
            + "<td>" + this.services[i].discounted_price + "</td>"
            + "<td>" + this.services[i].quantity + "</td>"
            + "<td>" + this.services[i].total_discounted_price + '</td>'
            + "<td>" + this.services[i].items.length + '</td>'
            +'<td><button class="btn btn-icon btn-outline-success btn-sm"  type="button" onClick="showProductsModal(\'' + this.services[i].id + '\')"><span class="btn-inner--icon"><i class="ni ni-atom"></i></span></button>'
            +'</td> </tr>';
        }
        $('#services_table tbody').html(output);
        document.getElementById("input-total").value = this.total;
        document.getElementById("input-total_with_discounts").value = this.total_with_discounts;
        document.getElementById("input-amount_due").value = this.total_with_discounts;
        document.getElementById("input-sub_total").value = this.sub_total;
        document.getElementById("input-sub_total_discounts").value = this.sub_total_discounted;
        document.getElementById("input-tax").value = this.tax; 
        document.getElementById("input-dtax").value = this.dtax;
    }
    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    $(document).ready(function(){
        document.getElementById("input-date_service").value = today;
        getInvoiceDiagnoses({!! $invoice->id !!});
        getInvoiceServices({!! $invoice->id !!});

        $("#add_service").click(function(){
            var quantity = Number(document.getElementById("input-quantity").value);
            var service_id= $("#service_id").children("option:selected").val();
            var pointers = "";
            var i = 0;
            $("#diagnoses_table tbody").find('input[name="active"]').each(function(){
                if($(this).is(":checked")){
                    i++;
                    pointers += i+",";
                    
                }
                

            });
            pointers = pointers.substring(0,pointers.length-1);
            
            if(quantity > 0 && service_id > 0 && pointers.length > 0){
                
                var price = document.getElementById("custom-price").value;
                price = parseFloat(price.replace(/,/g,''));
                var discounted_price = price; /*document.getElementById("custom-discounted-price").value;
                discounted_price = parseFloat(discounted_price.replace(/,/g,''));*/
                
                getService(service_id, quantity, price, discounted_price, pointers);
            }
            
        });

        $("#add_item").click(function(){
            var quantity = Number(document.getElementById("input-product-quantity").value);
            if(quantity > 0){
                var price = document.getElementById("custom-product-price").value;
                var discounted_price = document.getElementById("custom-product-discounted-price").value;
                var item_id = $("#item_id").children("option:selected").val();
                var tax = document.getElementById("custom-product-tax").checked;
                getItem(selectedServiceId, item_id, quantity, price, discounted_price, tax);
            }
            
        });

        // Delete item button
        $('#items_table').on("click", ".delete-item", function(event) {
            var id = $(this).data('id');
            var service_id = $(this).data('service');
            //Find service in array
            var service = services.find(s => s.id == service_id);
            
            service.removeItemFromCartAll(id);


        })

        $('#services_table').on("click", ".delete-service", function(event) {
            var service_id = $(this).data('id');
            removeServiceFromCartAll(service_id);
            displayCart();


        })

        
        $("#save").click(function(){
            if(services.length > 0 ) {
                sendInvoice();
            }
            
            else {
                alert("Falta agregar servicios a la factura.");
            }
            
            

        });
    });
    
</script>
    
@endpush