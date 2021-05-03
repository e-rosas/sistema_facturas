@extends('layouts.app', ['title' => 'Correos'])

@section('content')
    @include('components.header')

    <div class="container-fluid mt--7">

        <div class="form-row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h3 class="mb-0">{{ __('Correos') }}</h3>
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
                                    <th scope="col">Aseguranza</th>
                                    <th scope="col">Campaña</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emails as $email)
                                    <tr>
                                        <td>
                                            <a href="{{ route('expedientes.show', $email->expediente) }}">
                                                {{ $email->expediente->full_name }}
                                            </a>
                                        </td>
                                        <td><a href="{{ route('campaigns.show', $email->campaign) }}">
                                                {{ $email->campaign->name }}
                                            </a></td>
                                        <td>{{ $email->date->format('Y-M-d') }}</td>
                                        <td>{{ $email->comments }}</td>
                                        {{-- <td class="text-right">
                            <a class="btn btn-icon btn-info btn-sm" type="button"
                                href="{{route('campaigns.edit', $email)}}">
                        <span class="btn-inner--icon">
                            <i class="fas fa-pencil-alt fa-2"></i>
                        </span>
                        </a>
                        <form method="POST" action="{{ route('campaigns.destroy', $email) }}">
                            @method('DELETE')
                            @csrf
                            <a rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                                href="{{ route('campaigns.destroy', $email) }}">
                                <span class="btn-inner--icon">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </a>
                        </form>

                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $emails->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
