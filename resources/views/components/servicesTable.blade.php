{{-- Table of services --}}
<div  class="table-responsive">
    <table id="services_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha (de)</th>
                <th scope="col">Fecha (a)</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diagnoses_services as $diagnoses)
                @foreach ($diagnoses->services as $service)
                    <tr> 
                        <td><a  href="{{ route('services.show', $service->service) }}">{{ $service->service->code }}</a></td>
                        <td>{{ $service->description}}</td>
                        <td>{{ $service->DOS->format('d-m-Y') }}</td>
                        <td>{{ $service->DOS_to->format('d-m-Y') }}</td>
                        <td>{{ $service->discounted_price}}</td>
                        <td>{{ $service->quantity}}</td>
                        <td>{{ $service->total_discounted_price}}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>