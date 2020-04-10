@extends('layouts.app', ['title' => 'Aseguranzas'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Registrar aseguranza'])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 auto">
                                <h3 class="mb-0">{{ 'Aseguranzas' }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('insurers.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('insurers.store') }}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">Datos de aseguranza</h6>
                            <div class="pl-lg-4">
                                <div class="form-row">
                                    {{--  name de aseguranza  --}}
                                    <div class="col-md-8 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">Nombre</label>
                                        <input type="text" name="name" id="input-name" 
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                            placeholder="Nombre" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  code de aseguranza  --}}
                                    <div class=" col-md-4 form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">Clave</label>
                                        <input type="text" name="code" id="input-code" 
                                            class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                            placeholder="Clave" value="{{ old('code') }}" required autofocus>

                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{--  address  --}}
                                    <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-address">Dirección</label>
                                        <input type="text" name="address" id="input-address" 
                                            class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                                            placeholder="Dirección" value="{{ old('address') }}" autofocus>

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  city  --}}
                                    <div class="col-md-2 form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-city">Ciudad</label>
                                        <input type="text" name="city" id="input-city" 
                                            class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                            placeholder="Ciudad" value="{{ old('city') }}" autofocus>
                                    
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  state  --}}
                                    <div class="col-md-2 form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-state">Estado</label>
                                        <input type="text" name="state" id="input-state" 
                                            class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" 
                                            placeholder="Estado" value="{{ old('state') }}" autofocus>
                                    
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Codigo Postal  --}}
                                    <div class="col-md-2 form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-postal_code">Código Postal</label>
                                        <input type="text" name="postal_code" id="input-postal_code" 
                                            class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" 
                                            placeholder="Código Postal" value="{{ old('postal_code') }}" autofocus>
                                    
                                        @if ($errors->has('postal_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{--  phone_number  --}}
                                    <div class="col-md-5 form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-phone_number">Teléfono</label>
                                        <input type="text" name="phone_number" id="input-phone_number" 
                                            class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                                            placeholder="Teléfono" value="{{ old('phone_number') }}" autofocus>
                                    
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Correo  --}}
                                    <div class="col-md-7 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">Correo</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        placeholder="Correo" value="{{ old('email') }}" >
                                    
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block mt-4">Guardar</button>
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