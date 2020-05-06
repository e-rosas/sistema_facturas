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
                                <div class="dropdown">
                                    <a class="btn  btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Registrar paciente
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            {{--  <form action="{{ route('beneficiary.destroy', $beneficiary) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                                <a class="dropdown-item" href="{{ route('beneficiary.edit', $beneficiary) }}">{{ __('Edit') }}</a>
                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this beneficiary?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>   --}}  
                                            <form method="GET" action="{{ route('patients.create') }}">
                                                <input type="hidden" name="insuree" value="0">
                                                <button type="submit" class="dropdown-item">Dependiente</button>
                                            </form>
                                            <form method="GET" action="{{ route('patients.create') }}">
                                                <input type="hidden" name="insuree" value="1">
                                                <button type="submit" class="dropdown-item">Asegurado</button>
                                            </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <form  method="get" action="{{ route('patients.index') }}" >
                        <div class="form-row">
                            <div class="col-md-1 col-auto">
                                <select  class="custom-select" name="perPage"> 
                                    <option value='15' {{ $perPage == 15 ? 'selected' : '' }} >15</option>
                                    <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                                    <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                    <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                    <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                                    <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>Todas</option>
                                </select>
                            </div>
                            <div class="col-md-10 col-auto">
                                <input name="search" class="form-control" type="search"  placeholder="Buscar..." value="{{ $search ?? '' }}">
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
                    {{--  Table  --}}
                    <div class="table-responsive" id="patients-table">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">NSS</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">ID de Aseguranza</th>
                                    <th scope="col">Aseguranza</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurees as $insuree)
                                    <tr>
                                        <td> <a href="{{ route('patients.show', $insuree->patient) }}">{{ $insuree->patient->full_name }}</a></td>
                                        <td>{{ $insuree->nss }}</td>
                                        <td>{{ $insuree->patient->phone_number }}</td>
                                        <td>{{ $insuree->patient->city }}</td>
                                        <td>{{ $insuree->insurance_id }}</td>
                                        <td>
                                            <a href="{{ route('insurers.show', $insuree->insurer) }}">
                                                {{ $insuree->insurer->name }}
                                            </a>
                                        </td>
                                        <td class="td-actions text-right">

                                            <a class="btn btn-success btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.show', $insuree->patient) }}">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.edit', $insuree->patient) }}">
                                                <i class="fas fa-pencil-alt fa-2"></i>
                                            </a> 
                                            
                                        </td>
                                    </tr>
                                    @foreach ($insuree->dependents as $dependent)
                                    <tr class="table-info">
                                        <td> <a href="{{ route('patients.show', $dependent->patient) }}">{{ $dependent->patient->full_name }}</a> </td>
                                        <td>
                                            <a href="mailto:{{$dependent->patient->email}}">{{$dependent->patient->email}}</a>
                                        </td>
                                        <td>{{ $dependent->patient->phone_number }}</td>
                                        <td>{{ $dependent->patient->city }}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="td-actions text-right">
                                            <a class="btn btn-success btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.show', $dependent->patient) }}">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" href="{{ route('patients.edit', $dependent->patient) }}">
                                                <i class="fas fa-pencil-alt fa-2"></i>
                                            </a> 
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $insurees->appends(['search'=>$search, 'perPage'=>$perPage])->links() }}
                        </nav>
                    </div>
                      
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection