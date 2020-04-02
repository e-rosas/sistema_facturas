{{-- Table of services --}}
<div  class="table-responsive">
    <table id="services_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Code') }}</th>
                <th scope="col">{{ __('Description') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Price') }}</th>
                <th scope="col">{{ __('Discounted Price') }}</th>
                <th scope="col">{{ __('Quantity') }}</th>
                <th scope="col">{{ __('Total Price') }}</th>
                <th scope="col">{{ __('Total Discounted Price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr> 
                    <td><a  href="{{ route('services.show', $service->service) }}">{{ $service->service->code }}</a></td>
                    <td>{{ $service->description}}</td>
                    <td>{{ $service->created_at->format('M-d-Y') }}</td>
                    <td>{{ $service->price}}</td>
                    <td>{{ $service->discounted_price}}</td>
                    <td>{{ $service->quantity}}</td>
                    <td>{{ $service->total_price}}</td>
                    <td>{{ $service->total_discounted_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>