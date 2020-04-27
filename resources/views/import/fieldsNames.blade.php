<form class="form-horizontal" method="POST" action="{{ route('import.process.names') }}">
    {{ csrf_field() }}
    <h1>Names {{ $count }}</h1>
    <table class="table">
        @foreach ($names as $row)
            <tr>
            <td>{{ $row }}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>