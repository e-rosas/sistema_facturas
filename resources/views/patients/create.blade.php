@extends('layouts.app', ['title' => 'Pacientes'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Registrar paciente'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-insurers-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Pacientes</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">Regresar a la
                                    lista</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('patients.store') }}" autocomplete="off">
                            @csrf
                            @include('patients.partials.register')
                            @if ($insuree)
                                <div class="form-row">
                                    <input type="hidden" name="insured" value=1>
                                    <div class="form-group col-md-5 col-auto">
                                        <label for="insurer_id" class="col-auto col-form-label">Aseguranza</label>
                                        <select
                                            class="custom-select form-control{{ $errors->has('insurer_id') ? ' is-invalid' : '' }}"
                                            name="insurer_id">
                                            @foreach ($insurers as $insurer)
                                                <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurer_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-auto">
                                        <label for="input-insurance_id" class="col-auto col-form-label">ID
                                            Aseguranza</label>
                                        <input type="text" name="insurance_id" id="input-insurance_id"
                                            class="form-control form-control-alternative{{ $errors->has('insurance_id') ? ' is-invalid' : '' }}"
                                            placeholder="ID Aseguranza" value="{{ old('insurance_id') }}" required>
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurance_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3 col-auto">
                                        <label for="input-group_number" class="col-auto col-form-label">Número de
                                            grupo</label>
                                        <input type="text" name="group_number" id="input-group_number"
                                            class="form-control form-control-alternative{{ $errors->has('group_number') ? ' is-invalid' : '' }}"
                                            placeholder="Número de grupo" value="{{ old('group_number') }}">
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('group_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="insuree_id" value=0>
                                    <input type="hidden" name="relationship" value=-1>
                                </div>
                                <div class="form-row">
                                    <div
                                        class="col-md-4 form-group{{ $errors->has('insurer_phone_number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-insurer_phone_number">Teléfono de grupo
                                            de
                                            aseguranza</label>
                                        <input type="text" name="insurer_phone_number" id="input-insurer_phone_number"
                                            class="form-control form-control-alternative{{ $errors->has('insurer_phone_number') ? ' is-invalid' : '' }}"
                                            placeholder="Teléfono de grupo de aseguranza"
                                            value="{{ old('insurer_phone_number') }}">

                                        @if ($errors->has('insurer_phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurer_phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- Type --}}
                                    <div class="col-md-4 form-group">
                                        <label class="form-control-label" for="insurance-type">Tipo</label>
                                        <select id='insurance-type' class="custom-select" name="type">
                                            <option value='0' selected>Médica</option>
                                            <option value='1'>Dental</option>
                                        </select>
                                    </div>
                                    {{-- Status --}}
                                    <div class="col-md-4 form-group">
                                        <label class="form-control-label" for="insurance-status">Estado</label>
                                        <select id='insurance-status' class="custom-select" name="status">
                                            <option value='0' selected>Activa</option>
                                            <option value='1'>Vencida</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                            </div>
                                            <textarea type="text" rows="3" name="comments" id="insurance-comments"
                                                class="form-control" value="" placeholder="Notas"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-row">
                                    <input type="hidden" name="insured" value=0>
                                    <div class="col-lg-8 form-group">
                                        <label for="insuree_id" class="col-auto col-form-label">Asegurado</label>
                                        @include('components.searchInsurees')
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-control-label" for="input-status">Relación</label>
                                        <select id='input-relationship' class="custom-select" name="relationship">
                                            <option value='2'>Esposo(a)</option>
                                            <option value='1'>Hijo(a)</option>
                                            <option value='0'>Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="insurer_id" value=0>
                                <input type="hidden" name="insurance_id" value=0>
                                <input type="hidden" name="insurer_phone_number" value="">
                            @endif

                            <div class="pl-lg-4">
                                <button type="submit" class="btn btn-success mt-4 btn-block">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
