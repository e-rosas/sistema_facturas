<form class="form-horizontal" method="POST" action="{{ route('import.process.items') }}">
    {{ csrf_field() }}
    <h1>Items {{ $test }}</h1>
    <table class="table">
        @foreach ($items as $row)
            <tr>
            @foreach ($row as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            </tr>
        @endforeach
    </table>
    <br />
    <h1>Services {{ $count }}</h1>
    <table class="table">
        @foreach ($services as $row)
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