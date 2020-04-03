<form role="form" method="post" action="{{ route('patient.update') }}"  autocomplete="off">
    @csrf 
    @method('patch')
    {{--  patient --}}
    <input type="hidden"  readonly  name="patient_id" id="input-patient_id" class="form-control"
    value="" required>
    {{--  Names  --}}
    <div class="row">
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-last_name">{{ __('Last name') }}</label>
            <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative" placeholder="{{ __('Last name') }}" value="" required autofocus>
        </div>
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-maiden_name">{{ __('Middle name') }}</label>
            <input type="text" name="maiden_name" id="input-maiden_name" class="form-control form-control-alternative" placeholder="{{ __('Middle name') }}" value="" autofocus>
        </div>
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
            <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="" required autofocus>

        </div>
    </div>
    {{--  Birth and address  --}}
    <div class="row">
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-birth_date">{{ __('Birth date') }}</label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input name="birth_date" id="input-birth_date" class="form-control form-control-alternative"  type="date" value=""required>
            </div>
        </div>
        <div class="form-group col-md-8 col-auto">
            <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
            <input type="text" name="address" id="input-address" class="form-control form-control-alternative" placeholder="{{ __('Address') }}" value="" required>
        </div>
    </div>
    {{--  City, state, postal code  --}}
    <div class="row">
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-city">{{ __('City') }}</label>
            <input type="text" name="city" id="input-city" class="form-control form-control-alternative" placeholder="{{ __('City') }}" value="" >

        </div>
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-state">{{ __('State') }}</label>
            <input type="text" name="state" id="input-state" class="form-control form-control-alternative" placeholder="{{ __('State') }}" value="" >
        </div>
        <div class="form-group col-md-4 col-auto">
            <label class="form-control-label" for="input-postal_code">{{ __('Postal code') }}</label>
            <input type="text" name="postal_code" id="input-postal_code" class="form-control form-control-alternative" placeholder="{{ __('Postal code') }}" value="" required>
        
        </div>
    </div>
    {{--  phone_number, email, insured  --}}
    <div class="row">
        <div class="form-group col-md-6 col-auto">
            <label class="form-control-label" for="input-phone_number">{{ __('Phone number') }}</label>
            <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative" placeholder="{{ __('Phone number') }}" value="">

        </div>
        <div class="form-group col-md-6 col-auto">
            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
            <input type="text" name="email" id="input-email" class="form-control form-control-alternative" placeholder="{{ __('Optional email') }}" value="">

        </div>
    </div> 
    <div class="text-center">
        <button id="update_person" type="submit" class="btn btn-block  btn-success mt-4">{{ __('Save') }}</button>
    </div>
</form>
@push('js')
<script>
    function updatePatient(id, name, birth_date, address, city, state, 
    postal_code, phone_number, email){
        $.ajax({
            url: "{{route('patient.update')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "patient_id" : id
            },
        success: function (response) {                
                                               
            }
        });
            return false;
    }
    
    function Patient(id, name, birth_date, address, city, state, 
    postal_code, phone_number, email){
        document.getElementById("input-patient_id").value = id;
        document.getElementById("input-name").value = name;
        document.getElementById("input-birth_date").value = birth_date;
        document.getElementById("input-address").value = address;
        document.getElementById("input-city").value = city;
        document.getElementById("input-state").value = state;
        document.getElementById("input-postal_code").value = postal_code;
        document.getElementById("input-phone_number").value = phone_number;
        document.getElementById("input-email").value = email;
    }

</script>
@endpush