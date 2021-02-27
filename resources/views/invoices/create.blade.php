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
                            <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-primary">Regresar a la
                                lista</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                        @csrf
                        @include('components.searchPatients')

                    </form>
                    <div id="insurer-area" class="form-row" style="display: none">

                        <h3 id="patient-name"></h3>
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Aseguranza') }}
                                        </h5>
                                        <span id="insurer-name" class="h2 font-weight-bold mb-0"></span>

                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{--  Details  --}}
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8 col-auto">
                            <h3 class="mb-0">Factura</h3>
                        </div>
                        <div class="col-4 col-auto">
                            <label for="dental">Dental</label>
                            <label class="custom-toggle">
                                <input type="checkbox" id="dental" name="dental" class="custom-control-input"
                                    onclick="changeDentalStatusConfirmation(this.checked)">
                                .
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        {{--  number --}}
                        <div class="col-md-2 col-auto form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-number">Folio CONTPAQ</label>
                            <input type="text" name="number" id="input-number"
                                class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}"
                                placeholder="Folio" value="Pendiente">

                            @if ($errors->has('number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-1">
                            <label class="form-control-label" for="search-code">Buscar factura</label>
                            <button id="search_number" name="search-code" class="btn btn-info btn-fab btn-icon"
                                onclick="searchNumber()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        {{--  series --}}
                        <div class="col-md-2 col-auto form-group{{ $errors->has('series') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-series">Serie</label>
                            <input type="text" name="series" id="input-series"
                                class="form-control form-control-alternative{{ $errors->has('series') ? ' is-invalid' : '' }}"
                                placeholder="Serie" value="D">

                            @if ($errors->has('series'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('series') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{--  concept --}}
                        <div class="col-md-5 col-auto form-group{{ $errors->has('concept') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-concept">Concepto</label>
                            <input type="text" name="concept" id="input-concept"
                                class="form-control form-control-alternative{{ $errors->has('concept') ? ' is-invalid' : '' }}"
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
                            <input type="text" name="currency" id="input-currency"
                                class="form-control form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}"
                                placeholder="Moneda" value="USD" required>

                            @if ($errors->has('currency'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('currency') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        {{--  code --}}
                        <div class="col-md-3 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-code">Número (cobro)</label>
                            <input type="text" name="code" id="input-code"
                                class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                placeholder="Número" value="{{ old('code') }}">

                            @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-1">
                            <label class="form-control-label" for="search-claim">Buscar cobro</label>
                            <button id="search_claim" name="search-claim" class="btn btn-info btn-fab btn-icon"
                                onclick="searchClaim()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        {{--  date  --}}
                        <div class="col-md-4 col-auto form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-date">Fecha Facturación</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input onchange="handler(event)" name="date" id="input-date"
                                    class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                    type="date" required>
                            </div>
                            @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{--  exchange_rate --}}
                        <div class="col-md-2 form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="invoice-exchange_rate">Cambio</label>
                            <input type="numeric" name="exchange_rate" id="invoice-exchange_rate"
                                class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}"
                                placeholder="Cambio" value=0 required>

                            @if ($errors->has('exchange_rate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('exchange_rate') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{--  amount_due  --}}
                        <div class="col-md-2 col-auto form-group{{ $errors->has('amount_due') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-amount_due">Debe</label>
                            <input type="numeric" name="amount_due" id="input-amount_due"
                                class="form-control form-control-alternative{{ $errors->has('amount_due') ? ' is-invalid' : '' }}"
                                placeholder="0" value="{{ old('amount_due') }}" readonly>

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
                            <label class="form-control-label" for="input-tax">IVA</label>
                            <input type="numeric" name="tax" id="input-tax"
                                class="form-control form-control-alternative{{ $errors->has('tax') ? ' is-invalid' : '' }}"
                                placeholder="0" value="{{ old('tax') }}" readonly>

                            @if ($errors->has('tax'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tax') }}</strong>
                            </span>
                            @endif
                        </div>


                        {{--  sub_total  --}}
                        <div class="col-md-4 col-auto form-group{{ $errors->has('sub_total') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-sub_total">Subtotal</label>
                            <input type="numeric" name="sub_total" id="input-sub_total"
                                class="form-control form-control-alternative{{ $errors->has('sub_total') ? ' is-invalid' : '' }}"
                                placeholder="0" value="{{ old('sub_total') }}" readonly>

                            @if ($errors->has('sub_total'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sub_total') }}</strong>
                            </span>
                            @endif
                        </div>



                        {{--  total  --}}
                        <div class="col-md-4 col-auto form-group{{ $errors->has('total') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-total">Total</label>
                            <input type="numeric" name="total" id="input-total"
                                class="form-control form-control-alternative{{ $errors->has('total') ? ' is-invalid' : '' }}"
                                placeholder="0" value="{{ old('total') }}" readonly>

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
                            <input type="numeric" name="dtax" id="input-dtax"
                                class="form-control form-control-alternative" placeholder="0" value="0" readonly>
                        </div>
                        {{--  sub_total_discounts  --}}
                        <div class="col-md-4 col-auto form-group">
                            <label class="form-control-label" for="input-sub_total_discounts">Subtotal con
                                descuento</label>
                            <input type="numeric" name="sub_total_discounts" id="input-sub_total_discounts"
                                class="form-control form-control-alternative" placeholder="0" value="0" readonly>
                        </div>
                        {{--  total_with_discounts  --}}
                        <div
                            class="col-md-4 col-auto form-group{{ $errors->has('total_with_discounts') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-total_with_discounts">Total con
                                descuento</label>
                            <input type="numeric" name="total_with_discounts" id="input-total_with_discounts"
                                class="form-control form-control-alternative{{ $errors->has('total_with_discounts') ? ' is-invalid' : '' }}"
                                placeholder="0" value="{{ old('total_with_discounts') }}" readonly>

                            @if ($errors->has('total_with_discounts'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('total_with_discounts') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        {{--  comments --}}
                        <div class="col-md-12 col-auto form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-comments">Observaciones</label>
                            <input type="text" name="comments" id="input-comments"
                                class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                placeholder="Observaciones" value="{{ old('comments') }}">

                            @if ($errors->has('comments'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('comments') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        {{--  doctor --}}
                        <div class="col-md-12 col-auto form-group{{ $errors->has('doctor') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-doctor">Doctor</label>
                            <input type="text" name="doctor" id="input-doctor"
                                class="form-control form-control-alternative{{ $errors->has('doctor') ? ' is-invalid' : '' }}"
                                placeholder="Nombre, MD" value="">

                            @if ($errors->has('doctor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('doctor') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-1"></div>
                        {{-- hosp --}}
                        <div class="col-lg-2 custom-control custom-checkbox">
                            <input type="checkbox" name="input-hospitalization" id="input-hospitalization"
                                class="custom-control-input">
                            <label class="custom-control-label" for="input-hospitalization">Hospitalización</label>
                        </div>
                        @if (config('app.initial') == "C")
                        <div class="col-lg-2 custom-control custom-checkbox">
                            <input type="checkbox" name="input-cash" id="input-cash" class="custom-control-input">
                            <label class="custom-control-label" for="input-cash">Cash</label>
                        </div>
                        @else
                        <input type="checkbox" name="input-cash" id="input-cash" class="custom-control-input"
                            style="display: none">
                        @endif
                        <div class="col-lg-2 custom-control custom-checkbox">
                            <input type="checkbox" name="input-accept_assignment" id="input-accept_assignment"
                                class="custom-control-input">
                            <label class="custom-control-label" for="input-accept_assignment">¿Aceptar
                                asignación?</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="dental-details">
        {{--  Dental Details  --}}
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-services-center">
                        <div class="col-8 col-auto">
                            <h3 class="mb-0">Dental</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row ">
                        {{-- Enclosures --}}
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3 custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="input-enclosures" id="input-enclosures"
                                class="custom-control-input">
                            <label class="custom-control-label" for="input-enclosures">Enclosures</label>
                        </div>
                        <div class="col-lg-4 custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="input-orthodontics" id="input-orthodontics"
                                class="custom-control-input" onclick="changeOrthodonticsStatus(this.checked)">
                            <label class="custom-control-label" for="input-orthodontics">Tratamiento para
                                ortodoncia</label>
                        </div>
                        <div class="col-lg-4 custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="input-prosthesis" id="input-prosthesis"
                                class="custom-control-input">
                            <label class="custom-control-label" for="input-prosthesis">Reemplazo de
                                prótesis</label>
                        </div>
                    </div>
                    <div id="orthodontics-details" class="form-row">
                        {{-- Appliance date --}}
                        <div class="col-md-6 col-auto form-group">
                            <label class="form-control-label" for="input-placed">Fecha de colocación de aparato</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="placed" id="input-placed" class="form-control form-control-alternative"
                                    type="date" required>
                            </div>
                        </div>
                        {{-- Months remaining --}}
                        <div class="col-md-4 col-auto form-group">
                            <label class="form-control-label" for="input-months">Meses restantes</label>
                            <input type="number" name="months-remaining" id="input-months"
                                class="form-control form-control-alternative" value=0 required>
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- Prior placement date --}}
                        <div class="col-md-6 col-auto form-group">
                            <label class="form-control-label" for="input-prior-placement">Fecha de colocación
                                previa</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="prior-placement" id="input-prior-placement"
                                    class="form-control form-control-alternative" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-auto form-group">
                            <label for="input-treatment">{{ __('Tratamiento resultado de') }}</label>
                            <select id="input-treatment" class="custom-select" name="input-treatment">
                                <option value='3' selected>No Aplica</option>
                                <option value='0'>Lesión / enfermedad ocupacional</option>
                                <option value='1'>Accidente automovilístico</option>
                                <option value='2'>Otro accidente</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- Accident date --}}
                        <div class="col-md-4 col-auto form-group">
                            <label class="form-control-label" for="input-accident">Fecha de accidente</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="placed" id="input-accident" class="form-control form-control-alternative"
                                    type="date" required>
                            </div>
                        </div>
                        {{--  Auto Accident State --}}
                        <div class="col-md-4 col-auto form-group">
                            <label class="form-control-label" for="input-accident-state">Estado de accidente
                                automovilístico</label>
                            <input type="text" name="input-accident-state" id="input-accident-state"
                                class="form-control form-control-alternative">
                        </div>
                        {{--  License --}}
                        <div class="col-md-4 col-auto form-group">
                            <label class="form-control-label" for="input-license">Licencia (separar por coma)</label>
                            <input type="text" name="input-license" id="input-license"
                                class="form-control form-control-alternative">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="input-tooth-numbers">Dientes (separar por coma)</label>
                            <input type="text" name="input-tooth-numbers" id="input-tooth-numbers"
                                class="form-control form-control-alternative">
                        </div>
                    </div>
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
                            <a href="{{ route('diagnoses.create') }}"
                                class="btn btn-sm btn-primary">{{ __('Registar nuevo diagnóstico') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{--  Diagnoses  --}}
                    <div class="form-row">
                        @include('components.searchDiagnoses')
                        <div class="col-md-2">
                            <label class="form-control-label"></label>
                            <button type="button" onclick="addDiagnosisList()" id="add_diagnosis"
                                class="btn btn-outline-success btn-lg">Agregar</button>
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
                            <a href="{{ route('services.create') }}"
                                class="btn btn-sm btn-primary">{{ __('Registrar un nuevo servicio') }}</a>
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
                            <label class="form-control-label" for="input-date_service">Fecha de servicio (de)</label>
                            <input name="date_service" onchange="service_handler(event)" id="input-date_service"
                                class="form-control form-control-alternative" type="date" required>
                        </div>
                        {{--  date  --}}
                        <div class="col-lg-3 col-auto">
                            <label class="form-control-label" for="input-date_service-to">Fecha de servicio (a)</label>
                            <input name="date_service-to" id="input-date_service-to"
                                class="form-control form-control-alternative" type="date" required>
                        </div>
                        {{--  price  --}}
                        <div class="col-lg-2 col-auto form-group">
                            <label class="form-control-label" for="custom-price">Precio</label>
                            <input type="numeric" name="service-price" id="custom-price"
                                class="form-control form-control-alternative" placeholder="0" required>

                        </div>
                        {{--  discounted-price  --}}
                        {{-- <div class="col-lg-2 col-auto form-group">
                                <label class="form-control-label" for="custom-discounted-price">Descuento</label>
                                <input type="numeric" min="1" name="service-discounted-price" id="custom-discounted-price" class="form-control form-control-alternative"
                                placeholder="0"  required>

                            </div> --}}
                        <input type="hidden" min="1" name="service-discounted-price" id="custom-discounted-price"
                            class="form-control form-control-alternative" placeholder="0" required>
                        {{--  quantity  --}}
                        <div class="col-lg-1 col-auto form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-quantity">Cantidad</label>
                            <input type="numeric" min="1" name="quantity" id="input-quantity"
                                class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
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
                            <button type="button" id="add_service"
                                class="btn btn-outline-success btn-lg">Agregar</button>
                        </div>
                    </div>
                    {{-- Table of services --}}
                    <div class="table-responsive">
                        <table id="services_table" class=" table align-services-center table-flush">
                            <thead class="thead-light">
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

                        {{-- Confirm --}}
                        <div class="text-right col-md-12 col-auto">
                            <button type="button" id="save" class="btn btn-success text-right">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('items.partials.itemsModal')
    @include('invoices.partials.dentalServicesModal')
    @include('layouts.footers.auth')
</div>
@endsection
@push('js')
<script>
    function handler(e) {
        var date = document.getElementById("input-date").value;
        document.getElementById("input-date_service").value = date;
        document.getElementById("input-date_service-to").value = date;
        /* getExchangeRate(date); */
    }

    function service_handler(e) {
        var date = document.getElementById("input-date_service").value;
        document.getElementById("input-date_service-to").value = date;
    }

    function getExchangeRate(date) {
        $.ajax({
            url: "{{route('rate.find')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "date": date,
            },
            success: function (response) {
                if (response.value == -1) {
                    var fecha = dateToMXFormat(document.getElementById("input-date").valueAsDate);
                    getNewExchangeRate(fecha, date);
                } else {
                    document.getElementById("invoice-exchange_rate").value = response.value;
                }

            }
        });
        return false;
    }

    function getNewExchangeRate(date, dateUS) {
        $.ajax({
            url: "https://sidofqa.segob.gob.mx/dof/sidof/indicadores/" + date,
            dataType: 'json',
            type: "get",
            success: function (response) {
                if (response.ListaIndicadores.length > 1) {
                    const value = response.ListaIndicadores[0].valor;
                    document.getElementById("invoice-exchange_rate").value = value;
                    addNewExchangeRate(dateUS, value, date);
                }

            }
        });
        return false;
    }

    function addNewExchangeRate(date, value, fecha) {
        $.ajax({
            url: "{{route('rate.add')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "date": date,
                "value": value
            },
            success: function (response) {
                alert("Tipo de cambio agregado: " + fecha + " : " + value);
            }
        });
        return false;
    }
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function getCorrectDate(date) {
        utcDate = new Date(date); //Date object a day behind
        return new Date(utcDate.getTime() + utcDate.getTimezoneOffset() * 60000)
    }

    function addDiagnosisList() {
        var diagnosis_id = Number(document.getElementById("diagnosis_id").value);
        findDiagnosis(diagnosis_id);

    }

    function displayDiagnosisList() {
        var output = "";
        for (var i in diagnosesList) {
            output += "<tr value=" + diagnosesList[i].diagnosis_id + ">" +
                "<td>  <input type='checkbox'  name='active'></td>" +
                "<td id=diagnosis" + diagnosesList[i].diagnosis_id + ">" + diagnosesList[i].diagnosis_code + "</td>" +
                "<td>" + diagnosesList[i].name + "</td>" +
                "<td><button onclick='removeDiagnosis(" + diagnosesList[i].diagnosis_id +
                ")' class='delete-item btn btn-sm btn-danger' id=" + diagnosesList[i].diagnosis_id +
                ">X</button></td>" +
                "</tr>";
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
        constructor(diagnosis_id, diagnosis_code, name, nombre) {
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
        oral_cavity = "";
        tooth_system = "";
        tooth_numbers = "";
        tooth_surfaces = "";
        missing = false;
        constructor(service_id, description, price, discounted_price, quantity, id,
            DOS, DOS_to, descripcion, code, pointers) {
            this.service_id = service_id;
            this.description = description;
            this.base_price = Number(price);
            this.base_discounted_price = Number(discounted_price);
            this.price = this.base_price;
            this.discounted_price = this.base_discounted_price;
            this.quantity = Number(quantity);
            this.total_price = Number(quantity * price);
            this.total_discounted_price = Number(quantity * discounted_price);
            this.id = id;
            this.descripcion = descripcion;
            this.code = code;
            this.date2 = getCorrectDate(DOS);
            this.DOS = this.date2.toISOString().split('T')[0] + ' ' + this.date2.toTimeString().split(' ')[0];
            this.date3 = getCorrectDate(DOS_to);
            this.DOS_to = this.date3.toISOString().split('T')[0] + ' ' + this.date3.toTimeString().split(' ')[0];
            this.diagnoses_pointers = pointers;
        }

        clearDentalDetails(){
            this.oral_cavity = "";
            this.tooth_system = "";
            this.tooth_numbers = "";
            this.tooth_surfaces = "";
            this.missing = false;
        }

        get date() {
            return this.date2.toLocaleDateString();
        }

        totalDiscountedPrice() {
            return "$" + this.total_discounted_price.toFixed(4);
        }
        discountedPrice() {
            return "$" + this.discounted_price.toFixed(4);
        }

        // Add to cart
        addItemToCart(item_id, description, price, discounted_price, quantity,
            id, taxable, descripcion, code, date) {
            for (var item in this.items) {
                if (this.items[item].item_id === item_id && this.items[item].date === date) {
                    this.items[item].quantity += Number(quantity);
                    displayItems(this);
                    return;
                }
            }

            var item = new Item(item_id, description, price, discounted_price, quantity,
                id, taxable, descripcion, code, date);
            this.items.push(item);
            displayItems(this);
        }

        // Remove item from cart
        removeItemFromCart(id) {
            for (var item in this.items) {
                if (this.items[item].service_id === service_id) {
                    this.items[item].quantity--;
                    if (this.items[item].quantity === 0) {
                        this.items.splice(item, 1);
                    }
                    break;
                }
            };
        }

        removeItemFromCartAll(id) {
            for (var item in this.items) {
                if (this.items[item].id === id) {
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

            for (var item in this.items) {
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
        date = new Date();
        constructor(item_id, description, price, discounted_price, quantity, id,
            taxable, descripcion, code, date) {
            this.item_id = item_id;
            this.description = description;
            this.price = parseFloat(price.replace(/,/g, ''));
            this.discounted_price = parseFloat(discounted_price.replace(/,/g, ''));
            this.quantity = Number(quantity);
            this.sub_total_price = Number(quantity * price);
            this.sub_total_discounted_price = Number(quantity * discounted_price);
            this.id = id;
            this.taxable = taxable;
            this.descripcion = descripcion;
            this.code = code;
            this.date2 = getCorrectDate(date);
            this.date = this.date2.toISOString().split('T')[0] + ' ' + this.date2.toTimeString().split(' ')[0];
            this.calcTotals();
        }

        calcTotals() {
            this.sub_total_price = this.quantity * this.price;
            this.sub_total_discounted_price = this.quantity * this.discounted_price;
            if (this.taxable) {
                this.itax = this.sub_total_price * TAX;
                this.idtax = this.sub_total_discounted_price * TAX;
            }
            this.total_price = this.sub_total_price + this.itax;
            this.total_discounted_price = Number(this.sub_total_discounted_price + this.idtax);
        }
        totalDiscountedPrice() {
            return "$" + this.total_discounted_price.toFixed(4);
        }
        basePrice() {
            return "$" + this.price.toFixed(4);
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
    dental = 0;
    enclosures = 0;
    orthodontics = 0;
    license = "";
    tooth_numbers = "";
    auto_accident_state = "";
    treatment_resulting_from = "";
    months_remaining = "";
    prosthesis_replacement = 0;

    function changeOrthodonticsStatus(status){
        var orthoDetails = document.getElementById("orthodontics-details");
        if(status){
            orthoDetails.style.display = 'block';

        }
        else {
            orthoDetails.style.display = 'none';
        }
    }

    function changeDentalStatusConfirmation(status){
        var r = confirm("¿Desea continuar?");
        if (r == true) {
            changeDentalStatus(status);
        }
    }
    function changeDentalStatus(status){
        var dentalSection = document.getElementById("dental-details");
        if(status){
            dental = 1;

            //alert("Se ha cambiado a dental.");
        }else {
            //alert("No dental");
            dental = 0;


        }
        showDentalSection(status);
        displayCart();
    }

    function showDentalSection(show){
        var dentalSection = document.getElementById("dental-details");
        var dentalCheckbox = document.getElementById("dental");
        dentalCheckbox.checked = show;
        if(show){
            dentalSection.style.display = 'block';

        }
        else {
            dentalSection.style.display = 'none';
        }
    }

    function showDentalServiceModal(id) {
        selectedServiceId = id;
        //Find service in array
        const service = services.find(s => s.id == id);

        displayDentalDetails(service);
        $('#modal-dental-service').modal('show')

    }

    function updateDentalServiceDetails() {
        //Find service in array
        const service = services.find(s => s.id == selectedServiceId);
        service.oral_cavity = document.getElementById("modal-dental-service-oral-cavity").value;
        service.tooth_system = document.getElementById("modal-dental-service-tooth-system").value;
        service.tooth_surfaces = document.getElementById("modal-dental-service-tooth-surfaces").value;
        service.tooth_numbers = document.getElementById("modal-dental-service-tooth-numbers").value;
        service.missing = document.getElementById("modal-dental-service-tooth-missing").checked;
    }

    function displayDentalDetails(service) {
        document.getElementById("modal-dental-service-description").innerHTML = service.description;

        document.getElementById("modal-dental-service-oral-cavity").value = service.oral_cavity;
        document.getElementById("modal-dental-service-tooth-system").value = service.tooth_system;
        document.getElementById("modal-dental-service-tooth-surfaces").value = service.tooth_surfaces;
        document.getElementById("modal-dental-service-tooth-numbers").value = service.tooth_numbers;
        document.getElementById("modal-dental-service-tooth-missing").checked = service.missing;
    }

    function addDiagnosis(diagnosis_id, diagnosis_code, name, nombre) {
        for (var d in this.diagnosesList) {
            if (this.diagnosesList[d].diagnosis_id === diagnosis_id) {
                return;
            }
        }
        var diagnosis = new Diagnosis(diagnosis_id, diagnosis_code, name, nombre);
        this.diagnosesList.push(diagnosis);
        displayDiagnosisList();
    }

    function removeDiagnosis(id) {
        for (var diagnosis in this.diagnosesList) {
            if (this.diagnosesList[diagnosis].diagnosis_id === id) {
                this.diagnosesList.splice(diagnosis, 1);
                break;
            }
        };
        displayDiagnosisList();
    }

    // Total cart
    function totalCart() {
        this.tax = 0;
        this.dtax = 0;
        this.sub_total = 0;
        this.sub_total_discounted = 0;
        this.total = 0;
        this.total_with_discounts = 0;
        for (var service in this.services) {
            this.services[service].totalItemsCart();

            this.tax += this.services[service].tax;
            this.dtax += this.services[service].dtax;
            this.sub_total += this.services[service].sub_total;
            this.sub_total_discounted += this.services[service].sub_total_discounted;
            this.total += this.services[service].total_price;
            this.total_with_discounts += this.services[service].total_discounted_price;
        }
    }

    function addServiceToCart(service_id, description, price, discounted_price,
        quantity, id, descripcion, code, pointers) {
        for (var service in this.services) {
            if (this.services[service].id === id) {
                this.services[service].quantity += Number(quantity);
                displayCart();
                return;
            }
        }

        var DOS = document.getElementById("input-date_service").value;
        var DOS_to = document.getElementById("input-date_service-to").value;
        var service = new Service(service_id, description, price, discounted_price,
            quantity, id, DOS, DOS_to, descripcion, code, pointers);
        this.services.push(service);
        displayCart();
    }

    function removeServiceFromCartAll(service_id) {
        for (var service in this.services) {
            if (this.services[service].id === service_id) {
                this.services.splice(service, 1);
                break;
            }
        }
        totalCart();
    }

    function addItemToService(service_id, item_id, description, price, discounted_price,
        tax, quantity, descripcion, code, date) {

        //Find service in array
        var service = this.services.find(s => s.id == service_id);

        service.addItemToCart(item_id, description, price,
            discounted_price, quantity, service.items.length, tax, descripcion, code, date);
    }

    function totalDiscounts() {
        return Number(this.total_with_discounts);
    }

    function findDiagnosis(diagnosis_id) {
        $.ajax({
            url: "{{route('diagnoses.find')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "diagnosis_id": diagnosis_id
            },
            success: function (response) {
                addDiagnosis(diagnosis_id, response.code, response.name, response.nombre);
            }
        });
        return false;
    }



    function getService(id, quantity, price, discounted_price, pointers) {
        $.ajax({
            url: "{{route('services.find')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "service_id": id
            },
            success: function (response) {

                addServiceToCart(response.id, response.description,
                    price, discounted_price, quantity, services.length,
                    response.descripcion, response.code, pointers);
                displayCart();
            }
        });
        return false;
    }


    function getItem(service_id, item_id, quantity, price, discounted_price, tax, date, name, nombre) {
        $.ajax({
            url: "{{route('items.find')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "item_id": item_id
            },
            success: function (response) {
                var code = document.getElementById("custom-product-discounted-price").value;
                if (code.length <= 0) {
                    code = response.code;
                } else {
                    document.getElementById("custom-product-discounted-price").value = "";
                    document.getElementById("custom-product-price").value = 0;
                    document.getElementById("custom-product-name").value = "";
                    document.getElementById("custom-product-nombre").value = "";
                    document.getElementById("custom-product-discounted-price").value = "";
                }
                addItemToService(service_id, response.id, name,
                    price, discounted_price, tax, quantity,
                    nombre, response.code, date);
            }
        });
        return false;
    }


    function sendInvoice(patient_id, series, number, concept, code, currency,
        date, comments, isHospitalization) {
        var exchange_rate = document.getElementById("invoice-exchange_rate").value;
        exchange_rate = parseFloat(exchange_rate.replace(/,/g, ''));
        var doctor = document.getElementById("input-doctor").value;
        var DOS = document.getElementById("input-date_service-to").value;
        var isCash = document.getElementById("input-cash").checked ? 1 : 0;
        var isAccepted = document.getElementById("input-accept_assignment").checked ? 1 : 0;
        var appliance_placed = document.getElementById("input-placed").value;
        var prior_placement = document.getElementById("input-prior-placement").value;
        var accident_date = document.getElementById("input-accident").value;

        if(dental) {
            enclosures = document.getElementById("input-enclosures").checked ? 1 : 0;
            orthodontics = document.getElementById("input-orthodontics").checked ? 1 : 0;
            license = document.getElementById("input-license").value;
            tooth_numbers = document.getElementById("input-tooth-numbers").value;
            auto_accident_state = document.getElementById("input-accident-state").value;
            treatment_resulting_from = document.getElementById("input-treatment").value;
            months_remaining = document.getElementById("input-months").value;
            prosthesis_replacement = document.getElementById("input-prosthesis").checked ? 1 : 0;
        }


        $.ajax({
            url: "{{route('invoices.store')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "patient_id": patient_id,
                "date": date,
                "comments": comments,
                "number": number,
                "series": series,
                "concept": concept,
                "code": code,
                "currency": currency,
                "diagnoses": this.diagnosesList,
                "services": this.services,
                "total": total,
                "sub_total": sub_total,
                "sub_total_discounted": sub_total_discounted,
                "total_with_discounts": total_with_discounts,
                "tax": tax,
                "dtax": dtax,
                "amount_due": total_with_discounts,
                "amount_paid": 0,
                "exchange_rate": exchange_rate,
                "doctor": doctor,
                "DOS": DOS,
                "hospitalization": isHospitalization,
                "registered": (number == "Pendiente") ? 0 : 1,
                "cash": isCash,
                "dental": dental,
                "accept_assignment": isAccepted,
                "appliance_placed": appliance_placed,
                "prior_placement": prior_placement,
                "accident": accident_date,
                "enclosures": enclosures,
                "orthodontics": orthodontics,
                "license": this.license,
                "auto_accident_state": auto_accident_state,
                "treatment_resulting_from": treatment_resulting_from,
                "months_remaining": months_remaining,
                "prosthesis_replacement": prosthesis_replacement
            },
            success: function (response) {
                setTimeout(function () {
                    window.location.href = response;
                }, 1000);
            }
        });
        return false;
    }

    var selectedServiceId;

    function showProductsModal(id) {
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
        if (service.items_total_discounted_price > service.total_discounted_price) {
            document.getElementById("modal-items-discounted_total").className = "text-danger";
            document.getElementById("save").disabled = true;
        } else if (service.items_total_discounted_price < service.total_discounted_price) {
            document.getElementById("modal-items-discounted_total").className = "text-yellow";
        } else {
            document.getElementById("modal-items-discounted_total").className = "text-success";
        }
        document.getElementById("modal-items-discounted_total").innerHTML = service.items_total_discounted_price;
        document.getElementById("input-date_item").value = service.date2.toISOString().split('T')[0];
        for (var i in service.items) {
            output += "<tr value=" + service.items[i].id + ">" +
                "<td>" + service.items[i].date2.toISOString().split('T')[0] + "</td>" +
                "<td>" + service.items[i].descripcion + "</td>" +
                "<td>" + service.items[i].basePrice() + "</td>" +
                "<td>" + service.items[i].quantity + "</td>" +
                "<td>" + service.items[i].totalDiscountedPrice() + "</td>" +
                "<td><button class='delete-item btn btn-sm btn-danger' data-service=" + service.id + "data-id=" +
                service.items[i].id + ">X</button></td>" +
                "</tr>";
        }
        $('#items_table tbody').html(output);
    }

    function searchNumber() {
        var number = document.getElementById("input-number").value;
        if (number.length > 0) {
            getInvoiceData(number, 0);
        }
    }

    function searchClaim() {
        var claim = document.getElementById("input-code").value;
        if (claim.length > 0) {
            getInvoiceData(claim, 1);
            document.getElementById("input-code").value = "";
        }
    }

    function getInvoiceData(number, claim) {
        $.ajax({
            url: "{{route('invoices.searchNumber')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "number": number,
                "claim": claim
            },
            success: function (response) {
                document.getElementById("patient-name").innerHTML = response.data.patient.full_name + " " +
                    response.data.patient.birth_date;
                document.getElementById("input-date").value = response.data.date;
                document.getElementById("input-date_service").value = response.data.date;
                document.getElementById("input-date_service-to").value = response.data.date;
                document.getElementById("input-patient_id").value = response.data.patient.id;
                document.getElementById("input-doctor").value = response.data.doctor;
                document.getElementById("invoice-exchange_rate").value = response.data.exchange_rate;
                diagnosesList = [];
                for (var i = 0; i < response.data.diagnoses.length; i++) {
                    addDiagnosisFromInvoice(response.data.diagnoses[i].diagnosis_id, response.data
                        .diagnoses[i].diagnosis_name,
                        response.data.diagnoses[i].diagnosis_code, response.data.diagnoses[i]
                        .diagnosis_nombre);
                }
                displayDiagnosisList();

            }
        });
        return false;
    }

    function addDiagnosisFromInvoice(diagnosis_id, name, code, nombre) {

        var diagnosis = new Diagnosis(diagnosis_id, code, name, nombre);
        this.diagnosesList.push(diagnosis);
    }


    function displayCart() {
        totalCart();
        var output = "";
        var optionalRow = "";

        for (var i in this.services) {
            if(this.dental){
                optionalRow = '<td><button class="btn btn-icon btn-outline-primary btn-sm"  type="button" onClick="showDentalServiceModal(' + this.services[i].id +')"><span class="btn-inner--icon"><i class="fas fa-tooth"></i></span></button>';
            } else {
                optionalRow = "<td>" + this.services[i].items.length + '</td>';
            }

            output += "<tr value=" + this.services[i].id + ">" +
                "<td><button class='delete-service btn btn-sm btn-danger' data-id=" + this.services[i].id +
                ">X</button></td>" +
                "<td>" + this.services[i].date + "</td>" +
                "<td>" + this.services[i].description + "</td>" +
                "<td>" + this.services[i].diagnoses_pointers + "</td>" +
                "<td>" + this.services[i].discountedPrice() + "</td>" +
                "<td>" + this.services[i].quantity + "</td>" +
                "<td>" + this.services[i].totalDiscountedPrice() + '</td>' +
                optionalRow +
                '<td><button class="btn btn-icon btn-outline-success btn-sm"  type="button" onClick="showProductsModal(\'' +
                this.services[i].id + '\')"><span class="btn-inner--icon"><i class="ni ni-atom"></i></span></button>' +
                '</td> </tr>';
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

    function dateToMXFormat(date) {
        date = getCorrectDate(date);
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0');
        var yyyy = date.getFullYear();
        return dd + '-' + mm + '-' + yyyy;
    }

    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;

    getExchangeRate(today);
    showDentalSection(dental);
    changeOrthodonticsStatus(0);
    $(document).ready(function () {
        document.getElementById("input-date").value = today;
        document.getElementById("input-date_service").value = today;
        document.getElementById("input-date_service-to").value = today;
        document.getElementById("input-placed").value = today;
        document.getElementById("input-prior-placement").value = today;
        document.getElementById("input-accident").value = today;

        $("#add_service").click(function () {


            var quantity = Number(document.getElementById("input-quantity").value);
            var service_id = $("#service_id").children("option:selected").val();
            var pointers = "";
            var i = 0;
            $("#diagnoses_table tbody").find('input[name="active"]').each(function () {
                if ($(this).is(":checked")) {
                    i++;
                    pointers += i + ",";

                }


            });
            pointers = pointers.substring(0, pointers.length - 1);

            if (quantity > 0 && service_id > 0 && pointers.length > 0) {

                var price = document.getElementById("custom-price").value;
                price = parseFloat(price.replace(/,/g, ''));
                var discounted_price = price;
                /*document.getElementById("custom-discounted-price").value;
                               discounted_price = parseFloat(discounted_price.replace(/,/g,''));*/

                getService(service_id, quantity, price, discounted_price, pointers);
            }

        });



        $("#add_item").click(function () {
            var quantity = Number(document.getElementById("input-product-quantity").value);
            var name = document.getElementById("custom-product-name").value;
            var nombre = document.getElementById("custom-product-nombre").value;
            if (quantity > 0) {
                var price = document.getElementById("custom-product-price").value;
                var discounted_price = document.getElementById("custom-product-discounted-price").value;
                var item_id = $("#item_id").children("option:selected").val();
                var tax = document.getElementById("custom-product-tax").checked;
                var date = document.getElementById("input-date_item").value;
                getItem(selectedServiceId, item_id, quantity, price, discounted_price, tax, date, name,
                    nombre);
            }

        });

        // Delete item button
        $('#items_table').on("click", ".delete-item", function (event) {
            var id = $(this).data('id');
            var service_id = $(this).data('service');
            //Find service in array
            var service = services.find(s => s.id == service_id);

            service.removeItemFromCartAll(id);


        })

        // Delete service button
        $('#services_table').on("click", ".delete-service", function (event) {
            var service_id = $(this).data('id');
            removeServiceFromCartAll(service_id);
            displayCart();


        })



        $("#save").click(function () {
            var code = document.getElementById("input-code").value;
            var accepted = true;
            if (code.length == 0) {
                var message = "";
                if (document.getElementById("input-cash").checked) {
                    message = "Se utilizará contador de CASH."
                }
                accepted = confirm("Código de cobro está vacío, ¿desea continuar? " + message);
            }

            if (accepted) {
                var patient_id = document.getElementById("input-patient_id").value;
                if (patient_id < 1) {
                    patient_id = $("#patient_id").children("option:selected").val();
                }
                if (services.length > 0 && patient_id > 0) {
                    var date = document.getElementById("input-date").value;
                    getExchangeRate(date);

                    var comments = document.getElementById("input-comments").value;
                    var number = document.getElementById("input-number").value;
                    var series = document.getElementById("input-series").value;
                    var concept = document.getElementById("input-concept").value;
                    var currency = document.getElementById("input-currency").value;
                    var isHospitalization = document.getElementById("input-hospitalization").checked;
                    if (isHospitalization) {
                        isHospitalization = 1;
                    } else {
                        isHospitalization = 0;
                    }

                    if(dental && document.getElementById("input-license").value == "") {
                        alert("Debe ingresar la licencia del dentista.");
                        return;
                    }
                    sendInvoice(patient_id, series, number, concept, code, currency,
                    date, comments, isHospitalization);


                } else {
                    alert("Falta agregar servicios a la factura.");
                }
            }
        });
    });

</script>

@endpush
