<form class="form-horizontal" method="POST">
    {{ csrf_field() }}
    <h1>Letters {{ $count }}</h1>
    <table class="table">

    </table>
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>
