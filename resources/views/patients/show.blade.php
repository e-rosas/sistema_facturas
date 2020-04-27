@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
    @include('layouts.headers.header', ['title' => $patient->full_name, 'description' => $patient->insurance_id ])

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['id' => 'total','title' => 'Total', 'value' => $stats->getTotal()])
                @include('components.invoiceStatsCard', ['id' => 'amount-paid','title' => 'Amount paid', 'value' => $stats->getAmount_paid()])
                @include('components.invoiceStatsCard', ['id' => 'amount-due','title' => 'Amount due (insurance)', 'value' => $stats->getAmount_due()])
                @include('components.invoiceStatsCard', ['id' => 'personal-due','title' => 'Amount due (personal)', 'value' => $stats->getPersonalAmountDue()])
                @if ($stats->status==2)
                    @include('components.invoiceStatsCard', ['id' => 'total-total-due','title' => 'Amount due', 'value' => $stats->getTotalAmountDue()])
                @endif
            </div> --}}
        </div>
        <div class="row mt-5">
            <div class="col-xl-9">
                <div class="card card-stats mb-4 mb-xl-0">
                    @include('reports.partials.shortInvoicesTable', ['invoices' => $invoices])
                    {{-- <div class="card-body">
                        @include('components.personTab', ['invoices'=>$invoices, 'person_data'=>$insuree->person_data,
                            'stats'=>$stats, 'beneficiaries' => $beneficiaries])
                    </div> --}}
                </div>
            </div>
            <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>
                            {{ $patient->full_name }}<span class="font-weight-light"></span>
                        </h3>
                        {{-- <form  method="post" action="{{ route('reports.invoices') }}" >
                            @csrf
                            <div class="form-group col-md-12 col-auto">
                                <input type="hidden" value=" {{ $patient->id }} " name="person_data_id" id="input-person_data_id" class="custom-control-input">
                                <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('PDF') }}</button>
                            </div>
                        </form> --}}
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="h4 font-weight-300">
                                
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
        </div>
    </div>
@endsection
