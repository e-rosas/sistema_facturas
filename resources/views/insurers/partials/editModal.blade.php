<div class="modal fade bd-example-modal-lg" id="modal-edit-insurer" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">Información de Aseguranza</h5>
                        <input type="hidden" class="form-control" id="update-insurer_id" readonly>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{--  name de aseguranza  --}}
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-name">Nombre</label>
                            <input type="text" name="name" id="update-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                        </div>
                        {{--  code de aseguranza  --}}
                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-code">Clave</label>
                            <input type="text" name="code" id="update-code" 
                                class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                placeholder="Clave" value="{{ old('code') }}" required >

                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  address  --}}
                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-address">Dirección</label>
                            <input type="text" name="address" id="update-address" 
                                class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                                placeholder="Dirección" value="{{ old('address') }}" >

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  city  --}}
                        <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-city">Ciudad</label>
                            <input type="text" name="city" id="update-city" 
                                class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                placeholder="Ciudad" value="{{ old('city') }}" >
                        
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  state  --}}
                        <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-state">Estado</label>
                            <input type="text" name="state" id="update-state" 
                                class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" 
                                placeholder="Estado" value="{{ old('state') }}" >
                        
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  Codigo Postal  --}}
                        <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-postal_code">Código Postal</label>
                            <input type="text" name="postal_code" id="update-postal_code" 
                                class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" 
                                placeholder="Código Postal" value="{{ old('postal_code') }}" >
                        
                            @if ($errors->has('postal_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('postal_code') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  phone_number  --}}
                        <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-phone_number">Teléfono</label>
                            <input type="text" name="phone_number" id="update-phone_number" 
                                class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                                placeholder="Teléfono" value="{{ old('phone_number') }}" >
                        
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  Correo  --}}
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="update-email">Correo</label>
                            <input type="email" name="email" id="update-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            placeholder="Correo" value="{{ old('email') }}" >
                        
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button id="update-insurer" class="btn btn-success mt-4">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    function showEditModal(id){
        getInsurerData(id); 
        $('#modal-edit-insurer').modal('show');
    }
    function getInsurerData(id){
        $.ajax({
            url: "{{route('insurers.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "insurer_id" : id
            },
        success: function (data) {                
                displayInsurer(data.id, data.name, data.code, data.email,
                data.phone_number, data.address, data.city, data.state,
                data.postal_code);                                
            }
        });
            return false;
    }

    function displayInsurer(insurer_id, name, code, email, 
        phone_number, address, city, state, postal_code){
            document.getElementById("update-insurer_id").value = insurer_id;
            document.getElementById("update-name").value = name;
            document.getElementById("update-code").value = code;
            document.getElementById("update-email").value = email;
            document.getElementById("update-phone_number").value = phone_number;
            document.getElementById("update-address").value = address;
            document.getElementById("update-city").value = city;
            document.getElementById("update-state").value = state;
            document.getElementById("update-postal_code").value = postal_code;
            
    }
    function updateInsurer(insurer_id, name, code, email, 
    phone_number, address, city, state, postal_code){
        $.ajax({
            url: "{{route('insurers.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "insurer_id": insurer_id,
                "name": name,
                "code": code,
                "email": email,
                "phone_number": phone_number,
                "address": address,
                "city": city,
                "state": state,
                "postal_code": postal_code,
            },
        success: function () {                   
            }
        });
            return false;
    }
    
    $(document).ready(function(){
        $("#update-insurer").click(function(){

              var insurer_id = Number(document.getElementById("update-insurer_id").value);
              var name = document.getElementById("update-name").value;
              var code = document.getElementById("update-code").value;
              var address = document.getElementById("update-address").value;
              var email = document.getElementById("update-email").value;
              var phone_number = document.getElementById("update-phone_number").value;
              var city = document.getElementById("update-city").value;
              var state = document.getElementById("update-state").value;
              var postal_code = document.getElementById("update-postal_code").value;

              updateInsurer(insurer_id, name, code, email, phone_number, address, city, state, postal_code);
              $('#modal-edit-insurer').modal('hide');
          }); 
    });
</script>
@endpush