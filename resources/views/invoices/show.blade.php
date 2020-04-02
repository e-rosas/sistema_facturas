@extends('layouts.app', ['title' => __('Invoice')])

@section('content')
    @include('layouts.headers.header', ['title' => __('View Invoice')])
    <div class="container-fluid mt--7">
        <div class="row">
            @component('components.patientInfo', ['person_data' => $invoice->person_data])

            @endcomponent
            {{--  Insuree ?  --}} 
            @if ($invoice->person_data->insured == 0)
                @component('components.patientInfo', ['person_data' => $invoice->findInsuree()])

                @endcomponent        
            @endif
            @component('components.insurerInfo', ['insurer' => $invoice->findInsurer()])

            @endcomponent
        </div>
        <div class="row">
            {{--  Details  --}}
            @include('invoices.partials.details', ['invoice' => $invoice])
        </div>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i> {{ __('Services') }} </a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @component('components.servicesTable', ['services'=>$invoice->services])
                            
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
    
@endsection