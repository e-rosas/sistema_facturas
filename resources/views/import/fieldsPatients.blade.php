<form class="form-horizontal" method="POST" action="{{ route('import.process.patients') }}">
    {{ csrf_field() }}
    <h1>Patients {{ $count}}</h1>
    {{-- <table class="table">
        @foreach ($patients as $row)
            <tr>
                <td>{{ $row }}</td>
            </tr>
        @endforeach
    </table> --}}
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">NSS</th>
                <th scope="col">Calle</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Genero</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->last_name }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->nss }}</td>
                    <td>{{ $patient->street }}</td>
                    <td>{{ $patient->phone_number }}</td>
                    <td>{{ $patient->gender() }}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>