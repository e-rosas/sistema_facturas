@extends('layouts.app', ['title' => 'Aseguranzas'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Aseguranzas</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary">Registrar aseguranza</a>
                            </div>
                        </div>
                    </div>

                    <form method="get" action="{{ route('insurers.index') }}">
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
                            {{--  refresh  --}}
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Clave</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurers as $insurer)
                                    <tr>
                                        <td>
                                            <a href="{{ route('insurers.show', $insurer) }}">
                                                {{ $insurer->name }}
                                            </a>
                                        </td>
                                        <td>{{ $insurer->code }}</td>
                                        <td>
                                            <a href="mailto:{{ $insurer->email }}">{{ $insurer->email }}</a>
                                        </td>
                                        <td>{{ $insurer->phone_number }}</td>
                                        <td>{{ $insurer->city }}</td>

                                        <td class="td-actions text-right">
                                            <a href="{{ route('insurers.show', $insurer) }}" rel="tooltip"  class="btn btn-success btn-sm btn-icon"  type="button">
                                                    <i class="fas fa-eye "></i>
                                            </a>
                                            <button class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" onClick="showEditModal({{ $insurer->id }})">
                                                    <i class="fas fa-pencil-alt fa-2"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $insurers->appends(['search'=>$search, 'perPage'=>$perPage])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('insurers.partials.editModal')
        @include('layouts.footers.auth')
    </div>
@endsection
