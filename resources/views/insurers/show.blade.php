@extends('layouts.app', ['title' => 'Aseguranza'])

@section('content')
    @include('layouts.headers.header', ['title' => $insuree->person_data->fullName(), 'description' => $insuree->insurance_id ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['id' => 'total','title' => 'Total', 'value' => $stats->getTotal()])
                @include('components.invoiceStatsCard', ['id' => 'amount-paid','title' => 'Amount paid', 'value' => $stats->getAmount_paid()])
                @include('components.invoiceStatsCard', ['id' => 'amount-due','title' => 'Amount due (insurance)', 'value' => $stats->getAmount_due()])
                @include('components.invoiceStatsCard', ['id' => 'personal-due','title' => 'Amount due (personal)', 'value' => $stats->getPersonalAmountDue()])
                @if ($stats->status==2)
                    @include('components.invoiceStatsCard', ['id' => 'total-total-due','title' => 'Amount due', 'value' => $stats->getTotalAmountDue()])
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        @include('components.personTab', ['invoices'=>$invoices, 'person_data'=>$insuree->person_data,
                            'stats'=>$stats, 'beneficiaries' => $beneficiaries])
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>
                            {{ $insuree->person_data->fullName() }}<span class="font-weight-light"></span>
                        </h3>
                        <form  method="post" action="{{ route('reports.invoices') }}" >
                            @csrf
                            <div class="form-group col-md-12 col-auto">
                                <input type="hidden" value=" {{ $insuree->person_data->id }} " name="person_data_id" id="input-person_data_id" class="custom-control-input">
                                <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('PDF') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading"> {{ count($beneficiaries)}} </span>
                                        <span class="description">{{ __('Beneficiaries') }}</span>
                                    </div>

                                    <div>
                                        <span id="stats-status" class="heading"> {{ $stats->getStatus() }} </span>
                                        <span class="description">{{ __('Status') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {{--  Latest call  --}}
                            @if (count($insuree->person_data->calls)>0)
                            <div class="form-group">
                                <label class="form-control-label" for="label-latest_call">{{ __('Latest call') }}</label>
                                <label id="label-calls">{{ $insuree->person_data->calls[0]->date->format('l jS \\of F Y')}}</label>
                            </div>
                            @endif
                        </div>
                        <div class="text-center">
                            {{--  Latest payment  --}}
                            @if (count($insuree->person_data->payments)>0)
                            <div class="">
                                <label class="h4 font-weight-300" for="label-latest_call">{{ __('Latest payment') }}</label>
                                <label class="h4 font-weight-200" id="label-payments">{{ $insuree->person_data->payments[0]->date->format('l jS \\of F Y')}}</label>
                            </div>
                            @endif
                        </div>
                        <div class="text-center">
                            <div class="h4 font-weight-300">
                                <span id="total-total"> {{ $stats->getTotalAmountDue() }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->birth_date->format('M-d-Y') }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->address }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->addressDetails() }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->phone_number }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <a href="mailto:{{$insuree->person_data->email}}">{{$insuree->person_data->email}}</a>
                            </div>
                            <div class="h4 font-weight-400">
                                <a href="">{{$insuree->insurer->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
