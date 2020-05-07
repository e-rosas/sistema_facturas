@extends('layouts.app', ['title' => __('Call management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Llamadas') }}</h3>
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Number') }}</th>
                                    <th scope="col">{{ __('Claim') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Invoice') }}</th>
                                    <th scope="col">{{ __('Patient') }}</th>
                                    <th scope="col">{{ __('Comments') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calls as $call)
                                    <tr>
                                        <td>{{ $call->number}}</td>
                                        <td>{{ $call->claim}}</td>     
                                        <td>{{ $call->status}}</td>                                     
                                        <td>{{ $call->date->format('m-d-Y') }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $call->invoice) }}">
                                                {{ $call->invoice->number}}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($call->person_data->insured)
                                                <a href="{{ route('insurees.show', $call->person_data->insuree) }}">
                                            @else
                                                <a href="{{ route('beneficiaries.show', $call->person_data->beneficiary) }}">
                                            @endif
                                            {{ $call->person_data->full_name }}
                                        </td>
                                        <td>{{ $call->comments}}</td>  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $calls->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection