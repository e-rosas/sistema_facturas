@extends('layouts.app', ['title' => __('Service')])

@section('content')
    @include('layouts.headers.header', ['title' => $diagnosis->name, 'description' => $diagnosis->code])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Facturas') }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ count($diagnosis->invoices)  }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Facturas') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-primary">{{ __('Registrar') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('invoices.partials.smallTable', ['invoices' => $diagnosis->invoices])

                </div>
            </div>
        </div>
    </div>
@endsection
