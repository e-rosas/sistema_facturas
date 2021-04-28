<div class="modal fade" id="modal-update-insurance" tabindex="-1" role="dialog" aria-labelledby="modal-update-insurance"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Editar aseguranza') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">

                            {{-- Insurance ID --}}
                            <div class="form-group">
                                <label for="update-insurance_id" class="col-auto col-form-label">ID Aseguranza</label>
                                <input type="text" name="insurance_id" id="update-insurance_id"
                                    class="form-control form-control-alternative" placeholder="ID Aseguranza"
                                    value="{{ old('insurance_id') }}" required>
                            </div>

                            {{-- Insurer --}}
                            <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                <label for="update-insurer-id" class="col-auto col-form-label">Aseguranza</label>
                                <select id="update-insurer-id" class="custom-select form-control"
                                    name="update-insurer-id">
                                    @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Group Number --}}
                            <div class="form-group">
                                <label for="update-group-number" class="col-auto col-form-label">Número de grupo</label>
                                <input type="text" name="update-group-number" id="update-group-number"
                                    class="form-control form-control-alternative" placeholder="Número de grupo"
                                    value="{{ old('group_number') }}">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('insurance_id') }}</strong>
                                </span>
                            </div>


                            {{-- Group phone number --}}
                            <div class="form-group">
                                <div class="col-md-8 form-group">
                                    <label class="form-control-label" for="update-insurer-phone-number">Teléfono de
                                        grupo
                                        de
                                        aseguranza</label>
                                    <input type="text" name="insurer_phone_number" id="update-insurer-phone-number"
                                        class="form-control form-control-alternative{{ $errors->has('insurer_phone_number') ? ' is-invalid' : '' }}"
                                        placeholder="Teléfono de grupo de aseguranza" value="">
                                    @endif
                                </div>

                            </div>
                            {{-- Type --}}
                            <div class="form-group">
                                <label class="form-control-label" for="update-insurance-type">Tipo</label>
                                <select id='update-insurance-type' class="custom-select" name="update-insurance-type">
                                    <option value='0' selected>Médica</option>
                                    <option value='1'>Dental</option>
                                </select>
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label class="form-control-label" for="update-insurance-status">Estado</label>
                                <select id='update-insurance-status' class="custom-select"
                                    name="update-insurance-status">
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
                                    <textarea type="text" rows="3" name="comments" id="update-insurance-comments"
                                        class="form-control" value="" placeholder="Notas"></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="update-insurance">
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
        function getInsurance(id) {
            $.ajax({
                url: "{{ route('insurances.find') }}",
                dataType: 'json',
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    displayInsuranceModal(response.data.id, response.data.insurance_id,
                        response.data.insurer_id, response.data.group_number,
                        response.data.insurer_group_phone_number, response.data.type2, response.data
                        .status2, response.data.comments);
                }
            });
            return false;
        }

        function displayInsuranceModal(id, insuranceID, insurerID, groupNumber, groupPhoneNumber, type, status, comments) {
            document.getElementById("update-insurance_id").value = insuranceID;
            document.getElementById("update-insurer-id").value = insurerID;
            document.getElementById("update-group-number").value = groupNumber;
            document.getElementById("update-insurer-phone-number").value = groupPhoneNumber;
            document.getElementById("update-insurance-type").value = type;
            document.getElementById("update-insurance-status").value = status;
            document.getElementById("update-insurance-comments").value = comments;
            document.getElementById("update-insurance").value = id;

        }

        function updateInsurance(insuranceID, insurerID, groupNumber, groupPhoneNumber, type, status, comments, id) {
            $.ajax({
                url: "{{ route('insurances.update') }}",
                dataType: 'json',
                type: "patch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "insurance_id": insuranceID,
                    "group_number": groupNumber,
                    "insurer_group_phone_number": groupPhoneNumber,
                    "insurer_id": insurerID,
                    "insuree_id": "{{ $insuree->patient_id }}",
                    "status": status,
                    "comments": comments,
                    "type": type,
                    "id": id,
                },
                success: function(response) {
                    $('#modal-update-insurance').modal('hide');

                }
            });
            return false;
        }

        function saveInsurance() {

            var insuranceID = document.getElementById("update-insurance_id").value;
            var insurerID = document.getElementById("update-insurer-id").value;
            var groupNumber = document.getElementById("update-group-number").value;
            var groupPhoneNumber = document.getElementById("update-insurer-phone-number").value;
            var type = document.getElementById("update-insurance-type").value;
            var status = document.getElementById("update-insurance-status").value;
            var comments = document.getElementById("update-insurance-comments").value;
            var id = document.getElementById("update-insurance").value;
            if (insuranceID.length < 1) {
                return;
            } else {
                updateInsurance(insuranceID, insurerID, groupNumber, groupPhoneNumber, type, status, comments, id);
            }

        }

    </script>

@endpush
