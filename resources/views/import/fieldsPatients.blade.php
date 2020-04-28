<form class="form-horizontal" method="POST" action="{{ route('import.process.patients') }}">
    {{ csrf_field() }}
    <h1>Patients {{ $count }}</h1>
    <table class="table">
        @foreach ($patients as $row)
            <tr>
            @foreach ($row as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>