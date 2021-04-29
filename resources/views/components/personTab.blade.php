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

                <div class="row m-1">
                    <div class="col-md-4">
                        <select class="custom-select" id="call-status" onchange="filterCalls()">

                            <option value="-1" selected>{{ __('Todas') }}</option>
                            <option value="0">{{ __('En proceso') }}</option>
                            <option value="1">{{ __('Deducibles') }}</option>
                            <option value="2">{{ __('Negada por cargos no cubiertos') }}</option>
                            <option value="3">{{ __('Pago') }}</option>
                            <option value="4">{{ __('Negada por fuera de tiempo') }}</option>
                            <option value="5">{{ __('Otro') }}</option>
                            <option value="6">{{ __('Pago pendiente') }}</option>
                            <option value="7">{{ __('Información pendiente') }}</option>
                            <option value="8">{{ __('Cobro no encontrado') }}</option>
                            <option value="9">{{ __('Medicamente innecesaria') }}</option>
                            <option value="10">{{ __('En apelación') }}</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="patient-calls" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="header">
                                <th scope="col">{{ __('Número') }}</th>
                                <th scope="col">{{ __('Factura') }}</th>
                                <th scope="col">{{ __('Fecha') }}</th>
                                <th scope="col">{{ __('Cobro') }}</th>
                                <th scope="col">{{ __('Estado') }}</th>
                                <th scope="col">{{ __('Comentarios') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                @foreach ($invoice->calls as $call)
                                    <tr>
                                        <td>{{ $call->number }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->number }}
                                            </a>
                                        </td>
                                        <td>{{ $call->date->format('M-d-Y') }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->code }}
                                            </a>
                                        </td>
                                        <td data-status="{{ $call->status }}">{{ $call->status() }}</td>
                                        <td>{{ $call->comments }}</td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
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
                            @foreach ($invoices as $invoice)
                                @foreach ($invoice->payments as $payment)
                                    <tr class="{{ $payment->type == 1 ? 'table-info' : '' }}">
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->code() }}
                                            </a>
                                        </td>
                                        <td>{{ $payment->type() }}</td>
                                        <td>{{ $payment->date->format('M-d-Y') }}</td>
                                        <td><span class="MXN"> {{ $payment->total() }} </span><span class="USD"
                                                style="display: none"> {{ $payment->amountPaid() }} </span></td>
                                        <td>{{ $payment->comments }}</td>
                                    </tr>
                                @endforeach
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
                        @include('insurances.addInsuranceModal');
                        @include('insurances.editInsuranceModal')
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

@push('js')
    <script> 
        function filterCalls() {
            const filter = document.querySelector('#call-status').value.toUpperCase();
            const trs = document.querySelectorAll('#patient-calls tr:not(.header)');
            if(filter != "-1") {
                trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.getAttribute("data-status") == (filter)) ? '' : 'none');
            }
            else {
                trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.getAttribute("data-status") != (filter)) ? '' : 'none');
            }
            
        }
    </script>
@endpush