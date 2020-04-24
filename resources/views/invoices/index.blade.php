@extends('layouts.app', ['title' => 'Facturas'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <h3 class="card-title">Facturas</h3>
                            <div class="col-11 text-right">
                                <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-primary">Registrar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Search form -->
                                <form  method="get" action="{{ route('invoices.index') }}" >                              
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
                                        <div class="col-md-3">
                                            <select id='type' class="custom-select" name="type"> 
                                                <option value='3'  {{ $type == 3 ? 'selected' : '' }} >Todas</option>
                                                <option value='0'  {{ $type == 0 ? 'selected' : '' }}>Nota de crédito.</option>
                                                <option value='1'  {{ $type == 1 ? 'selected' : '' }}>Un solo pago completo.</option>
                                                <option value='2'  {{ $type == 2 ? 'selected' : '' }}>Pendiente de pago.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select id='status' class="custom-select" name="status"> 
                                                <option value='6'  {{ $status == 6 ? 'selected' : '' }}>Todas</option>
                                                <option value='0' {{ $status == 0 ? 'selected' : '' }}>Nota de crédito pendiente.</option>
                                                <option value='1' {{ $status == 1 ? 'selected' : '' }}>Completada.</option>
                                                <option value='2' {{ $status == 2 ? 'selected' : '' }}>Pendiente de pago.</option>
                                                <option value='3' {{ $status == 3 ? 'selected' : '' }}>Pendiente de asignar productos.</option>
                                                <option value='4' {{ $status == 4 ? 'selected' : '' }}>Pendiente de facturar.</option>
                                                <option value='5' {{ $status == 5 ? 'selected' : '' }}>Aseguranza no pagará.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5 col-auto">
                                            <input name="search" value="{{ $search ?? '' }}" class="form-control" type="text" placeholder="Buscar" aria-label="Search"> 
                                        </div> 
                                        <div class="col-md-1">
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

                    @include('invoices.partials.table')
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
