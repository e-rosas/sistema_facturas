@extends('layouts.app', ['title' => 'Factura'])

@section('content')
@include('layouts.headers.header', ['title' => 'Factura, num. de cobro ' . $invoice->code])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0 card-group">
            @include('components.invoiceStatsCard', ['idUSD' => 'totalUSD','title' => 'Total', 'USD' => 1,'value' =>
            $invoice->totalDiscounted(), 'idMXN' => 'totalMXN', 'valueMXN' => $invoice->totalDiscountedMXN()])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-paid','title' => 'Pagado', 'bg' => 'bg-green',
            'USD' => 1,'value' => $invoice->amountPaid(), 'idMXN' => 'amount-paidMXN', 'valueMXN' =>
            $invoice->amountPaidMXN()])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-due','title' => 'Debe', 'bg' => 'bg-yellow',
            'USD' => 1, 'value' => $invoice->amountDue(), 'idMXN' => 'amount-dueMXN', 'valueMXN' => $invoice->debeF()])
            @include('components.invoiceStatsCard', ['idUSD' => 'invoice-status','title' => 'Estado', 'bg' => 'bg-blue',
            'USD' => 1, 'icon' => 'fas fa-info-circle', 'value' => $invoice->status(), 'valueMXN' => $invoice->status(),
            'idMXN' => 'invoice-statusMXN'])
        </div>

    </div>
    <br />
    <div class="row">
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
    <br />
    <div class="row">
        {{--  Details  --}}
        @include('invoices.partials.details', ['invoice' => $invoice])
    </div>
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tab-services-tab" data-toggle="tab" href="#tab-services"
                    role="tab" aria-controls="tab-services" aria-selected="true"><i
                        class="fas fa-procedures mr-2"></i>{{ __('Servicios') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tab-payment-tab" data-toggle="tab" href="#tab-payment"
                    role="tab" aria-controls="tab-payment" aria-selected="false"><i
                        class="fas fa-dollar-sign  mr-2"></i>{{ __('Pagos') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tab-credit-tab" data-toggle="tab" href="#tab-credit" role="tab"
                    aria-controls="tab-credit" aria-selected="false"><i
                        class="fas fa-money-check-alt mr-2"></i>{{ __('Nota de Crédito') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-calls-tab" data-toggle="tab" href="#tabs-calls" role="tab"
                    aria-controls="tabs-calls" aria-selected="false"><i class="fas fa-phone mr-2"></i>
                    {{ __('Llamadas') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-charge-tab" data-toggle="tab" href="#tab-charge" role="tab"
                    aria-controls="tabs-charge" aria-selected="false"><i class="fas fa-money-check-alt mr-2"></i>
                    {{ __('Cargos') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-document-tab" data-toggle="tab" href="#tab-document"
                    role="tab" aria-controls="tabs-document" aria-selected="false"><i class="fas fa-file-pdf mr-2"></i>
                    {{ __('Documentos') }}</a>
            </li>
        </ul>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-services" role="tabpanel"
                    aria-labelledby="tab-services-tab">
                    <div class="form-row">
                        @if ($invoice->status != 1)
                        <div class="col-md-9 col-auto">
                            <a href="{{ route('invoices.edit', $invoice) }}"
                                class="btn btn-sm btn-outline-secondary">Editar
                                servicios</a>
                        </div>
                        @endif
                        <div class="col-md-3 col-auto text-right">
                            <button id="view-services" type="button" class="btn btn-sm btn-outline-info"
                                data-toggle="modal" data-target="#modal-services">Lista</i></button>
                            <br />
                            @include('invoices.partials.servicesModal')
                        </div>
                    </div>

                    @include('components.tableDiagnosesCodes')
                    <br />
                    @include('components.servicesTable')
                </div>
                <div class="tab-pane fade" id="tab-payment" role="tabpanel" aria-labelledby="tab-payment-tab">
                    <div class="col-md-12 col-auto text-right">
                        @if ($invoice->status != 1)
                        <button id="add-payment" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-payment">Agregar</i></button>
                        <br />
                        @endif

                        @include('payments.partials.addModal',['invoice'=>$invoice])
                    </div>
                    @include('payments.partials.table', ['payments'=>$invoice->payments,
                    'patient_id'=>$invoice->patient->id])
                </div>
                <div class="tab-pane fade" id="tab-credit" role="tabpanel" aria-labelledby="tab-credit-tab">
                    <div class="col-md-12 col-auto text-right">
                        @if ($invoice->status != 1)
                        <button id="add-credit" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-credit">Registrar</i></button>
                        <br />
                        @endif

                        @include('credits.partials.details', ['credit'=>$invoice->credit])
                        @include('credits.partials.addModal')
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-calls" role="tabpanel" aria-labelledby="tabs-calls-tab">
                    <div class="col-md-12 col-auto text-right">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-call">{{ __('Agregar') }}</i></button>
                        <br />
                        @include('components.callsModal',['invoice_id'=>$invoice->id])
                    </div>
                    @include('components.callsTable', ['calls'=>$invoice->calls])
                    @include('calls.partials.editCallModal')
                </div>
                <div class="tab-pane fade" id="tab-charge" role="tabpanel" aria-labelledby="tab-charge-tab">
                    <div class="col-md-12 col-auto text-right">
                        @if ($invoice->type != 3)
                        <button id="add-charge" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-charge">Registrar</i></button>
                        <br />
                        @endif

                        @include('charges.partials.details', ['charge'=>$invoice->charge])
                        @include('charges.partials.addModal')
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-document" role="tabpanel" aria-labelledby="tab-document-tab">
                    <div class="col-md-12 col-auto text-right">
                        <button id="add-document" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-document">Agregar</i></button>
                        <br />

                        @include('documents.invoiceTable', ['documents'=>$invoice->documents])
                        @include('documents.partials.addInvoiceDocumentModal', ['invoice' => $invoice])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>

@endsection
