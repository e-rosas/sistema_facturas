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
                <th scope="col">Cantidad</th>
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
                <td>{{ $service->quantity}}</td>
                <td><span class="MXN" style="display: none">
                        {{ $service->totalDiscountedPriceMXN($invoice->exchange_rate) }} </span><span class="USD">
                        {{ $service->totalDiscountedPrice() }} </span> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
