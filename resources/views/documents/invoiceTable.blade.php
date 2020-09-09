{{-- Table of documents --}}
<div class="table-responsive">
    <table id="documents_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Nombre') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
            <tr>
                <td>{{ $document->name}}</td>
                <td>{{ $document->created_at->format('M-d-Y')}}</td>
                <td>{{ $document->comments}}</td>
                <td class="td-actions text-right">
                    <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                        onClick="showEditModal({{ $document->id }})">
                        <i class="fas fa-pencil-alt fa-2 "></i>
                    </button>
                    <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                        onClick="Delete({{ $document->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('documents.partials.editModal')
@push('js')
<script>
    function DisplayDocuments(data){
        var documents = data;
        var output = "";
        for(var i = 0; i < documents.length; i++){
            output += "<tr>"
                + "<td>" + documents[i].name + "</td>"
                + "<td>" + documents[i].date + "</td>"
                + "<td>" + documents[i].comments + "</td>"
                +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="showEditModal(\'' + documents[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete(\'' + documents[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +  "</tr>";
        }
        $('#documents_table tbody').html(output);
    }
    function Delete(id){
        var r = confirm("Eliminar el documento?");
        if(r){
            $.ajax({
                url: "{{route('files.invoice')}}",
                dataType: 'json',
                type:"delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "document_id" : id
                },
            success: function (response) {
                DisplayDocuments(response.data);
                }
            });
            return false;
        }

    }
</script>
@endpush
