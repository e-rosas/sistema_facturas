<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Nombre') }}</th>
                <th scope="col">{{ __('Teléfono') }}</th>
                <th scope="col">{{ __('Fecha de nacimiento') }}</th>
                <th scope="col">{{ __('Relación') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dependents as $dependent)
                <tr>
                    <td> <a href="{{ route('patients.show', $dependent->patient) }}">{{ $dependent->patient->full_name }}</a> </td>
                    <td>{{ $dependent->patient->phone_number }}</td>
                    <td>{{ $dependent->patient->birth_date->format('d-m-Y')  }}</td>
                    <td>{{ $dependent->relationship() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    
</div>

