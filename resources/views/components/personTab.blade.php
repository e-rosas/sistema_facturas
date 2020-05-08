<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-invoices-tab" data-toggle="tab" href="#tabs-invoices" role="tab" 
                aria-controls="tabs-invoices" aria-selected="true"><i class="fas fa-file-invoice-dollar  mr-2"></i> {{ __('Facturas') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-calls-tab" data-toggle="tab" href="#tabs-calls" role="tab" 
                aria-controls="tabs-calls" aria-selected="false"><i class="fas fa-phone mr-2"></i> {{ __('Llamadas') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-payments-tab" data-toggle="tab" href="#tabs-payments" role="tab" 
                aria-controls="tabs-payments" aria-selected="false"><i class="fas fa-dollar-sign mr-2"></i> {{ __('Pagos') }}</a>
        </li>
        @if ($patient->insured)
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-dependents-tab" data-toggle="tab" href="#tabs-dependents" role="tab" 
                aria-controls="tabs-dependents" aria-selected="false"><i class="fas fa-user-friends mr-2"></i> {{ __('Dependientes') }}</a>
        </li>
        @endif
    </ul>
</div>
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-invoices" role="tabpanel" aria-labelledby="tabs-invoices-tab">
                @include('reports.partials.shortInvoicesTable', ['invoices' => $invoices, 'invoices_totals'=>$invoices_totals])
            </div>
            <div class="tab-pane fade" id="tabs-calls" role="tabpanel" aria-labelledby="tabs-calls-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-call">{{ __('Agregar') }}</i></button>
                    <br />
                    @include('components.callsModal',['patient'=>$patient])
                </div>
                @include('components.callsTable', ['calls'=>$calls])

                 @include('calls.partials.editCallModal', ['patient_id' => $patient->id])
            </div>
            <div class="tab-pane fade" id="tabs-payments" role="tabpanel" aria-labelledby="tabs-payments-tab">
                @include('payments.partials.table', ['payments'=>$patient->payments()->paginate(15), 'patient_id'=>$patient->id])
            </div>
            @if ($patient->insured)
                <div class="tab-pane fade" id="tabs-dependents" role="tabpanel" aria-labelledby="tabs-dependents-tab">
                    <div class="col-md-12 col-auto text-right">
                        @include('components.beneficiariesTable', ['beneficiaries' => $beneficiaries])
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
