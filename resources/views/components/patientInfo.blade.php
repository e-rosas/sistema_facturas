<div class="col-xl-6 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="card-header bg-primary border-0">
            <div class="row">
                <div class="col-8 col-auto">
                    <h3 style="color:white" class="card-title text-uppercase  mb-0">{{ $type ?? ''}}</h3>
                </div>
            </div>
        </div>
        {{--  <div class="form-row justify-content-center bg-primary">
            <div class="col-lg-12">
                <div class=" text-justify">
                    <h2 style="color:white" class="card-title text-uppercase mb-0">Paciente</h2>
                    
                </div>
            </div>
        </div>  --}}
        <div class="card-body pt-0 pt-md-4">    
            <div class="text-center">
                <h3>
                    {{ $patient->full_name }}
                    
                </h3>
                <div class="h4 font-weight-300">
                    <span> <a href="{{ route('patients.show', $patient) }}" class="mr-4">{{ $patient->insurance_id }} </a>  </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->birth_date->format('d-m-Y') }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->address() }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->addressDetails() }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->phone_number }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <a href="mailto:{{$patient->email}}">{{$patient->email}}</a>
                </div>
            </div>
        </div>
    </div>
</div>

   

