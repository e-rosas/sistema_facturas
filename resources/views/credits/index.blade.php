@extends('layouts.app', ['title' => 'Notas de crédito'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Notas de crédito</h3>
                            </div>
                        </div>
                    </div>

                    <form  method="get" action="{{ route('credits.index') }}" >
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
                            <div class="form-group col-md-10 col-auto">
                                <input name="search" class="form-control" type="search"  placeholder="Buscar..." value="{{ $search ?? '' }}">
                            </div>
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
                    {{-- <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('credit.destroy', $credit) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('credit.edit', $credit) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this credit?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form> 
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td> --}}
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Número</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Factura</th>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Cambio</th>
                                    <th scope="col">Observaciones</th>                                    
                                    {{-- <th scope="col"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($credits as $credit)
                                    <tr>
                                        <td>{{ $credit->number}}</td>                                              
                                        <td>{{ $credit->date->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $credit->invoice) }}">
                                                {{ $credit->invoice->code}}
                                            </a>
                                        </td>
                                        <td>{{ $credit->concept() }}</td>
                                        <td>{{ $credit->amount_due }}</td>
                                        <td>{{ $credit->exchange_rate }}</td>
                                        <td>{{ $credit->comments  }}</td>
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $credits->appends(['search'=>$search, 'perPage'=>$perPage])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection
