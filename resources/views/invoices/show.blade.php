@extends('layouts.app', ['title' => __('Invoice')])

@section('content')
    @include('layouts.headers.header', ['title' => __('View Invoice')])
    <div class="container-fluid mt--7">
        <div class="row">
            @include('components.patientInfo', ['patient' => $invoice->patient])

            @include('components.insurerInfo', ['insurer' => $invoice->patient->insurer])
        </div>
        <div class="row">
            {{--  Details  --}}
            @include('invoices.partials.details', ['invoice' => $invoice])
        </div>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tab-services-tab" data-toggle="tab" href="#tab-services" 
                        role="tab" aria-controls="tab-services" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Services</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-services" role="tabpanel" aria-labelledby="tab-services-tab">
                        @component('components.servicesTable', ['services'=>$invoice->services])
                            
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
    
@endsection