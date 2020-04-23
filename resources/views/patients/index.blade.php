@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Pacientes</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">Registrar paciente</a>
                            </div>
                        </div>
                    </div>

                    <form  method="post" action="{{ route('patients.search') }}" >
                        @csrf
                        <div class="form-group col-md-12 col-auto">
                            <label for="example-search-input" class="form-control-label">Buscar</label>
                            <input name="search" class="form-control" type="search" required placeholder="Buscar pacientes..." id="search">
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
                    {{--  Table  --}}
                    <div class="table-responsive" id="patients-table">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">ID de Aseguranza</th>
                                    <th scope="col">Aseguranza</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->full_name }}</td>
                                        <td>
                                            <a href="mailto:{{$patient->email}}">{{$patient->email}}</a>
                                        </td>
                                        <td>{{ $patient->phone_number }}</td>
                                        <td>{{ $patient->city }}</td>
                                        <td>{{ $patient->insurance_id }}</td>
                                        <td>{{ $patient->insurer->name }}</td>
                                        <td class="td-actions text-right">

                                            <a class="btn btn-success btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.show', $patient) }}">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.edit', $patient) }}">
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
                            {{ $patients->links() }}
                        </nav>
                    </div>
                      
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection