@extends('layouts.app', ['title' =>'Editar campaña'])

@section('content')
@include('layouts.headers.header', ['title' => 'Editar campaña'])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-auto">
                                <h3 class="mb-0">Editar campaña</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <form method="post" action="{{ route('campaigns.update', $campaign) }}" autocomplete="off">
                            @csrf
                            @method('patch')
                            <h6 class="heading-small text-muted mb-4">Datos de la campaña</h6>
                            <div class="pl-lg-4">
                                {{-- Names --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} col-md-8">
                                        <label class="form-control-label" for="input-name">Nombre</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="Nombre" value="{{ $campaign->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('template') ? ' has-danger' : '' }} col-md-4">
                                        <label class="form-control-label" for="input-template">Plantilla</label>
                                        <input type="text" name="template" id="input-template"
                                            class="form-control form-control-alternative{{ $errors->has('template') ? ' is-invalid' : '' }}"
                                            placeholder="Plantilla" value="{{ $campaign->template }}" required autofocus>

                                        @if ($errors->has('template'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('template') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- Birth --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} col-md-6">
                                        <label class="form-control-label" for="input-date">Fecha de inicio</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="date" id="input-date"
                                                class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                type="date" required value="{{ $campaign->date->format('Y-m-d') }}">
                                        </div>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('to_date') ? ' has-danger' : '' }} col-md-6">
                                        <label class="form-control-label" for="input-to_date">Hasta</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="to_date" id="input-to_date"
                                                class="form-control form-control-alternative{{ $errors->has('to_date') ? ' is-invalid' : '' }}"
                                                type="date" required value="{{ $campaign->to_date->format('Y-m-d') }}">
                                        </div>
                                        @if ($errors->has('to_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('to_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }} col-md-12">
                                        <label class="form-control-label" for="input-comments">Observaciones</label>
                                        <input type="text" name="comments" id="input-comments"
                                            class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                            placeholder="Comentarios (opcionales)" value="{{ $campaign->comments }}">

                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
@endsection
