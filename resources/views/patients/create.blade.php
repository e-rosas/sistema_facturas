@extends('layouts.app', ['title' => Pacientes])

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
                                <a href="{{ route('insurees.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="{{ route('patients.store') }}" autocomplete="off">
                            @csrf
                            @include('patients.partials.register')
                        <div class="form-inline">
                            <div class="form-group col-md-6 col-auto">
                                <label for="insurer_id" class="col-auto col-form-label">Aseguranza</label>
                                <select class="custom-select form-control{{ $errors->has('insurer_id') ? ' is-invalid' : '' }}" name="insurer_id">
                                @foreach($insurers as $insurer)
                                    <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                @endforeach
                                </select>                  
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-auto">
                                <label for="insurance_id" class="col-auto col-form-label">ID Aseguranza</label>
                                <input type="text" name="insurance_id" id="input-insurance_id" class="form-control form-control-alternative{{ $errors->has('insurance_id') ? ' is-invalid' : '' }}" placeholder="ID Aseguranza" value="{{ old('insurance_id') }}" required>                 
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurance_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- <div class="form-group col-auto text-right">
                                <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insurer') }}</a>
                            </div> --}}
                        </div>
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