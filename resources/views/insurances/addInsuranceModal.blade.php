<div class="modal fade" id="modal-insurance" tabindex="-1" role="dialog" aria-labelledby="modal-insurance"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Asignar aseguranza') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">

                            {{-- Insurance ID --}}
                            <div class="form-group">
                                <label for="input-insurance_id" class="col-auto col-form-label">ID Aseguranza</label>
                                <input type="text" name="insurance_id" id="input-insurance_id"
                                    class="form-control form-control-alternative" placeholder="ID Aseguranza"
                                    value="{{ old('insurance_id') }}" required>
                            </div>

                            {{-- Insurer --}}
                            <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                <label for="insurer-id" class="col-auto col-form-label">Aseguranza</label>
                                <select id="insurer-id" class="custom-select form-control" name="insurer-id">
                                    @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Group Number --}}
                            <div class="form-group">
                                <label for="input-group-number" class="col-auto col-form-label">Número de grupo</label>
                                <input type="text" name="input-group-number" id="input-group-number"
                                    class="form-control form-control-alternative" placeholder="Número de grupo"
                                    value="">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('insurance_id') }}</strong>
                                </span>
                            </div>


                            {{-- Group phone number --}}
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-insurer-phone-number">Teléfono de grupo
                                        de
                                        aseguranza</label>
                                    <input type="text" name="insurer-phone-number" id="input-insurer-phone-number"
                                        class="form-control form-control-alternative"
                                        placeholder="Teléfono de grupo de aseguranza" value="">
                                </div>

                            </div>
                            {{-- Type --}}
                            <div class="form-group">
                                <label class="form-control-label" for="insurance-type">Tipo</label>
                                <select id='insurance-type' class="custom-select" name="insurance-type">
                                    <option value='0' selected>Médica</option>
                                    <option value='1'>Dental</option>
                                </select>
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label class="form-control-label" for="insurance-status">Estado</label>
                                <select id='insurance-status' class="custom-select" name="insurance-status">
                                    <option value='0' selected>Activa</option>
                                    <option value='1'>Vencida</option>
                                </select>
                            </div>
                            {{-- comments --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="insurance-comments"
                                        class="form-control" value="" placeholder="Notas"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button onclick="saveInsurance()" id="save-insurance"
                                    class="btn btn-success mt-4">Guardar</button>
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
        function sendInsurance(insuranceID, insurerID, groupNumber, groupPhoneNumber, type, status, comments) {
            $.ajax({
                url: "{{ route('insurances.store') }}",
                dataType: 'json',
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "insurance_id": insuranceID,
                    "group_number": groupNumber,
                    "insurer_group_phone_number": groupPhoneNumber,
                    "insurer_id": insurerID,
                    "insuree_id": "{{ $patient->insuree->patient_id }}",
                    "status": status,
                    "comments": comments,
                    "type": type
                },
                success: function(response) {
                    $('#modal-insurance').modal('hide');
                    displayInsurances(response.data);

                }
            });
            return false;
        }

        function saveInsurance() {

            var insuranceID = document.getElementById("input-insurance_id").value;
            var insurerID = document.getElementById("insurer-id").value;
            var groupNumber = document.getElementById("input-group-number").value;
            var groupPhoneNumber = document.getElementById("input-insurer-phone-number").value;
            var type = document.getElementById("insurance-type").value;
            var status = document.getElementById("insurance-status").value;
            var comments = document.getElementById("insurance-comments").value;
            if (insuranceID.length < 1) {
                return;
            } else {

                sendInsurance(insuranceID, insurerID, groupNumber, groupPhoneNumber, type, status, comments);

            }

        }

    </script>

@endpush
