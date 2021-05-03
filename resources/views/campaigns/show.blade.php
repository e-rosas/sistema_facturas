@extends('layouts.app', ['title' =>'Campaña'])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8 col-auto">
                            <h3 class="mb-0">{{ $campaign->name }}</h3>
                        </div>
                        <div class="col-md-4 col-auto">
                            <h5 class="mb-0">{{ $campaign->template }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        {{--  Dates --}}
                        <div class="col-md-6 col-auto ">
                            <label class="form-control-label" for="label-birth">Fecha de inicio</label>
                            <label id="label-date">{{ $campaign->date->format('Y-M-d') }}</label>

                        </div>
                        <div class="col-md-6 col-auto ">
                            <label class="form-control-label" for="label-to_date">Hasta</label>
                            <label id="label-to_date">{{ $campaign->to_date->format('Y-M-d') }}</label>

                        </div>
                    </div>
                    {{--  Comments  --}}
                    <div class="col-md-12 col-auto ">
                        <label class="form-control-label" for="label-comments">Observaciones</label>
                        <label id="label-comments">{{ $campaign->comments }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-auto">
                            <h3 class="mb-0">Correo enviado a</h3>
                        </div>
                        {{-- <div class="col-md-7 text-right">
                            <button type="button" class="btn btn-block btn-success" data-toggle="modal"
                                data-target="#modal-call">Registrar nueva llamada</i></button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    @include('insurances.simpleTable', ['insurances'=>$sentInsurances, 'notSent' =>
                    false])
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-auto">
                            <h3 class="mb-0">Correo no ha sido enviado a</h3>
                        </div>
                        {{-- <div class="col-md-7 text-right">
                                    <button type="button" class="btn btn-block btn-success" data-toggle="modal"
                                        data-target="#modal-call">Registrar nueva llamada</i></button>
                                </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('campaign.send') }}" method="post">
                        @csrf
                        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                        @include('insurances.simpleTable', ['insurances'=>$notSentInsurances, 'notSent' =>
                        true])
                        @if (count($notSentInsurances) > 0)
                        <button type="submit" class="btn btn-success btn-block mt-3">
                            Enviar
                        </button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
