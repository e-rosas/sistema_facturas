<div>
    <div class="card shadow">

        <div class="card-header bg-primary border-0">
            <div class="row">
                <div class="col-md-8">
                    <h3 style="color:white" class="card-title text-uppercase  mb-0">Dental</h3>
                </div>
                <div class="col-md-2 text-right">
                    <button id="edit-dental-details" type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                        data-target="#modal-dental-details">Editar detalles</i></button>
                    <br />
                </div>
                <div class="col-md-2 text-right">
                    <div class="dropdown">
                        <a class="btn  btn-success btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            PDF
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <form target="_blank" method="post" action="{{ route('invoice.pdf.dental', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="D">
                                <button type="submit" class="dropdown-item">Descargar</button>
                            </form>
                            <form target="_blank" method="post" action="{{ route('invoice.pdf.dental', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="I">
                                <button type="submit" class="dropdown-item">Ver</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @include('invoices.partials.updateDentalDetailsModal')

        <div class="card-body">
            <div class="form-row ">
                {{-- Enclosures --}}
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <label class="form-control-label" for="enclosures">Enclosures</label>
                    <label id="enclosures">{{ $dental->enclosures ? 'Si' : 'No' }}</label>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label" for="orthodontics">Tratamiento para
                        ortodoncia</label>
                    <label class="label" id="orthodontics">{{ $dental->orthodontics ? 'Si' : 'No' }}</label>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label" for="prosthesis_replacement">Reemplazo de
                        prótesis</label>
                    <label class="label"
                        id="prosthesis_replacement">{{ $dental->prosthesis_replacement ? 'Si' : 'No' }}</label>
                </div>
            </div>
            @if ($dental->orthodontics)
            <div class="form-row">
                {{-- Appliance date --}}
                <div class="col-md-6 col-auto form-group">
                    <label class="form-control-label" for="appliance_placed">Fecha de colocación de aparato</label>
                    <label id="appliance_placed">{{ $dental->appliance_placed->format('M-d-Y') }}</label>
                </div>
                {{-- Months remaining --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="months_remaining">Meses restantes</label>
                    <label class="label" id="months_remaining">{{ $dental->months_remaining }}</label>
                </div>
            </div>

            @endif

            <div class="form-row">
                {{-- Prior placement date --}}
                <div class="col-md-6 col-auto form-group">
                    <label class="form-control-label" for="prior_placement">Fecha de colocación
                        previa</label>
                    <label id="prior_placement">{{ $dental->prior_placement->format('M-d-Y') }}</label>
                </div>
                <div class="col-md-6 col-auto form-group">
                    <label class="form-control-label"
                        for="treatment_resulting_from">{{ __('Tratamiento resultado de') }}</label>
                    <label class="label" id="treatment_resulting_from">{{ $dental->treatment() }}</label>
                </div>
            </div>
            <div class="form-row">
                {{-- Accident date --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="accident">Fecha de accidente</label>
                    <label id="accident">{{ $dental->accident->format('M-d-Y') }}</label>
                </div>
                {{--  Auto Accident State --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="auto_accident_state">Estado de accidente
                        automovilístico</label>
                    <label class="label" id="auto_accident_state">{{ $dental->auto_accident_state }}</label>
                </div>
                {{--  License --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="license">Licencia (dentista)</label>
                    <label class="label" id="license">{{ $dental->license }}</label>
                </div>
            </div>
            <div class="form-row">
                {{--  Tooth numbers --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="tooth-numbers">Dientes</label>
                    <label class="label" id="tooth-numbers">{{ $dental->tooth_numbers }}</label>
                </div>
            </div>
        </div>
    </div>
</div>


