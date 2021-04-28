<div class="modal fade" id="modal-dental-details" tabindex="-1" role="dialog" aria-labelledby="modal-dental-details"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h4 class="heading-small text-muted mb-4">{{ __('Detalles dentales') }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="form-row ">
                                {{-- Enclosures --}}
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3 custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="input-enclosures" id="input-enclosures"
                                        class="custom-control-input" {{ $dental->enclosures ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="input-enclosures">Enclosures</label>
                                </div>
                                <div class="col-lg-4 custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="input-orthodontics" id="input-orthodontics"
                                        class="custom-control-input" onclick="changeOrthodonticsStatus(this.checked)"
                                        {{ $dental->orthodontics ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="input-orthodontics">Tratamiento para
                                        ortodoncia</label>
                                </div>
                                <div class="col-lg-4 custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="input-prosthesis" id="input-prosthesis"
                                        class="custom-control-input"
                                        {{ $dental->prosthesis_replacement ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="input-prosthesis">Reemplazo de
                                        prótesis</label>
                                </div>
                            </div>
                            <div id="orthodontics-details" class="form-row">
                                {{-- Appliance date --}}
                                <div class="col-md-6 col-auto form-group">
                                    <label class="form-control-label" for="input-placed">Fecha de colocación de
                                        aparato</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="placed" id="input-placed"
                                            class="form-control form-control-alternative" type="date"
                                            value="{{ $dental->appliance_placed->format('Y-m-d') }}">
                                    </div>
                                </div>
                                {{-- Months remaining --}}
                                <div class="col-md-4 col-auto form-group">
                                    <label class="form-control-label" for="input-months">Meses restantes</label>
                                    <input type="number" name="months-remaining" id="input-months"
                                        class="form-control form-control-alternative"
                                        value="{{ $dental->months_remaining }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- Prior placement date --}}
                                <div class="col-md-6 col-auto form-group">
                                    <label class="form-control-label" for="input-prior-placement">Fecha de colocación
                                        previa</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="prior-placement" id="input-prior-placement"
                                            class="form-control form-control-alternative" type="date"
                                            value="{{ $dental->prior_placement->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-auto form-group">
                                    <label for="input-treatment">{{ __('Tratamiento resultado de') }}</label>
                                    <select id="input-treatment" class="custom-select" name="input-treatment">
                                        <option value='3'
                                            {{ $dental->treatment_resulting_from == 3 ? 'selected' : '' }}>No Aplica
                                        </option>
                                        <option value='0'
                                            {{ $dental->treatment_resulting_from == 0 ? 'selected' : '' }}>Lesión /
                                            enfermedad ocupacional</option>
                                        <option value='1'
                                            {{ $dental->treatment_resulting_from == 1 ? 'selected' : '' }}>Accidente
                                            automovilístico</option>
                                        <option value='2'
                                            {{ $dental->treatment_resulting_from == 2 ? 'selected' : '' }}>Otro
                                            accidente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- Accident date --}}
                                <div class="col-md-6 col-auto form-group">
                                    <label class="form-control-label" for="input-accident">Fecha de accidente</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="placed" id="input-accident"
                                            class="form-control form-control-alternative" type="date"
                                            value="{{ $dental->accident->format('Y-m-d') }}">
                                    </div>
                                </div>
                                {{-- Auto Accident State --}}
                                <div class="col-md-6 col-auto form-group">
                                    <label class="form-control-label" for="input-accident-state">Estado de accidente
                                        automovilístico</label>
                                    <input type="text" name="input-accident-state" id="input-accident-state"
                                        class="form-control form-control-alternative"
                                        value="{{ $dental->auto_accident_state }}">
                                </div>

                            </div>
                            <div class="form-row">
                                {{-- License --}}
                                <div class="col-md-6 col-auto form-group">
                                    <label class="form-control-label" for="input-license">Licencia (separar por
                                        coma)</label>
                                    <input type="text" name="input-license" id="input-license"
                                        class="form-control form-control-alternative" value="{{ $dental->license }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label" for="input-tooth-numbers">Dientes (separar por
                                        coma)</label>
                                    <input type="text" name="input-tooth-numbers" id="input-tooth-numbers"
                                        class="form-control form-control-alternative"
                                        value="{{ $dental->tooth_numbers }}">
                                </div>
                            </div>
                            <div class="text-center">
                                <button onclick="saveDentalDetails()" id="save-dental-details"
                                    class="btn btn-success btn-block mt-4">{{ __('Guardar') }}</button>
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
        function sendDentalDetails(enclosures, orthodontics, tooth_numbers, auto_accident_state, treatment_resulting_from,
            months_remaining, prosthesis_replacement, license, appliance_placed, prior_placement, accident_date) {
            $.ajax({
                url: "{{ route('invoices.dentalDetails') }}",
                dataType: 'json',
                type: "patch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "invoice_id": {{ $dental->invoice_id }},
                    "appliance_placed": appliance_placed,
                    "prior_placement": prior_placement,
                    "accident": accident_date,
                    "enclosures": enclosures,
                    "orthodontics": orthodontics,
                    "auto_accident_state": auto_accident_state,
                    "treatment_resulting_from": treatment_resulting_from,
                    "months_remaining": months_remaining,
                    "prosthesis_replacement": prosthesis_replacement,
                    "tooth_numbers": tooth_numbers,
                    "license": license
                },
                success: function(response) {
                    displayDentalDetails(response.data);
                    displayStats();
                    $('#modal-dental-details').modal('hide');

                }
            });
            return false;
        }

        function displayDentalDetails(data) {
            var details = data;
            document.getElementById("input-enclosures").checked = details.enclosures;
            document.getElementById("input-orthodontics").checked = details.orthodontics;
            changeOrthodonticsStatus(details.orthodontics);
            document.getElementById("input-prosthesis").checked = details.prosthesis;
            document.getElementById("input-placed").value = details.appliance_placed2;
            document.getElementById("input-months").value = details.months_remaining;
            document.getElementById("input-prior-placement").value = details.prior_placement2;
            document.getElementById("input-treatment").value = details.treatment_resulting_from;
            document.getElementById("input-accident").value = details.accident2;
            document.getElementById("input-accident-state").value = details.auto_accident_state;
            document.getElementById("input-license").value = details.license;
            document.getElementById("input-tooth-numbers").value = details.tooth_numbers;

        }

        function saveDentalDetails() {
            appliance_placed = document.getElementById("input-placed").value;
            prior_placement = document.getElementById("input-prior-placement").value;
            accident_date = document.getElementById("input-accident").value;
            enclosures = document.getElementById("input-enclosures").checked ? 1 : 0;
            orthodontics = document.getElementById("input-orthodontics").checked ? 1 : 0;
            license = document.getElementById("input-license").value;
            tooth_numbers = document.getElementById("input-tooth-numbers").value;
            auto_accident_state = document.getElementById("input-accident-state").value;
            treatment_resulting_from = document.getElementById("input-treatment").value;
            months_remaining = document.getElementById("input-months").value;
            prosthesis_replacement = document.getElementById("input-prosthesis").checked ? 1 : 0;
            sendDentalDetails(enclosures, orthodontics, tooth_numbers, auto_accident_state, treatment_resulting_from,
                months_remaining, prosthesis_replacement, license, appliance_placed, prior_placement, accident_date);
        }

        function changeOrthodonticsStatus(status) {
            var orthoDetails = document.getElementById("orthodontics-details");
            if (status) {
                orthoDetails.style.display = 'block';

            } else {
                orthoDetails.style.display = 'none';
            }
        }

    </script>

@endpush
