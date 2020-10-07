@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
@include('layouts.headers.header', ['title' => $patient->full_name])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0 card-group">
            @include('components.invoiceStatsCard', ['idUSD' => 'totalUSD','title' => 'Total', 'USD' => 0, 'value' =>
            $patient->person_stats->total(), 'idMXN' => 'totalMXN', 'valueMXN' => $patient->person_stats->totalMXN()])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-paid','title' => 'Pagado', 'bg' => 'bg-green',
            'USD' => 0,'value' => $patient->person_stats->amountPaid(), 'idMXN' => 'amount-paidMXN', 'valueMXN' =>
            $patient->person_stats->amountPaidMXN()])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-credit','title' => 'Crédito', 'bg' => 'bg-info',
            'USD' => 0,'value' => $patient->person_stats->amountCredit(), 'idMXN' => 'amount-creditMXN', 'valueMXN' =>
            $patient->person_stats->amountCreditMXN()])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-due','title' => 'Debe', 'bg' => 'bg-yellow',
            'USD' => 0,'value' => $patient->person_stats->amountDue(), 'idMXN' => 'amount-dueMXN', 'valueMXN' =>
            $patient->person_stats->amountDueMXN()])

        </div>
    </div>
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    <div class="row mt-5">
        <div class="col-xl-9">
            @if (!$patient->insured)
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
            <br />
            @endif
            <div class="card card-stats ">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Aseguranza') }}</h5>
                            @if (!$patient->insured)
                            <span class="h2 font-weight-bold mb-0"> <a
                                    href="{{ route('insurers.show', $insuree->insurer) }}">
                                    {{ $insuree->insurer->name }}</a></span>
                            <span class="h4 font-weight-400 mb-2">{{ $insuree->insurer->email }}</span>
                            @else
                            <span class="h2 font-weight-bold mb-0"> <a
                                    href="{{ route('insurers.show', $patient->insuree->insurer) }}">
                                    {{ $patient->insuree->insurer->name }}</a></span>
                            <span class="h4 font-weight-400 mb-2">{{ $patient->insuree->insurer->email }}</span>
                            @endif

                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>
                    </div>
                    @if ($patient->insured)
                    <div class="row">
                        <div class="col"><span class="h3 font-weight-bold mb-0">{{ $patient->insuree->nss }}</span>
                        </div>
                        <div class="col"><span
                                class="h3 font-weight-bold mb-0">{{ $patient->insuree->group_number }}</span>
                        </div>
                    </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <h3>
                        {{ $patient->full_name }}<span class="font-weight-light"></span>
                    </h3>
                    <a class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                        href="{{ route('patients.edit', $patient) }}">
                        <i class="fas fa-pencil-alt fa-2"></i>
                    </a>
                    <br>
                    <h3>Estado de cuenta</h3>
                    <form method="get" action="{{ route('patient.letter', $patient) }}">
                        @csrf
                        <div class="form-row">
                            {{--  start_date  --}}
                            <div class="col-lg-12 col-auto">
                                <label for="start">{{ __('Fecha de facturación de') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="start" id="input-start" class="form-control"
                                        value="{{ $start->format('Y-m-d') }}">
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            {{--  end_date  --}}
                            <div class="col-lg-12 col-auto">
                                <label for="start">{{ __('hasta') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="end" id="input-end" class="form-control"
                                        value="{{ $end->format('Y-m-d')  }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row pt-md-2">
                            {{--  Letter  --}}
                            <div class="col-lg-6">
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                    <input type="checkbox" name="letter" id="input-letter" class="custom-control-input">
                                    <label class="custom-control-label" for="input-letter">Solo carta</label>
                                </div>
                            </div>
                            {{--  Mail  --}}
                            <div class="col-lg-6">
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                    <input type="checkbox" name="mail" id="input-mail" class="custom-control-input">
                                    <label class="custom-control-label" for="input-mail">Enviar</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-auto">
                                <button type="submit"
                                    class="btn btn-success mt-4 btn-block">{{ __('Aceptar') }}</button>
                            </div>
                        </div>


                    </form>
                    {{-- <form  method="post" action="{{ route('reports.invoices') }}" >
                    @csrf
                    <div class="form-group col-md-12 col-auto">
                        <input type="hidden" value=" {{ $patient->id }} " name="patient_id" id="input-patient_id"
                            class="custom-control-input">
                        <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('PDF') }}</button>
                    </div>
                    </form> --}}
                </div>
                <div class="card-body pt-0 pt-md-2">
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
