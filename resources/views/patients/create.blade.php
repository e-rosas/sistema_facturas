@extends('layouts.app', ['title' => __('Insuree Management')])

@section('content')
    @include('layouts.headers.header', ['title' => __('Add Insuree')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-insurers-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Insuree Management') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('insurees.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="{{ route('persondata.storeinsuree') }}" autocomplete="off">
                            @csrf
                            @component('components.register',['beneficiary'=>'0'])
                                
                            @endcomponent
                        <div class="form-inline">
                            <div class="form-group col-md-6 col-auto">
                                <label for="insurer_id" class="col-auto col-form-label">{{ __('Insurer') }}</label>
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
                                <label for="insurance_id" class="col-auto col-form-label">{{ __('Insurance ID') }}</label>
                                <input type="text" name="insurance_id" id="input-insurance_id" class="form-control form-control-alternative{{ $errors->has('insurance_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Insurance ID') }}" value="{{ old('insurance_id') }}" required>                 
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurance_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-auto text-right">
                                <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insurer') }}</a>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('Save') }}</button>
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