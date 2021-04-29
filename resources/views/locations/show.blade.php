@extends('layouts.app', ['title' => __('Ubicación')])

@section('content')
    @include('layouts.headers.header', ['title' => $location->name])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        @include('locations.components.details', ['location' => $location])

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="m-2">
                <form  method="post" onsubmit="return confirm('Confirmar eliminación de ubicación. TODOS LOS COBROS RELACIONADOS SERAN ELIMINADOS.');" action="{{ route('locations.destroy', $location) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">ELIMINAR</button>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-12 col-lg-6">
                <div class="card  mb-4 mb-xl-0">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Cobros</h3>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive" id="invoices-table">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Num. de Cobro') }}</th>
                                    <th scope="col">CONTPAQ</th>
                                    <th scope="col">{{ __('DOS') }}</th>
                                    <th scope="col">{{ __('Estado') }}</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->code }}
                                            </a>
                                        </td>
                                        <td>{{ $invoice->code() }}</td>
                                        <td>{{ $invoice->DOS->format('M-d-Y') }}</td>
                                        <td>{{ $invoice->status() }}</td>
                                        <td><span class="MXN" style="display: none"> {{ $invoice->totalF() }} </span><span
                                                class="USD">
                                                {{ $invoice->totalDiscounted() }} </span></td>
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
    </div>
@endsection
