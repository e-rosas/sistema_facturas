@extends('layouts.app', ['title' => 'Ubicaciones'])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Ubicaciones</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('locations.create') }}" class="btn btn-sm btn-primary">Registrar</a>
                        </div>
                    </div>
                </div>

                {{-- <form method="get" action="{{ route('locations.index') }}">
                <div class="form-row">
                    <div class="col-md-1 col-auto">
                        <select class="custom-select" name="perPage">
                            <option value='15' {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                            <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                            <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                            <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>Todas</option>
                        </select>
                    </div>
                    <div class="col-md-10 col-auto">
                        <input name="search" class="form-control" type="search" placeholder="Buscar..."
                            value="{{ $search ?? '' }}">
                    </div>
                    <div class="col-md-1 col-auto text-right">
                        <button type="submit" class="btn btn-primary btn-fab btn-icon">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                </form> --}}

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

                <div class="table-responsive" id="locations_table">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Línea 1</th>
                                <th scope="col">Línea 2</th>
                                <th scope="col">Línea 3</th>
                                <th scope="col">Línea 4</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Default</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                            <tr>

                                <td> <a href="{{ route('locations.show', $location) }}"> {{ $location->name }}</a></td>
                                <td>{{ $location->first_line }}</td>
                                <td>{{ $location->second_line }}</td>
                                <td>{{ $location->requiresThirdLine() }}</td>
                                <td>{{ $location->fourth_line }}</td>
                                <td>{{ $location->phone_number }}</td>
                                <td>{{ $location->default ? 'Si' : 'No' }}</td>
                                <td class="td-actions text-right">
                                    {{-- <a class="btn btn-success btn-sm btn-icon" rel="tooltip" type="button"
                                        href="{{ route('locations.show', $location) }}">
                                    <i class="fas fa-eye "></i>
                                    </a> --}}
                                    <a class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                                        href="{{ route('locations.edit', $location) }}">
                                        <i class="fas fa-pencil-alt fa-2"></i>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $locations->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
