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
                                    <div class="col-lg-6 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="update-name">Nombre</label>
                                        <input type="text" name="name" id="update-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                        placeholder="Nombre" value="{{ $patient->name }}" required autofocus>
                
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="update-last_name">Apellidos</label>
                                        <input type="text" name="last_name" id="update-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                         placeholder="Nombre" value="{{ $patient->last_name  }}" required autofocus>
                
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Birth and address  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="update-birth_date">Fecha de nacimiento</label>
                                        <div class="update-group update-group-alternative">
                                            <div class="update-group-prepend">
                                                <span  class="update-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="birth_date" id="update-birth_date" 
                                                class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" 
                                                 type="date" value="{{ $patient->birth_date->format('Y-m-d') }}" required>
                                        </div>
                                        @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('street_number') ? ' has-danger' : '' }} col-md-2 col-auto">
                                        <label class="form-control-label" for="update-street_number">Num.de Calle</label>
                                        <input type="text" name="street_number" id="update-street_number" class="form-control form-control-alternative{{ $errors->has('street_number') ? ' is-invalid' : '' }}" 
                                            placeholder="Num.de calle" value="{{ $patient->street_number }}" required>
                                    
                                        @if ($errors->has('street_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="update-street">Calle</label>
                                        <input type="text" name="street" id="update-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" 
                                            placeholder="Calle" value="{{ $patient->street }}" required>
                                    
                                        @if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  City, state, postal code  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="update-city">Ciudad</label>
                                        <input type="text" name="city" id="update-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                            placeholder="Ciudad" value="{{ $patient->city }}" required>
                                    
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="update-state">Estado</label>
                                        <input type="text" name="state" id="update-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                             placeholder="Estado" value="{{ $patient->state }}" required>
                                    
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('zip_code') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="update-zip_code">Código Postal</label>
                                        <input type="text" name="zip_code" id="update-zip_code" class="form-control form-control-alternative{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                         placeholder="Código Postal" value="{{ $patient->zip_code }}">
                                    
                                        @if ($errors->has('zip_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="update-gender">Género</label>
                                        <select id='update-gender' class="custom-select" name="gender"> 
                                            <option value='0' {{ $patient->gender == 0 ? 'selected' : '' }}>Masculino</option>
                                            <option value='1' {{ $patient->gender == 1 ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="update-status">Estado civil</label>
                                        <select id='update-status' class="custom-select" name="status"> 
                                            <option value='2' {{ $patient->status == 2 ? 'selected' : '' }}>Soltero</option>
                                            <option value='1' {{ $patient->status == 1 ? 'selected' : '' }}>Casado</option>
                                            <option value='0' {{ $patient->status == 0 ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="update-occupation">Ocupación</label>
                                        <select id='update-occupation' class="custom-select" name="occupation"> 
                                            <option value='1' {{ $patient->occupation == 1 ? 'selected' : '' }}>Empleado</option>
                                            <option value='2' {{ $patient->occupation == 2 ? 'selected' : '' }}>Estudiante</option>
                                            <option value='3' {{ $patient->occupation == 3 ? 'selected' : '' }}>Estudiante tiempo parcial</option>
                                            <option value='0' {{ $patient->occupation == 0 ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                </div>
                                {{--  phone_number, email, insured  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-5 col-auto">
                                        <label class="form-control-label" for="update-phone_number">Teléfono</label>
                                        <input type="text" name="phone_number" id="update-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                                        placeholder="Teléfono" value="{{ $patient->phone_number }}">
                                    
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-5 col-auto">
                                        <label class="form-control-label" for="update-email">Correo</label>
                                        <input type="text" name="email" id="update-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        placeholder="Correo" value="{{ $patient->email }}">
                    
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  deductible  --}}
                                    <div class="col-md-2 col-auto form-group{{ $errors->has('deductible') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="update-deductible">Deducible</label>
                                        <input type="number" name="deductible" id="update-deductible" class="form-control form-control-alternative{{ $errors->has('deductible') ? ' is-invalid' : '' }}" 
                                        placeholder="0" value="{{ $patient->deductible }}">
                                
                                        @if ($errors->has('deductible'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deductible') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>    
                            </div>
                            @if ($patient->insured)
                                <div class="form-row">
                                    <div class="form-group col-md-5 col-auto">
                                        <label for="insurer_id" class="col-auto col-form-label">Aseguranza</label>
                                        <select class="custom-select form-control{{ $errors->has('insurer_id') ? ' is-invalid' : '' }}" name="insurer_id">
                                            @foreach($insurers as $insurer)
                                                <option value="{{ $insurer->id }}" {{ $patient->insuree->insurer->id == $insurer->id ? 'selected' : '' }}>{{ $insurer->name }}</option>
                                            @endforeach
                                        </select>                  
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurer_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-auto">
                                        <label for="update-insurance_id" class="col-auto col-form-label">ID Aseguranza</label>
                                        <input type="text" name="insurance_id" id="update-insurance_id" class="form-control form-control-alternative{{ $errors->has('insurance_id') ? ' is-invalid' : '' }}" 
                                            placeholder="ID Aseguranza" value="{{ $patient->insuree->insurance_id }}" required>                 
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurance_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3 col-auto">
                                        <label for="update-nss" class="col-auto col-form-label">No. Seguro Social</label>
                                        <input type="text" name="nss" id="update-nss" 
                                            class="form-control form-control-alternative{{ $errors->has('nss') ? ' is-invalid' : '' }}" 
                                            placeholder="ID Aseguranza" value="{{ $patient->insuree->nss }}" required>                 
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nss') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="insuree_id" value=0>
                                    <input type="hidden" name="relationship" value=-1>
                                    {{-- <div class="form-group col-auto text-right">
                                        <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insurer') }}</a>
                                    </div> --}}
                                </div>
                            @else
                                <div class="form-row">
                                    <input type="hidden" name="insurer_id" value=0>
                                    <input type="hidden" name="insurance_id" value=0>
                                    <input type="hidden" name="insuree_id" value=0>
                                    {{-- <div class="col-lg-8 form-group">
                                        <label for="insuree_id" class="col-auto col-form-label">Asegurado</label>
                                        @include('components.searchInsurees')
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <label class="form-control-label" for="update-status">Relación</label>
                                        <select id='update-relationship' class="custom-select" name="relationship"> 
                                            <option value='2' {{ $patient->dependent->relationship == 2 ? 'selected' : '' }}>Esposo(a)</option>
                                            <option value='1' {{ $patient->dependent->relationship == 1 ? 'selected' : '' }}>Hijo(a)</option>
                                            <option value='0' {{ $patient->dependent->relationship == 0 ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            
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