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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Folio</th>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">IVA</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->code()}}
                                            </a>
                                        </td>
                                        <td>{{ $invoice->patient->full_name }}</td>
                                        <td>{{ $invoice->date->format('d-m-Y') }}</td>
                                        <td>{{ $invoice->subtotal }}</td>
                                        <td>{{ $invoice->IVA_applied }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        {{--  <form action="{{ route('invoice.destroy', $invoice) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a class="dropdown-item" href="{{ route('invoice.edit', $invoice) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this invoice?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    --}}
                                                        <a class="dropdown-item" href="{{ route('invoices.show', $invoice) }}">Ver</a>
                                                        <a class="dropdown-item" href="{{ route('invoices.edit', $invoice) }}">Editar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $invoices->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
