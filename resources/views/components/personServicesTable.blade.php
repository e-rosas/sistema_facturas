{{-- Table of services --}}
<div  class="table-responsive">
    <table id="services_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Description') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Total') }}</th>
                <th scope="col">{{ __('Total Discounted') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->description}}</td>
                    <td>{{ $service->created_at->format('M-d-Y') }}</td>
                    <td>{{ $service->total_price}}</td>
                    <td>{{ $service->total_discounted_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
