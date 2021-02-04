@extends('layouts.app', ['title' => __('Ubicación')])

@section('content')
@include('layouts.headers.header', ['title' => $location->name])

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    @include('locations.components.details', ['location' => $location])

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
