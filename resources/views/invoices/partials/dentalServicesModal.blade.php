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
                        {{--  Oral cavity --}}
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                                </div>
                                <input type="text" name="oral-cavity" id="modal-dental-service-oral-cavity"
                                    class="form-control" placeholder="{{ __('Area de cavidad oral') }}">
                            </div>
                        </div>
                        {{-- Tooth system --}}
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                                </div>
                                <input type="text" name="tooth-system" id="modal-dental-service-tooth-system"
                                    class="form-control" placeholder="{{ __('Sistema dental') }}">
                            </div>
                        </div>
                        {{-- Tooth surfaces --}}
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                                </div>
                                <input type="text" name="tooth-surfaces" id="modal-dental-service-tooth-surfaces"
                                    class="form-control" placeholder="{{ __('Superficies dentales') }}">
                            </div>
                        </div>
                        {{-- Tooth numbers --}}
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                                </div>
                                <input type="text" name="tooth-numbers" id="modal-dental-service-tooth-numbers"
                                    class="form-control" placeholder="{{ __('Letra(s) o numero(s) del diente') }}">
                            </div>
                        </div>
                        {{-- Missing --}}
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                    <input type="checkbox" name="tooth-missing" id="modal-dental-service-tooth-missing"
                                        class="custom-control-input">
                                    <label class="custom-control-label"
                                        for="modal-dental-service-tooth-missing">{{ __('¿Diente faltante?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal"
                    onclick="updateDentalServiceDetails()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
