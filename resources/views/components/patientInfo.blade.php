<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card">
                    <h2>Paciente</h2>
                    <span> {{ $patient->insurance_id }} </span>
                </div>
            </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-center">
                <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-info mr-4">Ver</a>      
            </div>
        </div>
        <div class="card-body pt-0 pt-md-4">    
            <div class="text-center">
                <h3>
                    {{ $patient->full_name }}<span class="font-weight-light"></span>
                </h3>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->birth_date->format('d-m-Y') }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $patient->address }} </span>
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

   

