<div class="modal fade" id="edit-document-modal" tabindex="-1" role="dialog" aria-labelledby="edit-document-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">Editar documento</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <input type="hidden" id="update-document-id">
                        <div class="form-group">
                            {{--  name  --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="update-document-name">Nombre</label>
                                <input type="text" name="name" id="update-document-name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nombre') }}" required>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="update-document-comments"
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
                                <button id="update-document" class="btn btn-success mt-4">Guardar</button>
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
    function showEditDocumentModal(id) {
        getDocument(id);
        $('#edit-document-modal').modal('show')
    }

    function getDocument(id) {
        $.ajax({
            url: "{{route('files.invoice.find')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "document_id": id
            },
            success: function (response) {
                displayDocumentModal(response.data.id, response.data.name,
                    response.data.comments);
            }
        });
        return false;
    }

    function displayDocumentModal(document_id, name, comments) {
        document.getElementById("update-document-id").value = document_id;
        document.getElementById("update-document-name").value = name;
        document.getElementById("update-document-comments").value = comments;

    }

    function updateDocument(id, name, comments) {
        $.ajax({
            url: "{{route('files.invoice.update')}}",
            dataType: 'json',
            type: "patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "document_id": id,
                "name": name,
                "comments": comments,
            },
            success: function (response) {
                DisplayDocuments(response.data);
                $('#edit-document-modal').modal('hide')

            }
        });
        return false;
    }



    $(document).ready(function () {
        $("#update-document").click(function () {
            var document_id = document.getElementById("update-document-id").value;
            var name = document.getElementById("update-document-name").value;
            console.log(name);

            if (name != "") {

                var comments = document.getElementById("update-document-comments").value;

                updateDocument(document_id, name, comments);
            }

        });
    });

</script>

@endpush
