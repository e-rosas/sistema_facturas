       
            <h6 class="heading-small text-muted mb-4">Información</h6>
            <div class="pl-lg-4">
                {{--  Names  --}}
                <div class="row">
                    <div class="col-lg-6 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">Nombre</label>
                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-6 form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-last_name">Apellidos</label>
                        <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" 
                        placeholder="Apellidos" value="{{ old('last_name') }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--  Birth and street  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-birth_date">Fecha de nacimiento</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="birth_date" id="input-birth_date" 
                                class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"  
                                type="date" required value="{{ old('birth_date') }}">
                        </div>
                        @if ($errors->has('birth_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('street_number') ? ' has-danger' : '' }} col-md-2 col-auto">
                        <label class="form-control-label" for="input-street_number">Num.de Calle</label>
                        <input type="text" name="street_number" id="input-street_number" class="form-control form-control-alternative{{ $errors->has('street_number') ? ' is-invalid' : '' }}" 
                            placeholder="Num.de Calle" value="{{ old('street_number') }}" required>
                    
                        @if ($errors->has('street_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('street_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-street">Calle</label>
                        <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" 
                            placeholder="Calle" value="{{ old('street') }}" required>
                    
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
                        <label class="form-control-label" for="input-city">Ciudad</label>
                        <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                            placeholder="Ciudad" value="{{ old('city') }}" required>
                    
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-state">Estado</label>
                        <input type="text" name="state" id="input-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" 
                            placeholder="Estado" value="{{ old('state') }}" required>
                    
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('zip_code') ? ' has-danger' : '' }} col-md-4 col-auto">
                        <label class="form-control-label" for="input-zip_code">Código Postal</label>
                        <input type="text" name="zip_code" id="input-zip_code" class="form-control form-control-alternative{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" 
                            placeholder="Código Postal" value="{{ old('zip_code') }}">
                    
                        @if ($errors->has('zip_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-control-label" for="input-gender">Género</label>
                        <select id='input-gender' class="custom-select" name="gender"> 
                            <option value='0'>Masculino</option>
                            <option value='1'>Femenino</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="input-status">Estado civil</label>
                        <select id='input-status' class="custom-select" name="status"> 
                            <option value='2'>Soltero</option>
                            <option value='1'>Casado</option>
                            <option value='0'>Otro</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="input-occupation">Ocupación</label>
                        <select id='input-occupation' class="custom-select" name="occupation"> 
                            <option value='1'>Empleado</option>
                            <option value='2'>Estudiante</option>
                            <option value='3'>Estudiante tiempo parcial</option>
                            <option value='0'>Otro</option>
                        </select>
                    </div>
                </div>
                {{--  phone_number, email, insured  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-5 col-auto">
                        <label class="form-control-label" for="input-phone_number">Teléfono</label>
                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                            placeholder="Teléfono" value="{{ old('phone_number') }}">
                    
                        @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-5 col-auto">
                        <label class="form-control-label" for="input-email">Correo</label>
                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            placeholder="Correo" value="{{ old('email') }}">
    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{--  deductible  --}}
                    <div class="col-md-2 col-auto form-group{{ $errors->has('deductible') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-deductible">Deducible</label>
                        <input type="number" name="deductible" id="input-deductible" class="form-control form-control-alternative{{ $errors->has('deductible') ? ' is-invalid' : '' }}" 
                        placeholder="0" value="0">
                
                        @if ($errors->has('deductible'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deductible') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>    
            </div>

   

