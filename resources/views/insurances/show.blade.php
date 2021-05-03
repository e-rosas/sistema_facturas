@extends('layouts.app', ['title' => __('Service')])

@section('content')
    @include('layouts.headers.header', ['title' => $insurance->insurance_id, 'description' => $insurance->group_number])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Aseguranza') }}</h5>
                                <span class="h2 font-weight-bold mb-0"> <a
                                        href="{{ route('insurers.show', $insuree->insurer) }}">
                                        {{ $insuree->insurer->name }}</a></span>
                                <br />
                                <span class="h4 font-weight-400 mb-2">{{ $insuree->insurer->email }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Asegurado') }}</h5>
                                <span class="h2 font-weight-bold mb-0"> <a
                                        href="{{ route('patients.show', $insuree->patient) }}">
                                        {{ $insuree->patient->full_name }} - {{ $insuree->nss }} </a></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Pacientes') }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ count($patients) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-patients-tab" data-toggle="tab" href="#tabs-patients"
                        role="tab" aria-controls="tabs-patients" aria-selected="true"><i
                            class="fas fa-user-friends mr-2"></i> {{ __('Pacientes') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-invoices-tab" data-toggle="tab"
                        href="#tabs-invoices" role="tab" aria-controls="tabs-invoices" aria-selected="false"><i
                            class="fas fa-file-invoice-dollar  mr-2"></i> {{ __('Facturas') }} </a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-patients" role="tabpanel"
                        aria-labelledby="tabs-patients-tab">
                        @include('patients.partials.smallTable', ['patients' => $patients])
                    </div>
                    <div class="tab-pane fade" id="tabs-invoices" role="tabpanel"
                        aria-labelledby="tabs-invoices-tab">
                        @include('invoices.partials.smallTable', ['invoices' => $invoices])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
