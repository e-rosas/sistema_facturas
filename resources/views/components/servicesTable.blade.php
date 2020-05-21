{{-- Table of services --}}
<div  class="table-responsive">
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
                {{ $service->discounted_price_mxn =  $service->discounted_price * $invoice->exchange_rate 
                    $service->total_discounted_price_mxn =  $service->total_discounted_price * $invoice->exchange_rate 
                }}
                    <tr> 
                        <td><a  href="{{ route('services.show', $service->service) }}">{{ $service->service->code }}</a></td>
                        <td>{{ $service->description}}</td>
                        <td>{{ $service->diagnoses_pointers}}</td>
                        <td>{{ $service->DOS->format('d-m-Y') }}</td>
                        <td>{{ $service->DOS_to->format('d-m-Y') }}</td>
                        <td><span class="MXN" style="display: none"> {{ $service->totalPrice() }} </span><span class="USD" > {{ $service->totalPriceMXN() }} </span> </td>
                        <td>{{ $service->quantity}}</td>
                        <td><span class="MXN" style="display: none"> {{ $service->totalDiscountedPrice() }} </span><span class="USD" > {{ $service->totalDiscountedPriceMXN() }} </span> </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>