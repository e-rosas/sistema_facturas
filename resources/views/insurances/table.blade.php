{{-- Table of insurances --}}
<div class="table-responsive">
    <table id="insurances-table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('ID Aseguranza') }}</th>
                <th scope="col">{{ __('Aseguranza') }}</th>
                <th scope="col">{{ __('Tipo') }}</th>
                <th scope="col">{{ __('Grupo') }}</th>
                <th scope="col">{{ __('Activa') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $insurance)
                <tr class="{{ $insurance->status == 0 ? 'table-success' : '' }}">
                    <td>{{ $insurance->insurance_id }}</td>
                    <td>{{ $insurance->insurer->name }}</td>
                    <td>{{ $insurance->type() }}</td>
                    <td>{{ $insurance->group_number }}</td>
                    <td>
                        <div class="custom-control custom-radio mb-3">
                            <input name="insurance-active" class="custom-control-input"
                                {{ $insurance->status == 0 ? ' checked disabled' : '' }} id="insurance-active-{{ $insurance->id }}" type="radio" onchange="selectInsurance({{ $insurance->id }})">
                            <label class="custom-control-label" for="insurance-active-{{ $insurance->id }}"></label>
                        </div>
                    </td>
                    <td class="td-actions text-right">
                        <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                            onClick="getInsurance({{ $insurance->id }})">
                            <i class="fas fa-pencil-alt fa-2 "></i>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                            onClick="deleteInsurance({{ $insurance->id }})" {{ $insurance->status == 0 ? ' disabled' : '' }}>
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('insurances.editInsuranceModal')
@push('js')
    <script>
        function displayInsurances(data) {
            var insurances = data;
            var output = "";
            var bg = "";
            var length = insurances.length;
            var disabled = "";
            for (var i = 0; i < length; i++) {
                disabled = insurances[i].status2 == 0 ? "disabled" : "";
                bg = insurances[i].status2 == 0 ? "table-success" : "";
                output += "<tr class="+bg+" value=" + insurances[i].id+">" +
                    "<td>" + insurances[i].insurance_id + "</td>" +
                    "<td>" + insurances[i].insurer + "</td>" +
                    "<td>" + insurances[i].type + "</td>" +
                    "<td>" + insurances[i].group_number + "</td>" +
                    '<td> <div class="custom-control custom-radio mb-3"> <input name="insurance-active" class="custom-control-input"' +
                    insurances[i].active + ' type="radio" id=insurance-active-\'' +insurances[i].id + '\' onChange="selectInsurance(\'' +
                    insurances[i].id +
                    '\')"'+ disabled +'><label class="custom-control-label" for="insurance-active-\'' +insurances[i].id + '\'"> </label></div></td>' +
                    '<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="getInsurance(\'' +
                    insurances[i].id +
                    '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>' +
                    '<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="deleteInsurance(\'' +
                    insurances[
                        i].id + '\')"'+ disabled +'><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>' +
                    "</tr>";
            }
            $('#insurances-table tbody').html(output);
        }

        function deleteInsurance(id) {
            var r = confirm("Eliminar la aseguranza?");
            if (r) {
                $.ajax({
                    url: "{{ route('insurances.destroy') }}",
                    dataType: 'json',
                    type: "delete",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        displayInsurances(response.data);
                    }
                });
                return false;
            } 
        }

        function selectInsurance(id) {
            var previousSelected =  $("input[name=insurance-active]:checked");
            var r = confirm("Activar la aseguranza?");
            if (r) {
                $.ajax({
                    url: "{{ route('insurances.select') }}",
                    dataType: 'json',
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        displayInsurances(response.data);
                    }
                });
                return false;
            }else {
               
                previousSelected.checked = true;
                document.getElementById("insurance-active-"+id).checked = false;
                return false;
            }
        }

        function showEditModal(id) {
            getInsurance(id);
            $('#modal-update-insurance').modal('show')
        }

    </script>
@endpush
