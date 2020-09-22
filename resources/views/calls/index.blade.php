@extends('layouts.app', ['title' => __('Llamadas')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8 col-auto">
                            <h3 class="mb-0">{{ __('Llamadas') }}</h3>
                        </div>

                    </div>
                </div>
                <form method="get" action="{{ route('calls.index') }}">
                    <div class="form-row">
                        <div class="col-lg-2 col-auto">
                            <label for="perPage">{{ __('Cantidad') }}</label>
                            <select class="custom-select" name="perPage">
                                <option value='15' {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                                <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                                <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>{{ __('Todas') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-auto">
                            <label for="status">{{ __('Estado') }}</label>
                            <select id='status' class="custom-select" name="status">
                                <option value='6' {{ $status == 6 ? 'selected' : '' }}>Todas</option>
                                <option value='0' {{ $status == 0 ? 'selected' : '' }}>Nota de crédito pendiente.
                                </option>
                                <option value='1' {{ $status == 1 ? 'selected' : '' }}>Completa.</option>
                                <option value='2' {{ $status == 2 ? 'selected' : '' }}>Pendiente de pago.</option>
                                <option value='3' {{ $status == 3 ? 'selected' : '' }}>Pendiente de asignar productos.
                                </option>
                                <option value='4' {{ $status == 4 ? 'selected' : '' }}>Pendiente de facturar.</option>
                                <option value='5' {{ $status == 5 ? 'selected' : '' }}>Pendiente de revisar.</option>
                            </select>
                        </div>
                        {{--  start_date  --}}
                        <div class="col-lg-3 col-auto">
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
                        <div class="col-lg-3 col-auto">
                            <label for="end">{{ __('hasta') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="end" id="input-end" class="form-control"
                                    value="{{ $end->format('Y-m-d')  }}">
                            </div>
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
                @include('calls.partials.withInvoiceTable', ['invoices' => $invoices])
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $invoices->appends(['start' =>$start->format('Y-m-d'), 'end' => $end->format('Y-m-d'),'search'=>$search, 'perPage'=>$perPage, 'status'=>$status ])->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
