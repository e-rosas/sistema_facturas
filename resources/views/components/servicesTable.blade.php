{{-- Table of services --}}
<div class="table-responsive">
    <table id="services_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Descripción</th>
                <th scope="col">Diagnósticos</th>
                <th scope="col">Fecha (de)</th>
                <th scope="col">Fecha (a)</th>
                <th scope="col">Precio</th>
                @if ($invoice->dental)
                <th scope="col">Dental</th>
                @else
                <th scope="col">Cantidad</th>
                @endif

                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->services2 as $service)
            <tr>
                <td><a href="{{ route('services.show', $service->service) }}">{{ $service->service->code }}</a></td>
                <td>{{ $service->description}}</td>
                <td>{{ $service->diagnoses_pointers}}</td>
                <td>{{ $service->DOS->format('M-d-Y') }}</td>
                <td>{{ $service->DOS_to->format('M-d-Y') }}</td>
                <td><span class="MXN" style="display: none"> {{ $service->totalPriceMXN($invoice->exchange_rate) }}
                    </span><span class="USD"> {{ $service->totalPrice() }} </span> </td>
                @if ($invoice->dental)
                <td><button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                        onClick="showDentalService({{ $service->id }}, '{{ $service->description }}')">
                        <i class="fas fa-eye"></i>
                    </button></td>
                @else
                <td>{{ $service->quantity}}</td>
                @endif
                <td><span class="MXN" style="display: none">
                        {{ $service->totalDiscountedPriceMXN($invoice->exchange_rate) }} </span><span class="USD">
                        {{ $service->totalDiscountedPrice() }} </span> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('js')
<script>
    function showDentalService(id, desc) {
        $.ajax({
            url: "{{route('dental.service')}}",
            dataType: 'json',
            type: "post",
            data: {
            "_token": "{{ csrf_token() }}",
            "diagnosis_service_id": id
            },
            success: function (response) {
                document.getElementById("modal-dental-service-description").innerHTML = desc;

                document.getElementById("modal-dental-service-oral-cavity").innerHTML = response.oral_cavity;
                document.getElementById("modal-dental-service-tooth-system").innerHTML = response.tooth_system;
                document.getElementById("modal-dental-service-tooth-surfaces").innerHTML = response.tooth_surfaces;
                document.getElementById("modal-dental-service-tooth-numbers").innerHTML = response.tooth_numbers;
                $('#modal-dental-service').modal('show')
            }
        });
        return false;
    }
</script>
@endpush
