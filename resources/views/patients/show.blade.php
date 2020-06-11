@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
    @include('layouts.headers.header', ['title' => $patient->full_name])

    <div class="container-fluid mt--7">
        <div class="row">
            {{--  <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['id' => 'total','title' => 'Total', 'value' => $patient->person_stats->total()])
                @include('components.invoiceStatsCard', ['id' => 'amount-paid','title' =>  __('Pagado') , 'value' => $patient->person_stats->amountPaid()])
                @include('components.invoiceStatsCard', ['id' => 'amount-due','title' => __('Debe'), 'value' => $patient->person_stats->amountDue()])
               
            </div>  --}}
        </div>
        <div class="row mt-5">
            <div class="col-xl-9">
                @if (!$patient->insured)
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Asegurado') }}</h5>
                                    <span class="h2 font-weight-bold mb-0"> <a href="{{ route('patients.show', $insuree->patient) }}"> {{ $insuree->patient->full_name }} - {{ $insuree->nss }} </a></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                @endif
                <div class="card card-stats ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Aseguranza') }}</h5>
                                @if (!$patient->insured)
                                    <span class="h2 font-weight-bold mb-0"> <a href="{{ route('insurers.show', $insuree->insurer) }}"> {{ $insuree->insurer->name }}</a></span>
                                @else
                                    <span class="h2 font-weight-bold mb-0"> <a href="{{ route('insurers.show', $patient->insuree->insurer) }}"> {{ $patient->insuree->insurer->name }}</a></span>
                                @endif
                                
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
            <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>
                            {{ $patient->full_name }}<span class="font-weight-light"></span>
                        </h3>
                        <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.edit', $patient) }}">
                            <i class="fas fa-pencil-alt fa-2"></i>
                        </a> 
                        {{-- <form  method="post" action="{{ route('reports.invoices') }}" >
                            @csrf
                            <div class="form-group col-md-12 col-auto">
                                <input type="hidden" value=" {{ $patient->id }} " name="patient_id" id="input-patient_id" class="custom-control-input">
                                <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('PDF') }}</button>
                            </div>
                        </form> --}}
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        {{--  <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>  --}}
                        <div class="text-center">
                            <div class="h4 font-weight-300">
                                
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $patient->birth_date->format('d-M-Y') }} </span>
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
                        <div class="row text-center">
                            @include('components.currencySwitch', ['USD' => false])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                @include('components.personTab')
            </div>
        </div>
    </div>
@endsection
