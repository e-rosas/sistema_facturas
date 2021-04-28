<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-invoices-tab" data-toggle="tab" href="#tabs-invoices"
                role="tab" aria-controls="tabs-invoices" aria-selected="true"><i
                    class="fas fa-file-invoice-dollar  mr-2"></i> {{ __('Facturas') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-calls-tab" data-toggle="tab" href="#tabs-calls" role="tab"
                aria-controls="tabs-calls" aria-selected="false"><i class="fas fa-phone mr-2"></i>
                {{ __('Llamadas') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-payments-tab" data-toggle="tab" href="#tabs-payments"
                role="tab" aria-controls="tabs-payments" aria-selected="false"><i class="fas fa-dollar-sign mr-2"></i>
                {{ __('Pagos') }}</a>
        </li>
        @if ($patient->insured)
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-dependents-tab" data-toggle="tab" href="#tabs-dependents"
                    role="tab" aria-controls="tabs-dependents" aria-selected="false"><i
                        class="fas fa-user-friends mr-2"></i> {{ __('Dependientes') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-insurances-tab" data-toggle="tab" href="#tabs-insurances"
                    role="tab" aria-controls="tabs-insurances" aria-selected="false"><i
                        class="fas fa-user-friends mr-2"></i> {{ __('Aseguranzas') }}</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-document-tab" data-toggle="tab" href="#tab-document" role="tab"
                aria-controls="tabs-document" aria-selected="false"><i class="fas fa-file-pdf mr-2"></i>
                {{ __('Documentos') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-mail-tab" data-toggle="tab" href="#tab-mail" role="tab"
                aria-controls="tabs-mail" aria-selected="false"><i class="fas fa-envelope mr-2"></i>
                {{ __('Correos') }}</a>
        </li>
    </ul>
</div>
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-invoices" role="tabpanel"
                aria-labelledby="tabs-invoices-tab">
                @include('reports.partials.shortInvoicesTable', ['invoices' => $invoices,
                'invoices_totals'=>$invoices_totals])
            </div>
            <div class="tab-pane fade" id="tabs-calls" role="tabpanel" aria-labelledby="tabs-calls-tab">
                @include('calls.partials.table')
            </div>
            <div class="tab-pane fade" id="tabs-payments" role="tabpanel" aria-labelledby="tabs-payments-tab">
                <div class="table-responsive">
                    <table id="payments_table" class="table align-services-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Factura') }}</th>
                                <th scope="col">{{ __('Tipo') }}</th>
                                <th scope="col">{{ __('Fecha') }}</th>
                                <th scope="col">{{ __('Cantidad') }}</th>
                                <th scope="col">{{ __('Comentarios') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr class="{{ $payment->type == 1 ? 'table-info' : '' }}">
                                    <td>
                                        <a href="{{ route('invoices.show', $payment->invoice) }}">
                                            {{ $payment->invoice->code() }}
                                        </a>
                                    </td>
                                    <td>{{ $payment->type() }}</td>
                                    <td><span class="MXN"> {{ $payment->total() }} </span><span class="USD"
                                            style="display: none"> {{ $payment->amountPaid() }} </span></td>
                                    <td>{{ $payment->comments }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($patient->insured)
                <div class="tab-pane fade" id="tabs-dependents" role="tabpanel" aria-labelledby="tabs-dependents-tab">
                    <div class="col-md-12 col-auto text-right">
                        @include('components.dependentsTable', ['dependents' => $dependents])
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-insurances" role="tabpanel" aria-labelledby="tabs-insurances-tab">
                    <div class="col-md-12 col-auto text-right">
                        <button id="add-insurance" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modal-insurance">Agregar</i></button>
                        <br />
                        @include('insurances.table', ['insurances' => $insurances])
                    </div>
                </div>
            @endif
            <div class="tab-pane fade" id="tab-document" role="tabpanel" aria-labelledby="tab-document-tab">
                <div class="col-md-12 col-auto text-right">
                    <button id="add-document" type="button" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#modal-patient-document">Agregar</i></button>
                    <br />

                    @include('documents.patientTable', ['documents'=>$patient->documents])
                    @include('documents.partials.addPatientDocumentModal', ['patient' => $patient])
                </div>
            </div>
            <div class="tab-pane fade" id="tab-mail" role="tabpanel" aria-labelledby="tab-mail-tab">
                <div class="col-md-12 col-auto text-right">
                    @include('emails.partials.emailsTable', ['letters'=>$letters])
                    @include('emails.partials.editModal')
                </div>
            </div>
        </div>
    </div>
</div>
