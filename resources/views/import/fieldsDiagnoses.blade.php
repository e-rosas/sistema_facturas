<form class="form-horizontal" method="POST" action="{{ route('import.process.diagnoses') }}">
    {{ csrf_field() }}
    <h1>Diagnoses {{ $count }}</h1>
    <table class="table">
        @foreach ($diagnoses as $row)
            <tr>
                <td>{{ $row->code }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->nombre }}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>