@extends('layouts.app', ['title' => 'Facturas'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="card-title">Facturas</h3>
                        <div class="row align-items-center">
                            <div class="col-md-11">
                                <!-- Search form -->
                                <form  method="post" action="{{ route('invoices.search') }}" >
                                    @csrf                                 
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <select id='type' class="custom-select" name="type"> 
                                                <option value='3'>Todas</option>
                                                <option value='0'>Nota de crédito.</option>
                                                <option value='1'>Un solo pago completo.</option>
                                                <option value='2'>Pendiente de pago.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select id='status' class="custom-select" name="status"> 
                                                <option value='5'>Todas</option>
                                                <option value='0'>Nota de crédito pendiente.</option>
                                                <option value='1'>Completada.</option>
                                                <option value='2'>Pendiente de pago.</option>
                                                <option value='3'>Pendiente de asignar productos.</option>
                                                <option value='4'>Pendiente de facturar.</option>
                                                <option value='5'>Aseguranza no pagará.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-auto">
                                            <input name="search" class="form-control" type="text" placeholder="Buscar" aria-label="Search"> 
                                        </div> 
                                        <div class="col-md-1">
                                            <button class="btn btn-primary btn-fab btn-icon">
                                                <i class="fas fa-search"></i>
                                              </button>
                                        </div>                  
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-1 text-right">
                                <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-primary">Registrar</a>
                            </div>
                        </div>
                    </div>

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
