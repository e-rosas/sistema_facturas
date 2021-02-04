<div class="modal fade bd-example-modal-lg" id="modal-dental-service" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading align-centered text-center mb-4">Servicio Dental</h5>
                        <div class="form-row">
                            <div class="col-md-12 text-left">
                                <h3 id="modal-dental-service-description" class="text-uppercase text-default ls-1 mb-1">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">

                        <div class="form-row">
                            {{--  Oral cavity --}}
                            <div class="col-md-6 col-auto">
                                <h5 for="modal-dental-service-oral-cavity">{{ __('Area de cavidad oral') }}</h5>
                                <label id="modal-dental-service-oral-cavity"></label>
                            </div>
                            {{-- Tooth system --}}
                            <div class="col-md-6 col-auto">
                                <h5 for="modal-dental-service-tooth-system">{{ __('Sistema dental') }}</h5>
                                <label id="modal-dental-service-tooth-system"></label>
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- Tooth surfaces --}}
                            <div class="col-md-4 col-auto">
                                <h5 for="modal-dental-service-tooth-surfaces">{{ __('Superficies dentales') }}</h5>
                                <label id="modal-dental-service-tooth-surfaces"></label>
                            </div>
                            {{-- Tooth numbers --}}
                            <div class="col-md-4 col-auto">
                                <h5 for="modal-dental-service-tooth-numbers">{{ __('Letra(s) o numero(s) del diente') }}
                                </h5>
                                <label id="modal-dental-service-tooth-numbers"></label>
                            </div>
                            <div class="col-md-4 col-auto">
                                <h5 for="modal-dental-service-tooth-missing">{{ __('¿Diente faltante?') }}
                                </h5>
                                <label id="modal-dental-service-tooth-missing"></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
