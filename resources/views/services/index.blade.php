@extends('layouts.app', ['title' => 'Servicios'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Servicios</h3>
                            </div>
                            <div class="col-6 text-right">
                                <div class="dropdown">
                                    <a class="btn  btn-success btn-sm" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Exportar
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form target="_blank" method="post" action="{{ route('services.export') }}">
                                            @csrf
                                            <input type="hidden" name="language" value="E">
                                            <button type="submit" class="dropdown-item">Inglés</button>
                                        </form>
                                        <form target="_blank" method="post" action="{{ route('services.export') }}">
                                            @csrf
                                            <input type="hidden" name="language" value="S">

                                            <button type="submit" class="dropdown-item">Español</button>

                                        </form>

                                    </div>
                                </div>
                                <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">Registrar</a>
                            </div>
                        </div>
                    </div>

                    <form method="get" action="{{ route('services.index') }}">
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
                            {{-- refresh --}}
                            <div class="col-md-1 col-auto text-right">
                                <button type="submit" class="btn btn-primary btn-fab btn-icon">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
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

                    <div class="table-responsive" id="services_table">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descuento</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td data-container="body" data-toggle="tooltip" data-placement="bottom"
                                            title="{{ $service->clave() }}">{{ $service->code }}</td>
                                        <td data-container="body" data-toggle="tooltip" data-placement="bottom"
                                            title="{{ $service->description }}">{{ $service->descripcion }}</td>

                                        <td>{{ $service->price() }}</td>
                                        <td>{{ $service->discountedPrice() }}</td>
                                        <td>{{ $service->category->nombre }}</td>
                                        <td class="td-actions text-right">
                                            <a class="btn btn-success btn-sm btn-icon" rel="tooltip" type="button"
                                                href="{{ route('services.show', $service) }}">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                                                href="{{ route('services.edit', $service) }}">
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
                            {{ $services->appends(['search' => $search, 'perPage' => $perPage])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
