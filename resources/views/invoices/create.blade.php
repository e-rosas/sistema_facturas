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
                                    <label class="form-control-label" for="input-number">Folio</label>
                                    <input type="text" name="number" id="input-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                    placeholder="Folio" value="{{ old('number') }}">

                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  series --}}
                                <div class="col-md-2 col-auto form-group{{ $errors->has('series') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-series">Serie</label>
                                    <input type="text" name="series" id="input-series" class="form-control form-control-alternative{{ $errors->has('series') ? ' is-invalid' : '' }}" 
                                    placeholder="Serie" value="D">

                                    @if ($errors->has('series'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('series') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  concept --}}
                                <div class="col-md-8 col-auto form-group{{ $errors->has('concept') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-concept">Concepto</label>
                                    <input type="text" name="concept" id="input-concept" class="form-control form-control-alternative{{ $errors->has('concept') ? ' is-invalid' : '' }}" 
                                    placeholder="Concepto" value="Factura dolares Aseguranza">

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
                            <div class="form-row">
                                {{--  code --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-code">Numero</label>
                                    <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                    placeholder="Numero" value="{{ old('code') }}">

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
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
                                
                            </div>
                            <div class="form-row">
                                {{--  tax  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('tax') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tax">{{ __('Tax') }}</label>
                                    <input type="numeric" name="tax" id="input-tax" class="form-control form-control-alternative{{ $errors->has('tax') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Tax') }}" value="{{ old('tax') }}" readonly>
                            
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
                                    placeholder="{{ __('Subtotal') }}" value="{{ old('sub_total') }}" readonly>
                            
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
                                    placeholder="{{ __('Total') }}" value="{{ old('total') }}" readonly>
                            
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
                                    <label class="form-control-label" for="input-dtax">{{ __('Tax with discounts') }}</label>
                                    <input type="numeric" name="dtax" id="input-dtax" class="form-control form-control-alternative" 
                                    placeholder="0" value="0" readonly>
                                </div>
                                {{--  sub_total_discounts  --}}
                                <div class="col-md-4 col-auto form-group">
                                    <label class="form-control-label" for="input-sub_total_discounts">{{ __('Subtotal with discounts') }}</label>
                                    <input type="numeric" name="sub_total_discounts" id="input-sub_total_discounts" class="form-control form-control-alternative" 
                                    placeholder="0" value="0" readonly>
                                </div>
                                {{--  total_with_discounts  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('total_with_discounts') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total_with_discounts">{{ __('Total with discounts') }}</label>
                                    <input type="numeric" name="total_with_discounts" id="input-total_with_discounts" class="form-control form-control-alternative{{ $errors->has('total_with_discounts') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Total with discounts') }}" value="{{ old('total_with_discounts') }}" readonly>
                            
                                    @if ($errors->has('total_with_discounts'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_with_discounts') }}</strong>
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
        <div class="row">
            {{-- Services --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Services') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">{{ __('Add Service') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Selecting service --}}
                        <div class="col-xl-12 order-xl-1">
                                @component('components.searchServices')
                                
                                @endcomponent                          
                        </div>
                        <br />
                        <div class="form-row">
                            {{--  date  --}}
                            <div class="col-lg-2 col-auto">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input name="date_service" id="input-date_service" class="form-control form-control-alternative"  type="date" required>
                                </div>
                            </div>
                            {{--  price  --}}
                            <div class="col-lg-2 col-auto form-group">
                                <input type="numeric"  name="quantity" id="custom-price" class="form-control form-control-alternative" 
                                placeholder="Price" required>
                            
                            </div>
                            {{--  discounted-price  --}}
                            <div class="col-lg-2 col-auto form-group">
                                <input type="numeric" min="1" name="quantity" id="custom-discounted-price" class="form-control form-control-alternative" 
                                placeholder="Discounted"  required>
                            
                            </div>
                            {{--  quantity  --}}
                            <div class="col-lg-2 col-auto form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <input type="numeric" min="1" name="quantity" id="input-quantity" class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                placeholder="Quantity" value=1 required>
                            
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Add --}}
                            <div class=" col-lg-2 col-md-3 form-group col-auto text-right">
                                <button type="button" id="add_service" class="btn btn-outline-success">{{ __('Add') }}</button>
                            </div>
                        </div>
                        
                        {{-- Table of services --}}
                        <div  class="table-responsive">
                            <table id="services_table" class="table align-services-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        <th scope="col">{{ __('Description') }}</th>
                                        <th scope="col">{{ __('Price') }}</th>
                                        <th scope="col">{{ __('Discounted Price') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col">{{ __('Total Price') }}</th>
                                        <th scope="col">{{ __('Total Discounted Price') }}</th>
                                        <th scope="col">{{ __('Items') }}</th>
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
                            <div class="text-right col-md-1 col-auto">
                                <button type="button" id="remove_selected" class="btn btn-danger btn-sm">{{ __('Remove selected') }}</button>
                            </div>
                            {{-- Confirm --}}
                            <div class="text-right col-md-11 col-auto">
                                <button type="button" id="save" class="btn btn-success  text-right">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>
        @include('items.partials.itemsModal')
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script>
    function handler(e){
        var date = document.getElementById("input-date").value;
        document.getElementById("input-date_service").value = date;
      }
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function getCorrectDate(date){
        utcDate = new Date(date); //Date object a day behind
        return new Date(utcDate.getTime() + utcDate.getTimezoneOffset() * 60000)
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
        created_at = new Date();
        constructor(service_id, description, price, discounted_price, quantity, id, created_at) {
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
            this.date2 = getCorrectDate(created_at);
            this.created_at = this.date2.toISOString().split('T')[0]+' '+this.date2.toTimeString().split(' ')[0];
        }

        get date(){
            return this.date2.toLocaleDateString();
        }

        // Add to cart
        addItemToCart(item_id, description, price, discounted_price, quantity, id, taxable) {
            for(var item in this.items) {
                if(this.items[item].item_id === item_id) {
                    this.items[item].quantity += Number(quantity);
                    displayItems(this);
                    return;
                }
            }
            
            var item = new Item(item_id, description, price, discounted_price, quantity, id, taxable);
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

            for(var item in this.items) {
                this.items[item].calcTotals();
                this.tax += this.items[item].itax;
                this.dtax += this.items[item].idtax;
                this.sub_total += this.items[item].sub_total_price;
                this.sub_total_discounted += this.items[item].sub_total_discounted_price;
                this.total_price += this.items[item].total_price;
                this.total_discounted_price += this.items[item].total_discounted_price;
            }
        }
        
    }

    class Item {
        quantity = 1;
        itax = 0;
        idtax = 0;
        constructor(item_id, description, price, discounted_price, quantity, id, taxable) {
            this.item_id = item_id;
            this.description = description;
            this.price = parseFloat(price.replace(/,/g,''));
            this.discounted_price = parseFloat(discounted_price.replace(/,/g,''));
            this.quantity = quantity;
            this.sub_total_price = quantity * price;
            this.sub_total_discounted_price = quantity * discounted_price;
            this.id = id;
            this.taxable = taxable
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
    tax = 0;
    dtax = 0;
    sub_total = 0;
    sub_total_discounted = 0;
    total = 0;
    total_with_discounts = 0;

    // Add to cart
    function addServiceToCart(service_id, description, price, discounted_price, quantity, id) {
        for(var service in this.services) {
            if(this.services[service].id === id) {
                this.services[service].quantity += Number(quantity);
                displayCart();
                return;
            }
        }

        var created_at = document.getElementById("input-date_service").value;
        
        var service = new Service(service_id, description, price, discounted_price, quantity, id, created_at);
        this.services.push(service);   
        displayCart();  
    }
    // Remove service from cart
    function removeServiceFromCart(service_id) {
        for(var service in this.services) {
            if(this.services[service].service_id === service_id) {
                this.services[service].quantity --;
                if(this.services[service].quantity === 0) {
                    this.services.splice(service, 1);
                }
                break;
            }
        };
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

    function getItem(service_id, item_id, quantity){
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
                    response.price, response.discounted_price, response.tax, quantity, services.length);                                    
            }
        });
            return false;
    }

    function addItemToService(service_id, item_id, description, price, discounted_price, tax, quantity, id){

        //Find service in array
        var service = this.services.find(s => s.id == service_id);

        service.addItemToCart(item_id, description, price, 
                discounted_price, quantity, services.length, tax);
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


    function sendCart(person_data_id, date, amount_due, amount_paid,
         comments, number){
        $.ajax({
            url: "{{route('invoices.store')}}",
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id" : person_data_id,
                "date" : date,
                "amount_due" : 0,
                "amount_paid" : 0,
                "comments" : comments,
                "number" : number,
                "services" : this.services,
                "total" : total,
                "sub_total" : sub_total,
                "sub_total_discounted" : sub_total_discounted,
                "total_with_discounts" : total_with_discounts,
                "tax" : tax,
                "dtax" : dtax,
                "status": "due"
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
            + "<td>  <input type='checkbox' name='service'>  </td>"
            + "<td>" + this.services[i].date + "</td>"
            + "<td>" + this.services[i].description + "</td>"
            + "<td>" + this.services[i].price + "</td>" 
            + "<td>" + this.services[i].discounted_price + "</td>"
            + "<td>" + this.services[i].quantity + "</td>"
            + "<td>" + this.services[i].total_price + "</td>"
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
        document.getElementById("input-date").value = today;
        document.getElementById("input-date_service").value = today;

        $("#person_data_id").change(function(){

            var selectedService= $(this).children("option:selected").val();
    
        });

        $("#add_service").click(function(){
            var quantity = Number(document.getElementById("input-quantity").value);
            

            if(quantity > 0){
                var price = document.getElementById("custom-price").value;
                price = parseFloat(price.replace(/,/g,''));
                var discounted_price = document.getElementById("custom-discounted-price").value;
                discounted_price = parseFloat(discounted_price.replace(/,/g,''));
                var service_id= $("#service_id").children("option:selected").val();
                getService(service_id, quantity, price, discounted_price);
            }
            
        });

        $("#add_item").click(function(){
            var quantity = Number(document.getElementById("input-product-quantity").value);
            if(quantity > 0){
                var item_id= $("#item_id").children("option:selected").val();
                getItem(selectedServiceId, item_id, quantity);
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


        
        $("#save").click(function(){
            var subtotal = Number(document.getElementById("input-subtotal").value); 
            var exchange_rate = Number(document.getElementById("input-exchange_rate").value); 
            if(services.length > 0 ) {
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

            $("#services_table tbody").find('input[name="service"]').each(function(){

                if($(this).is(":checked")){
                    var id = Number($(this).parents("tr").attr('value'));
                    removeServiceFromCartAll(id);                 
                }

            });
            displayCart();

        });
    });
    
</script>
    
@endpush