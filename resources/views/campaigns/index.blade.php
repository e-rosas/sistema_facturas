@extends('layouts.app', ['title' => 'Campañas'])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">

    <div class="form-row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-0">{{ __('Campañas') }}</h3>
                        </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('campaigns.create') }}" class="btn btn-sm btn-primary">Agregar nueva
                            campaña</a>
                    </div>
                </div>
            </div>

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
            <div class="table-responsive" id="campaigns_table">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha de inicio</th>
                            <th scope="col">Hasta</th>
                            <th scope="col">Comentarios</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaigns as $campaign)
                        <tr>
                            <td>
                                <a href="{{ route('campaigns.show', $campaign) }}">
                                    {{ $campaign->name}}
                                </a>
                            </td>
                            <td>{{ $campaign->date->format('Y-M-d') }}</td>
                            <td>{{ $campaign->to_date->format('Y-M-d') }}</td>
                            <td>{{ $campaign->comments }}</td>
                            <td class="text-right">
                                <a class="btn btn-icon btn-info btn-sm" type="button"
                                    href="{{route('campaigns.edit', $campaign)}}">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-pencil-alt fa-2"></i>
                                    </span>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $campaigns->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@include('layouts.footers.auth')
</div>
@endsection
