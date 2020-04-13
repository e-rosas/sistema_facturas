<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-file-invoice-dollar  mr-2"></i> {{ __('Invoices') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-tags mr-2"></i> {{ __('Discounts') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-phone mr-2"></i> {{ __('Calls') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fas fa-dollar-sign mr-2"></i> {{ __('Payments') }}</a>
        </li>
        @if ($person_data->insured)
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="fas fa-user-friends mr-2"></i> {{ __('Beneficiaries') }}</a>
        </li>
        @endif
    </ul>
</div>
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                @include('insurees.partials.invoicesTable', ['invoices' => $invoices])
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $invoices->links() }}
                    </nav>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" id="add-personal-discount-button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-form">{{ __('Add') }}</i></button>
                    <br />
                    @include('components.discountsModal',['person_data_id'=>$person_data->id, 'stats'=>$stats])

                    
                </div>
                @include('components.discountsTable', ['discounts'=>$person_data->discounts()->paginate(15)])

                
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-call">{{ __('Add') }}</i></button>
                    <br />
                    @include('components.callsModal',['person_data'=>$person_data])
                </div>
                @include('components.callsTable', ['calls'=>$person_data->calls()->paginate(15)])

                 @include('calls.partials.editCallModal', ['person_data_id' => $person_data->id])
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-payment">{{ __('Add') }}</i></button>
                    <br />
                    @include('payments.partials.addModal',['person_data_id'=>$person_data->id])
                </div>
                @include('payments.partials.table', ['payments'=>$person_data->payments()->paginate(15), 'person_data_id'=>$person_data->id])
            </div>
            @if ($person_data->insured)
            <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="col-md-12 col-auto text-right">
                    @include('insurees.partials.beneficiariesTable', ['beneficiaries' => $beneficiaries])
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
