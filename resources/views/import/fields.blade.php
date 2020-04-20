<form class="form-horizontal" method="POST" action="{{ route('import.process.items') }}">
    {{ csrf_field() }}
    <h1>Count: {{ $test }}</h1>
    <table class="table">
        @foreach ($csv_data as $row)
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