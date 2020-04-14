<div class="modal fade" id="modal-person"  role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Select patient') }}</h6>                 
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('invoice.updateperson') }}"  autocomplete="off">
                            @csrf            
                            @method('patch')     
                            {{--  Invoice --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <input readonly type="hidden" name="invoice_id" id="input-invoice_id" class="form-control"
                                    value={{ $invoice_id ?? '' }} required>
                                </div>
                            </div>    
                            <div class="form-group text-center">                               
                                    @include('components.searchPatients')                      
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <button id="update_invoice_person" type="submit" class="btn btn-block btn-success">{{ __('Save') }}</button>
                                </div>
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>