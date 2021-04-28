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
                    <td>{{ $insurance->insurance->name }}</td>
                    <td>{{ $insurance->type() }}</td>
                    <td>{{ $insurance->group_number }}</td>
                    <td>
                        <div class="custom-control custom-radio mb-3">
                            <input name="insurance-active" class="custom-control-input"
                                {{ $insurance->status == 0 ? 'checked' : '' }} type="radio">
                        </div>
                    </td>
                    <td class="td-actions text-right">
                        <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                            onClick="showEditInsuranceModal({{ $insurance->id }})">
                            <i class="fas fa-pencil-alt fa-2 "></i>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                            onClick="deleteInsurance({{ $insurance->id }})">
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
            for (var i = 0; i < length; i++) {
                bg = insurances[i].status2 == 2 ? "table-success" : "";
                output += "<tr class=" + bg + " value=" + insurances[i].id + ">" +
                    "<td>" + insurances[i].insurance_id + "</td>" +
                    "<td>" + insurances[i].insurer.name + "</td>" +
                    "<td>" + insurances[i].type + "</td>" +
                    "<td>" + insurances[i].group_number + "</td>" +
                    "<td> <div class='custom-control custom-radio mb-3'> <input name='insurance-active' class='custom-control-input'" +
                    insurances[i].active + "type='radio'></div></td>" +
                    '<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="showEditInsuranceModal(\'' +
                    insurances[i].id +
                    '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>' +
                    '<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="deleteInsurance(\'' +
                    insurances[
                        i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>' +
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
            }
        }

        function showEditModal(id) {
            getInsurance(id);
            $('#modal-update-insurance').modal('show')
        }

    </script>
@endpush
