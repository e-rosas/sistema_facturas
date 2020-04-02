{{--  Details  --}}
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-services-center">
                <div class="col-8 col-auto">
                    <h3 class="mb-0">{{ __('Invoice') }}</h3>
                </div>
                <div class="col-4 col-auto text-right">
                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                {{--  number --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-number">{{ __('Number') }}</label>
                    <label id="label-number">{{ $invoice->number }}</label>

                </div>
                {{--  date  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-date">{{ __('Date') }}</label>
                    <label id="label-date">{{ $invoice->date->format('l jS \\of F Y') }}</label>

                </div>
                {{--  status --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-status">{{ __('Status') }}</label>
                    <label id="label-status">{{ $invoice->status }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  amount_paid  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_paid">{{ __('Amount paid') }}</label>
                    <label id="label-amount_paid">{{ $invoice->amount_paid }}</label>

                </div>
                {{--  amount_due  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_due">{{ __('Amount due') }}</label>
                    <label id="label-amount_due">{{ $invoice->getAmountDue() }}</label>

                </div>
                
                
            </div>
            <div class="form-row">
                {{--  Comments  --}}
                <div class="col-md-9 col-auto form-group">
                    <label class="form-control-label" for="label-comments">{{ __('Comments') }}</label>
                    <label id="label-comments">{{ $invoice->comments }}</label>
                </div>
                
            </div>
            <div class="form-row">
                {{--  tax  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-tax">{{ __('Tax') }}</label>
                    <label id="label-tax">{{ $invoice->tax }}</label>

                </div>
                {{--  sub_total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total">{{ __('Subtotal') }}</label>
                    <label id="label-sub_total">{{ $invoice->sub_total }}</label>

                </div>
                {{--  total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total">{{ __('Total') }}</label>
                    <label id="label-total">{{ $invoice->total }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  dtax --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-dtax">{{ __('Tax with discounts') }}</label>
                    <label id="label-dtax">{{ $invoice->dtax }}</label>

                </div>
                {{--  sub_total_with_discounts  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total_with_discounts">{{ __('Subtotal with discounts') }}</label>
                    <label id="label-num">{{ $invoice->sub_total_discounted }}</label>

                </div>
                {{--  total_with_discounts  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total_with_discounts">{{ __('Total with discounts') }}</label>
                    <label id="label-num">{{ $invoice->total_with_discounts }}</label>

                </div>
            </div>
        </div>                    
    </div>               
</div>