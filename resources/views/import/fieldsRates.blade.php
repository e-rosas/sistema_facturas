<form class="form-horizontal" method="POST" action="{{ route('import.process.rates') }}">
    {{ csrf_field() }}
    <h1>Rates {{ $count }}</h1>
    <table class="table">
        @foreach ($rates as $row)
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