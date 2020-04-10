       
            <h6 class="heading-small text-muted mb-4">Información</h6>
            <div class="pl-lg-4">
                {{--  Names  --}}
                <div class="row">
                    <div class="col-lg-12 form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-full_name">Nombre</label>
                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="Nombre" value="{{ old('full_name') }}" required autofocus>

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
                            <input name="birth_date" id="input-birth_date" class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"  type="date" required>
                        </div>
                        @if ($errors->has('birth_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} col-md-8 col-auto">
                        <label class="form-control-label" for="input-address">Dirección</label>
                        <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Dirección" value="{{ old('address') }}" required>
                    
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
                        <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="Ciudad" value="{{ old('city') }}" required>
                    
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-state">Estado</label>
                        <input type="text" name="state" id="input-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="Estado" value="{{ old('state') }}" required>
                    
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-postal_code">Código Postal</label>
                        <input type="text" name="postal_code" id="input-postal_code" class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" placeholder="Código Postal" value="{{ old('postal_code') }}" required>
                    
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
                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="Teléfono" value="{{ old('phone_number') }}">
                    
                        @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-6 col-auto">
                        <label class="form-control-label" for="input-email">Correo</label>
                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo" value="{{ old('email') }}">
    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>    
            </div>

   

