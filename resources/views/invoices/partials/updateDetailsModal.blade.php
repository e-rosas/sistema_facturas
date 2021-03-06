<div class="modal fade" id="modal-details" tabindex="-1" role="dialog" aria-labelledby="modal-details"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Detalles') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="form-row">
                                {{-- number --}}
                                <div
                                    class="col-md-2 col-auto form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-number">Folio CONTPAQ</label>
                                    <input type="text" name="number" id="input-number"
                                        class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}"
                                        placeholder="Folio" value="{{ $invoice->number }}">

                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- series --}}
                                <div
                                    class="col-md-2 col-auto form-group{{ $errors->has('series') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-series">Serie</label>
                                    <input type="text" name="series" id="input-series"
                                        class="form-control form-control-alternative{{ $errors->has('series') ? ' is-invalid' : '' }}"
                                        placeholder="Serie" value="{{ $invoice->series }}">

                                    @if ($errors->has('series'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('series') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- concept --}}
                                <div
                                    class="col-md-8 col-auto form-group{{ $errors->has('concept') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-concept">Concepto</label>
                                    <input type="text" name="concept" id="input-concept"
                                        class="form-control form-control-alternative{{ $errors->has('concept') ? ' is-invalid' : '' }}"
                                        placeholder="Concepto" value="{{ $invoice->concept }}">

                                    @if ($errors->has('concept'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('concept') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>
                            <div class="form-row">
                                {{-- code --}}
                                <div
                                    class="col-md-4 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-code">Número</label>
                                    <input type="text" name="code" id="input-code"
                                        class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                        placeholder="Número" value="{{ $invoice->code }}">

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- date --}}
                                <div
                                    class="col-md-3 col-auto form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">Fecha Facturación</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input onchange="details_handler(event)" name="date" id="input-date"
                                            value="{{ $invoice->date->format('Y-m-d') }}"
                                            class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                            type="date" required>
                                    </div>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- exchange_rate --}}
                                <div
                                    class="col-md-5 form-group{{ $errors->has('exchange_rate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="invoice-exchange_rate">Cambio (mayor que
                                        0)</label>
                                    <input type="numeric" name="exchange_rate" id="invoice-exchange_rate"
                                        class="form-control form-control-alternative{{ $errors->has('exchange_rate') ? ' is-invalid' : '' }}"
                                        placeholder="Cambio" value="{{ $invoice->exchange_rate }}" required>

                                    @if ($errors->has('exchange_rate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('exchange_rate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- date --}}
                                <div
                                    class="col-md-3 col-auto form-group{{ $errors->has('DOS') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-DOS">Fecha Servicio</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="DOS" id="input-DOS" value="{{ $invoice->DOS->format('Y-m-d') }}"
                                            class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                            type="date" required>
                                    </div>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- comments --}}
                                <div
                                    class="col-md-12 col-auto form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comments">Observaciones</label>
                                    <input type="text" name="comments" id="input-comments"
                                        class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                        placeholder="Observaciones" value="{{ $invoice->comments }}">

                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- doctor --}}
                                <div
                                    class="col-md-12 col-auto form-group{{ $errors->has('doctor') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-doctor">Doctor</label>
                                    <input type="text" name="doctor" id="input-doctor"
                                        class="form-control form-control-alternative{{ $errors->has('doctor') ? ' is-invalid' : '' }}"
                                        placeholder="Nombre, MD" value="{{ $invoice->doctor }}">

                                    @if ($errors->has('doctor'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('doctor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-1"></div>
                                <div class="col-4 custom-control custom-checkbox">
                                    <label for="input-hospitalization">Hospitalización</label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" id="input-hospitalization" name="input-hospitalization"
                                            class="custom-control-input"
                                            {{ $invoice->hospitalization ? 'checked' : '' }}
                                            onclick="changeHospitalizationStatusConfirmation(this.checked)">
                                        .
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                                @if (config('app.initial') == 'C')
                                    <div class="col-lg-2 custom-control custom-checkbox">
                                        <input type="checkbox" name="update-cash" id="update-cash"
                                            class="custom-control-input" {{ $invoice->cash ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="update-cash">Cash</label>
                                    </div>
                                @else
                                    <input type="checkbox" name="update-cash" id="update-cash"
                                        class="custom-control-input" style="display: none">
                                @endif
                                <div class="col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" name="input-accept_assignment" id="input-accept_assignment"
                                        class="custom-control-input"
                                        {{ $invoice->accept_assignment ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="input-accept_assignment">¿Aceptar
                                        asignación?</label>
                                </div>

                            </div>
                            <div class="row m-3" id="hospitalization-details">
                                {{-- hospitalization Details --}}
                                <div class="col-xl-12 order-xl-1">
                                    <div class="card bg-secondary shadow">
                                        <div class="card-header bg-white border-0">
                                            <div class="row align-items-center">
                                                <div class="col-8 col-auto">
                                                    <h3 class="mb-0">Hospitalización</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2 custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" name="input-breakdown" id="input-breakdown"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="input-breakdown">Desglose</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                {{-- bill_type --}}
                                                <div class="col-md-12 col-auto form-group">
                                                    <label class="form-control-label" for="input-bill_type">Tipo
                                                        (Código)</label>
                                                    <input type="text" name="input-bill_type" id="input-bill_type"
                                                        class="form-control form-control-alternative" value="">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label class="form-control-label"
                                                        for="input-diagnosis_codes">Procedimientos (Código{Fecha,
                                                        separar con coma)</label>
                                                    <input type="text" name="input-diagnosis_codes"
                                                        id="input-diagnosis_codes"
                                                        class="form-control form-control-alternative"
                                                        placeholder="Separar con coma , sin espacios">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button onclick="saveDetails()" id="save_details"
                                    class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script>
        showHospitalizationSection(0);
        function changeHospitalizationStatusConfirmation(status) {
            var r = confirm("¿Desea continuar?");
            if (r == true) {
                changeHospitalizationStatus(status);
            }
        }
        function sendDetails(exchange_rate, date, comments, series, concept, code, number, doctor, isHospitalization, DOS,
            cash) {
            var isAccepted = document.getElementById("input-accept_assignment").checked ? 1 : 0;
            var breakdown = 0;
            var bill_type = "";
            var diagnosis_codes = "";
            if (isHospitalization) {

                breakdown = document.getElementById("input-breakdown").checked ? 1 : 0;
                bill_type = document.getElementById("input-bill_type").value;
                diagnosis_codes = document.getElementById("input-diagnosis_codes").value;

            }
            $.ajax({
                url: "{{ route('invoices.details') }}",
                dataType: 'json',
                type: "patch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "invoice_id": {{ $invoice->id }},
                    "exchange_rate": exchange_rate,
                    "date": date,
                    "comments": comments,
                    "concept": concept,
                    "series": series,
                    "code": code,
                    "number": number,
                    "doctor": doctor,
                    "hospitalization": isHospitalization,
                    "DOS": DOS,
                    "cash": cash,
                    "accept_assignment": isAccepted,
                    "breakdown": breakdown,
                    "diagnosis_codes": diagnosis_codes,
                    "bill_type": bill_type
                },
                success: function(response) {
                    displayDetails(response.data);
                    displayStats();
                    $('#modal-details').modal('hide');

                }
            });
            return false;
        }
        function changeHospitalizationStatus(status) {
            var hospitalizationCheckbox = document.getElementById("input-hospitalization");
            hospitalizationCheckbox.checked = status;
            showHospitalizationSection(status);
        }

        function showHospitalizationSection(show) {
            var hospitalizationSection = document.getElementById("hospitalization-details");
            var hospitalizationCheckbox = document.getElementById("input-hospitalization");
            hospitalizationCheckbox.checked = show;
            hospitalizationSection.style.display = show ? 'block' : 'none';
        }

        function displayDetails(data) {
            document.getElementById("label-date").innerHTML = data.date;
            document.getElementById("label-exchange_rate").innerHTML = data.exchange_rate;
            document.getElementById("label-number").innerHTML = data.number;
            document.getElementById("label-status").innerHTML = data.status;
            document.getElementById("label-concept").innerHTML = data.concept;
            document.getElementById("label-comments").innerHTML = data.comments;
            document.getElementById("label-code").innerHTML = data.code;
            document.getElementById("label-doctor").innerHTML = data.doctor;
            document.getElementById("label-DOS").innerHTML = data.DOS;
            if (data.cash == "1") {
                document.getElementById("cash").checked = true;
            } else {
                document.getElementById("cash").checked = false;
            }

        }

        function saveDetails() {
            var date = document.getElementById("input-date").value;
            var exchange_rate = document.getElementById("invoice-exchange_rate").value;
            var series = document.getElementById("input-series").value;
            var concept = document.getElementById("input-concept").value;
            var code = document.getElementById("input-code").value;
            var number = document.getElementById("input-number").value;
            var doctor = document.getElementById("input-doctor").value;
            var comments = document.getElementById("input-comments").value;
            var DOS = document.getElementById("input-DOS").value;
            var cash = document.getElementById("update-cash").checked ? 1 : 0;
            var isHospitalization = document.getElementById("input-hospitalization").checked ? 1 : 0;



            if (exchange_rate > 0) {
                sendDetails(exchange_rate, date, comments, series, concept, code, number, doctor, isHospitalization, DOS,
                    cash);
            } else {
                alert("Revisar tipo de cambio.");
            }
        }

    </script>

@endpush
