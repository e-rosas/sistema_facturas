@extends('layouts.app', ['title' => __('Service')])

@section('content')
    @include('layouts.headers.header', ['title' => $service->description, 'description' => $service->code])

    <div class="container-fluid mt--7">
        <div class="row"> 
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['title' => 'Price', 'value' => $service->price])
                @include('components.invoiceStatsCard', ['title' => 'Discounted price', 'value' => $service->discounted_price])
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">        
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Categoria') }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $service->category->name  }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                    <i class="fas fa-cube"></i>
                                </div>
                            </div>
                        </div>
            
                    </div> 
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">        
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Facturas') }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ count($service->invoices)  }}</span>
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
                    @include('services.partials.invoicesTable', ['invoices' => $service->invoices])
                    
                </div>
            </div>
        </div>  
    </div>
@endsection