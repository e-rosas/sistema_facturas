<div>
    <div class="card shadow">

        <div class="card-header bg-secondary border-0">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title text-uppercase  mb-0">Hospitalización</h3>
                </div>
                <div class="col-md-2 text-right">
                    <button id="edit-hospitalization-details" type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                        data-target="#modal-hospitalization-details">Editar detalles</i></button>
                    <br />
                </div>
                <div class="col-md-2 text-right">
                    <div class="dropdown">
                        <a class="btn  btn-success btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            PDF
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <form target="_blank" method="post" action="{{ route('invoice.pdf.hospitalization', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="D">
                                <button type="submit" class="dropdown-item">Descargar</button>
                            </form>
                            <form target="_blank" method="post" action="{{ route('invoice.pdf.hospitalization', $invoice) }}">
                                @csrf
                                <input type="hidden" name="output" value="I">
                                <button type="submit" class="dropdown-item">Ver</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @include('invoices.partials.updateHospitalizationDetailsModal')

        <div class="card-body">
            <div class="form-row ">
                {{-- bill_type --}}
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <label class="form-control-label" for="bill_type">Código de tipo</label>
                    <label id="bill_type">{{ $hospitalization->bill_type  }}</label>
                </div>
                <div class="col-lg-7">
                    <label class="form-control-label" for="diagnosis_codes">Procedimientos (Código-Fecha)</label>
                    <label class="label" id="diagnosis_codes">{{ $hospitalization->diagnosis_codes  }}</label>
                </div>
                <div class="col-lg-2">
                    <label class="form-control-label" for="breakdown">Desglose</label>
                    <label class="label"
                        id="breakdown">{{ $hospitalization->breakdown ? 'Si' : 'No' }}</label>
                </div>
            </div>              
        </div>
    </div>
</div>


