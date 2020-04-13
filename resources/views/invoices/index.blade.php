@extends('layouts.app', ['title' => 'Facturas'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Facturas</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-primary">Registrar factura</a>
                            </div>
                        </div>
                    </div>

                    <form  method="post" action="{{ route('invoices.search') }}" >
                        @csrf
                        <div class="form-group col-md-12 col-auto">
                            <label for="example-search-input" class="form-control-label">Buscar</label>
                            <input name="search" class="form-control" type="search" required placeholder="Buscar..." id="search">
                        </div>
                    </form>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    @include('invoices.partials.table')
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
