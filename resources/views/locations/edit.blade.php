@extends('layouts.app', ['title' => 'Ubicaciones'])

@section('content')
@include('layouts.headers.header', ['title' => 'Editar ubicación'])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8 col-auto">
                            <h3 class="mb-0">Ubicaciones</h3>
                        </div>
                        <div class="col-4 col-auto text-right">
                            <a href="{{ route('locations.index') }}" class="btn btn-sm btn-primary">Regresar a la
                                lista</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('locations.update', $location) }}" autocomplete="on">
                        @csrf
                        @method('patch')
                        <h6 class="heading-small text-muted mb-4">Datos de la ubicación</h6>
                        <div class="pl-lg-4">
                            <div class="form-row">
                                <div
                                    class="col-md-4 col-auto form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nombre</label>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="Nombre para identificar la ubicación"
                                        value="{{ $location->name }}">

                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('first_line') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-first_line">Línea 1</label>
                                <input type="text" name="first_line" id="input-first_line"
                                    class="form-control form-control-alternative{{ $errors->has('first_line') ? ' is-invalid' : '' }}"
                                    placeholder="Hospital Mexico..." value="{{  $location->first_line }}" required>

                                @if ($errors->has('first_line'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_line') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('second_line') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-second_line">Línea 2</label>
                                <input type="text" name="second_line" id="input-second_line"
                                    class="form-control form-control-alternative{{ $errors->has('second_line') ? ' is-invalid' : '' }}"
                                    placeholder="Calle, número de calle..." value="{{ $location->second_line }}"
                                    required>

                                @if ($errors->has('second_line'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('second_line') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="col-auto form-group{{ $errors->has('third_line') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-third_line">Línea 3 (opcional)</label>
                                    <input type="text" name="third_line" id="input-third_line"
                                        class="form-control form-control-alternative{{ $errors->has('third_line') ? ' is-invalid' : '' }}"
                                        placeholder="Colonia (en caso de falta de espacio)"
                                        value="{{ $location->third_line }}">

                                    @if ($errors->has('third_line'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('third_line') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto form-group{{ $errors->has('fourth_line') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fourth_line">Línea 4</label>
                                    <input type="text" name="fourth_line" id="input-fourth_line"
                                        class="form-control form-control-alternative{{ $errors->has('fourth_line') ? ' is-invalid' : '' }}"
                                        placeholder="Ciudad, estado, C.P." value="{{ $location->fourth_line }}"
                                        required>

                                    @if ($errors->has('fourth_line'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fourth_line') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div
                                    class="col-md-2 col-auto form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone_number">Teléfono
                                        (opcional)</label>
                                    <input type="text" name="phone_number" id="input-phone_number"
                                        class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                        value="{{ $location->phone_number }}">

                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('billing_first_line') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-billing_first_line">Billing Línea 1</label>
                                <input type="text" name="billing_first_line" id="input-billing_first_line"
                                    class="form-control form-control-alternative{{ $errors->has('billing_first_line') ? ' is-invalid' : '' }}"
                                    placeholder="Hospital Mexico..." value="{{  $location->billing_first_line }}"
                                    required>

                                @if ($errors->has('billing_first_line'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('billing_first_line') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('billing_second_line') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-billing_second_line">Billing Línea
                                    2</label>
                                <input type="text" name="billing_second_line" id="input-billing_second_line"
                                    class="form-control form-control-alternative{{ $errors->has('billing_second_line') ? ' is-invalid' : '' }}"
                                    placeholder="Calle, número de calle..." value="{{ $location->billing_second_line }}"
                                    required>

                                @if ($errors->has('billing_second_line'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('billing_second_line') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div
                                    class="col-auto form-group{{ $errors->has('billing_third_line') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-billing_third_line">Billing Línea 3
                                        (opcional)</label>
                                    <input type="text" name="billing_third_line" id="input-billing_third_line"
                                        class="form-control form-control-alternative{{ $errors->has('billing_third_line') ? ' is-invalid' : '' }}"
                                        placeholder="Colonia (en caso de falta de espacio)"
                                        value="{{ $location->billing_third_line }}">

                                    @if ($errors->has('billing_third_line'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('billing_third_line') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div
                                    class="col-auto form-group{{ $errors->has('billing_fourth_line') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-billing_fourth_line">Billing Línea
                                        4</label>
                                    <input type="text" name="billing_fourth_line" id="input-billing_fourth_line"
                                        class="form-control form-control-alternative{{ $errors->has('billing_fourth_line') ? ' is-invalid' : '' }}"
                                        placeholder="Ciudad, estado, C.P." value="{{ $location->billing_fourth_line }}"
                                        required>

                                    @if ($errors->has('billing_fourth_line'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('billing_fourth_line') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                <input type="checkbox" name="default" id="input-default" class="custom-control-input"
                                    {{ $location->default ? 'checked' : '' }}>
                                <label class="custom-control-label" for="input-default">Default</label>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4 btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
