<div class="modal fade" id="modal-change-insurance" tabindex="-1" role="dialog" aria-labelledby="modal-change-insurance"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Cambiar aseguranza') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <form role="form" method="post" action="{{ route('invoices.insurance', $invoice) }}"
                                autocomplete="off">
                                @csrf
                                @method('patch')
                                <input readonly type="hidden" name="invoice_id" id="input-invoice_id"
                                    class="form-control" value={{ $invoice->id }} required>
                                {{-- Insurances --}}
                                <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                    <label for="insurance-id" class="col-auto col-form-label">Aseguranza</label>
                                    <select id="insurance_id" class="custom-select form-control" name="insurance_id">
                                        @foreach ($insurances as $insurance)
                                            <option value="{{ $insurance->id }}">{{ $insurance->insurer->name }} -
                                                {{ $insurance->insurance_id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-success mt-4">{{ __('Guardar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
