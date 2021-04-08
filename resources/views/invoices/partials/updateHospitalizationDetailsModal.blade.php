<div class="modal fade" id="modal-hospitalization-details" tabindex="-1" role="dialog" aria-labelledby="modal-hospitalization-details"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h4 class="heading-small text-muted mb-4">{{ __('Detalles hospitalización') }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="form-row">
                                 {{--  bill_type --}}
                                 <div class="col-md-12 col-auto form-group">
                                    <label class="form-control-label" for="input-bill_type">Tipo (Código)</label>
                                    <input type="text" name="input-bill_type" id="input-bill_type"
                                        class="form-control form-control-alternative" value="{{ $hospitalization->bill_type }}">
                                </div>
                            </div>
                            <div class="form-row">
                               <div class="col-md-12">
                                   <label class="form-control-label" for="input-diagnosis_codes">Procedimientos (Código-Fecha)</label>
                                   <input type="text" name="input-diagnosis_codes" id="input-diagnosis_codes"
                                       class="form-control form-control-alternative" value="{{ $hospitalization->diagnosis_codes }}">
                               </div>
                           </div>
                            <div class="form-row ">
                                <div class="col-lg-12 custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="input-breakdown" id="input-breakdown"
                                        class="custom-control-input" {{ $hospitalization->breakdown ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="input-breakdown">Desglose</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button onclick="saveHospitalizationDetails()" id="save-hospitalization-details"
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
    function sendHospitalizationDetails(breakdown, bill_type, diagnosis_codes){
        $.ajax({
            url: "{{route('invoices.hospitalizationDetails')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {{ $hospitalization->invoice_id }},
                "breakdown": breakdown,
                "diagnosis_codes": diagnosis_codes,
                "bill_type": bill_type
            },
        success: function (response) {
            displayHospitalizationDetails(response.data);
            //displayStats();
            $('#modal-hospitalization-details').modal('hide');

            }
        });
            return false;
    }

    function displayHospitalizationDetails(data){
        var details = data;
        console.log(details);
        document.getElementById("breakdown").innerHTML = details.breakdown == 1 ? 'Si' : 'No';
        document.getElementById("bill_type").innerHTML = details.bill_type;
        document.getElementById("diagnosis_codes").innerHTML = details.diagnosis_codes;

    }

    function saveHospitalizationDetails(){
        breakdown = document.getElementById("input-breakdown").checked ? 1 : 0;
        bill_type = document.getElementById("input-bill_type").value;
        diagnosis_codes = document.getElementById("input-diagnosis_codes").value;
        sendHospitalizationDetails(breakdown, bill_type, diagnosis_codes);
    }
</script>

@endpush
