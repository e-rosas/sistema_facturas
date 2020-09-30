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
                <form method="get" action="{{ route('payments.index') }}">
                    <div class="form-row">
                        <div class="col-lg-2 col-auto">
                            <label for="perPage">{{ __('Cantidad') }}</label>
                            <select class="custom-select" name="perPage">
                                <option value='15' {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                                <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                                <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>Todas</option>
                            </select>
                        </div>
                        {{--  start_date  --}}
                        <div class="col-lg-4 col-auto">
                            <label for="start">{{ __('Fecha de') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="start" id="input-start" class="form-control"
                                    value="{{ $start->format('Y-m-d') }}">
                            </div>
                        </div>
                        {{--  end_date  --}}
                        <div class="col-lg-4 col-auto">
                            <label for="end">{{ __('hasta') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="end" id="input-end" class="form-control"
                                    value="{{ $end->format('Y-m-d')  }}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-auto">
                            <br />
                            @include('components.currencySwitch', ['USD' => 1])
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="form-group col-lg-11 col-auto">
                            <input name="search" class="form-control" type="search"
                                placeholder="{{ __('Factura, numero de cobro...') }}" value="{{ $search ?? '' }}">
                        </div>
                        <div class="col-lg-1 col-auto text-right">
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
                                <th scope="col">{{ __('Num. de Cobro') }}</th>
                                <th scope="col">{{ __('Tipo') }}</th>
                                <th scope="col">{{ __('Numero') }}</th>
                                <th scope="col">{{ __('Fecha') }}</th>
                                <th scope="col">{{ __('Cantidad') }}</th>
                                <th scope="col">{{ __('Concepto') }}</th>
                                <th scope="col">{{ __('Metodo') }}</th>
                                {{-- <th scope="col">{{ __('Actions') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr class="{{ $payment->type == 1 ? 'table-info' : '' }}">
                                <td>
                                    <a href="{{ route('invoices.show', $payment->invoice) }}">
                                        {{ $payment->invoice->code}}
                                    </a>
                                </td>
                                <td>{{ $payment->type() }}</td>
                                <td>{{ $payment->number }}</td>
                                <td>{{ $payment->date->format('M-d-Y')}}</td>

                                <td><span class="MXN"> {{ $payment->total() }} </span><span class="USD"
                                        style="display: none"> {{ $payment->amountPaid() }} </span></td>
                                <td>{{ $payment->concept()}}</td>
                                <td>{{ $payment->method()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $payments->appends(['start' =>$start->format('Y-m-d'), 'end' => $end->format('Y-m-d'), 'search'=>$search, 'perPage'=>$perPage])->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
