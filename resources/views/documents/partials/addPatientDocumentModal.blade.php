<div class="modal fade" id="modal-patient-document" tabindex="-1" role="dialog" aria-labelledby="modal-patient-document"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Subir documento') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            {{--  name  --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="patient-document-name">Nombre</label>
                                <input type="text" name="name" id="patient-document-name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="Nombre">

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{-- Tipo --}}
                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="patient-document-type">Tipo</label>
                                <select id='patient-document-type' class="custom-select" name="tipo">
                                    <option value='0' selected>Formatos</option>
                                    <option value='1'>Beneficios</option>
                                </select>
                            </div>
                            {{--  file --}}
                            <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="patient-document-file">Documento (PDF)</label>
                                <input type="file" name="file" id="patient-document-file"
                                    class="form-control form-control-alternative{{ $errors->has('file') ? ' is-invalid' : '' }}"
                                    required>

                                @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                                @endif
                            </div>


                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="patient-document-comments"
                                        class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                        value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="save_document" class="btn btn-success mt-4">Guardar</button>
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
    function sendDocument(data){
        $.ajax({
            url: "{{route('files.patient')}}",
            dataType: 'json',
            type:"post",
            processData: false, // Don't process the files
            contentType: false,
            data: data,
        success: function (response) {
            DisplayDocuments(response.data);
            $('#modal-patient-document').modal('hide');

            }
        });
        return false;
    }


    $("#save_document").click(function(){

        var name = document.getElementById("patient-document-name").value;


        var comments = document.getElementById("patient-document-comments").value;
        var file = document.getElementById("patient-document-file").files[0];

        if(name != "" && file){
            var type = document.getElementById("patient-document-type").value;
            var file = document.getElementById("patient-document-file").files[0];
            var formData = new FormData();
            formData.append('file', file);
            formData.append('name', name);
            formData.append('type', type);
            formData.append('comments', comments);
            formData.append('name', name);
            var token = "{{ csrf_token() }}";
            var patient =  {{ $patient->id }};
            formData.append('_token', token);
            formData.append('patient_id', patient);
            sendDocument(formData);
        }
        else {
            alert("Falta seleccionar el archivo o darle un nombre.")
        }



    });
</script>

@endpush