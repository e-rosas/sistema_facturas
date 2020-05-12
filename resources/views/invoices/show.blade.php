@extends('layouts.app', ['title' => 'Factura'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Factura ' . $invoice->code])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['id' => 'total','title' => 'Total', 'value' => $invoice->total_with_discounts])
                @include('components.invoiceStatsCard', ['id' => 'amount-paid','title' => 'Pagado', 'value' => $invoice->amount_paid])
                @include('components.invoiceStatsCard', ['id' => 'amount-due','title' => 'Debe', 'value' => $invoice->amount_due])
                @include('components.invoiceStatsCard', ['id' => 'invoice-status','title' => 'Estado', 'value' => $invoice->status()])
            </div>
            
        </div>
        <div class="row">
            @include('components.patientInfo', ['patient' => $invoice->patient, 'type' => 'Paciente'])
            @if ($invoice->patient->insured)
                @include('components.insurerInfo', ['insurer' => $invoice->patient->insuree->insurer])
            @else
                @include('components.patientInfo', ['patient' => $insuree->patient, 'type' => 'Asegurado'])
                @include('components.insurerInfo', ['insurer' => $insuree->insurer])
            @endif
            
        </div>
        <div class="row">
            {{--  Details  --}}
            @include('invoices.partials.details', ['invoice' => $invoice])
        </div>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tab-services-tab" data-toggle="tab" href="#tab-services" 
                        role="tab" aria-controls="tab-services" aria-selected="true"><i class="fas fa-procedures mr-2"></i>Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tab-payment-tab" data-toggle="tab" href="#tab-payment" 
                        role="tab" aria-controls="tab-payment" aria-selected="false"><i class="fas fa-dollar-sign  mr-2"></i>Pagos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tab-credit-tab" data-toggle="tab" href="#tab-credit"
                         role="tab" aria-controls="tab-credit" aria-selected="false"><i class="fas fa-money-check-alt mr-2"></i>Nota de Crédito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-calls-tab" data-toggle="tab" href="#tabs-calls" role="tab" 
                        aria-controls="tabs-calls" aria-selected="false"><i class="fas fa-phone mr-2"></i> {{ __('Llamadas') }}</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-services" role="tabpanel" aria-labelledby="tab-services-tab">
                        <div class="col-md-12 col-auto text-right">
                            <button id="view-services" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-services">Lista</i></button>
                            <br />
                             @include('invoices.partials.servicesModal',['invoice'=>$invoice])
                        </div>
                        @include('components.servicesTable', ['services'=>$invoice->services])
                    </div>
                    <div class="tab-pane fade" id="tab-payment" role="tabpanel" aria-labelledby="tab-payment-tab">
                        <div class="col-md-12 col-auto text-right">
                            @if ($invoice->status != 1) 
                                <button id="add-payment" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-payment">Agregar</i></button>
                                <br />
                            @endif
                            
                             @include('payments.partials.addModal',['invoice'=>$invoice])
                        </div>
                        @include('payments.partials.table', ['payments'=>$invoice->payments, 'patient_id'=>$invoice->patient->id])
                    </div>
                    <div class="tab-pane fade" id="tab-credit" role="tabpanel" aria-labelledby="tab-credit-tab">
                        <div class="col-md-12 col-auto text-right">
                            @if ($invoice->status != 1) 
                                <button id="add-credit" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-credit">Registrar</i></button>
                                <br />
                            @endif
                            
                            @include('credits.partials.details', ['credit'=>$invoice->credit])
                            @include('credits.partials.addModal')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-calls" role="tabpanel" aria-labelledby="tabs-calls-tab">
                        <div class="col-md-12 col-auto text-right">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-call">{{ __('Agregar') }}</i></button>
                            <br />
                            @include('components.callsModal',['invoice_id'=>$invoice->id])
                        </div>
                        @include('components.callsTable', ['calls'=>$invoice->calls])
                        @include('calls.partials.editCallModal')
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
    
@endsection