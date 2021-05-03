<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Nombre') }}</th>
                <th scope="col">{{ __('Teléfono') }}</th>
                <th scope="col">{{ __('Fecha de nacimiento') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td> <a href="{{ route('patients.show', $patient) }}">{{ $patient->full_name }}</a> </td>
                    <td>{{ $patient->phone_number }}</td>
                    <td>{{ $patient->birth_date->format('d-m-Y')  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

