@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Editar paciente'])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-insurers-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Editar Paciente</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="{{ route('patients.update', $patient) }}" autocomplete="off">
                            @csrf
                            @method('patch')
                                  
                            <h6 class="heading-small text-muted mb-4">Información</h6>
                            <div class="pl-lg-4">
                                {{--  Names  --}}
                                <div class="row">
                                    <div class="col-lg-12 form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-full_name">Nombre</label>
                                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" 
                                        placeholder="Nombre" value="{{ $patient->full_name }}" required autofocus>

                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Birth and address  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-birth_date">Fecha de nacimiento</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="birth_date" id="input-birth_date" 
                                                class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" 
                                                 type="date" value="{{ $patient->birth_date->format('Y-m-d') }}" required>
                                        </div>
                                        @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} col-md-8 col-auto">
                                        <label class="form-control-label" for="input-address">Dirección</label>
                                        <input type="text" name="address" id="input-address" 
                                            class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                                                placeholder="Dirección" value="{{ $patient->address }}" required>
                                    
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  City, state, postal code  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-city">Ciudad</label>
                                        <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                            placeholder="Ciudad" value="{{ $patient->city }}" required>
                                    
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-state">Estado</label>
                                        <input type="text" name="state" id="input-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                             placeholder="Estado" value="{{ $patient->state }}" required>
                                    
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-postal_code">Código Postal</label>
                                        <input type="text" name="postal_code" id="input-postal_code" class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}"
                                         placeholder="Código Postal" value="{{ $patient->postal_code }}" required>
                                    
                                        @if ($errors->has('postal_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  phone_number, email, insured  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-phone_number">Teléfono</label>
                                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                                        placeholder="Teléfono" value="{{ $patient->phone_number }}">
                                    
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-email">Correo</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        placeholder="Correo" value="{{ $patient->email }}">
                    
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>    
                            </div>

   


                        <div class="form-row">
                            {{--  deductible  --}}
                            <div class="col-md-4 col-auto form-group{{ $errors->has('deductible') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-deductible">Deducible</label>
                                <input type="numeric" name="deductible" id="input-deductible" class="form-control form-control-alternative{{ $errors->has('deductible') ? ' is-invalid' : '' }}" 
                                placeholder="0" value="{{ $patient->deductible }}">
                        
                                @if ($errors->has('deductible'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deductible') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-auto">
                                <label for="insurer_id" class="col-auto col-form-label">Aseguranza</label>
                                <select class="custom-select form-control{{ $errors->has('insurer_id') ? ' is-invalid' : '' }}" name="insurer_id">
                                @foreach($insurers as $insurer)
                                    <option value="{{ $insurer->id }}" {{ $patient->insurer->id == $insurer->id ? 'selected' : '' }}>{{ $insurer->name }}</option>
                                @endforeach
                                </select>                  
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-auto">
                                <label for="insurance_id" class="col-auto col-form-label">ID Aseguranza</label>
                                <input type="text" name="insurance_id" id="input-insurance_id" class="form-control form-control-alternative{{ $errors->has('insurance_id') ? ' is-invalid' : '' }}" 
                                    placeholder="ID Aseguranza" value="{{ $patient->insurance_id }}" required>                 
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurance_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- <div class="form-group col-auto text-right">
                                <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insurer') }}</a>
                            </div> --}}
                        </div>
                        <div class="pl-lg-4">
                            <button type="submit" class="btn btn-success mt-4 btn-block">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>                    
            </div>
        </div>
    </div>      
        @include('layouts.footers.auth')
    </div>
@endsection