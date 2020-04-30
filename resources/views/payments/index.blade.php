@extends('layouts.app', ['title' => 'Pagos'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Pagos</h3>
                            </div>
                            
                        </div>
                    </div>
                    <form  method="get" action="{{ route('payments.index') }}" >
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No. de Pago</th>
                                    <th scope="col">Factura</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Metodo</th>
                                    {{-- <th scope="col">{{ __('Actions') }}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->number}}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $payment->invoice) }}">
                                                {{ $payment->invoice->number}}
                                            </a>
                                        </td>
                                        <td>{{ $payment->date->format('d-m-Y')}}</td>

                                        <td>{{ $payment->amount_paid }}</td>
                                        <td>{{ $payment->concept()}}</td>
                                        <td>{{ $payment->method()}}</td>
                                        {{-- <td class="td-actions text-right">
                                            <button class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" onClick="showEditModal({{ $payment->id }})">
                                                    <i class="fas fa-pencil-alt fa-2 "></i>
                                            </button>
                                            <button rel="tooltip" class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete({{ $payment->id }})">
                                                    <i class="fa fa-trash"></i>
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $payments->appends(['search'=>$search, 'perPage'=>$perPage])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection