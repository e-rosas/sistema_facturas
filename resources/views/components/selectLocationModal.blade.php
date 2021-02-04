<div class="modal fade" id="modal-location" role="dialog" aria-labelledby="modal-location" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Seleccionar nueva ubicación') }}</h6>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('invoices.location', $invoice) }}"
                            autocomplete="off">
                            @csrf
                            @method('patch')
                            {{--  Invoice --}}
                            <input readonly type="hidden" name="invoice_id" id="input-invoice_id" class="form-control"
                                value={{ $invoice->id }} required>

                            <div class="col-xl-12 order-xl-1">
                                @include('components.searchLocations')
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="text-center">
                                    <button id="update_invoice_person" type="submit"
                                        class="btn btn-block btn-success">{{ __('Cambiar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
