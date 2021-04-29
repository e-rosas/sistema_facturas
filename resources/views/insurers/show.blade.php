@extends('layouts.app', ['title' => 'Aseguranzas'])

@section('content')
    @include('layouts.headers.header', ['title' => $insurer->name, 'description' => $insurer->code ])

    <div class="container-fluid mt--7">
        {{-- Search row --}}

        {{-- <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0 card-group">
            @include('components.invoiceStatsCard', ['idUSD' => 'totalUSD','title' => 'Total', 'USD' => 0, 'value' =>
            0, 'idMXN' => 'totalMXN', 'valueMXN' => 0])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-paid','title' => 'Pagado', 'bg' => 'bg-green',
            'USD' => 0,'value' => 0, 'idMXN' => 'amount-paidMXN', 'valueMXN' =>
            0])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-credit','title' => 'Crédito', 'bg' => 'bg-info',
            'USD' => 0,'value' => 0, 'idMXN' => 'amount-creditMXN', 'valueMXN' =>
            0])
            @include('components.invoiceStatsCard', ['idUSD' => 'amount-due','title' => 'Debe', 'bg' => 'bg-yellow',
            'USD' => 0,'value' => 0, 'idMXN' => 'amount-dueMXN', 'valueMXN' =>
            0])

        </div>

    </div> --}}
        <div class="row">
            {{-- refresh --}}
            {{-- <div class="col-md-9 text-right mt-2">
            <button id="refresh" type="button" class="btn btn-info" onclick="RefreshInsurerStats()">
                Actualizar
            </button>
        </div> --}}
        </div>
        <div class="row mt-2">
            <div class="col-xl-9">

                <div class="card  mb-4 mb-xl-0">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Asegurados</h3>
                            </div>

                        </div>
                    </div>
                    <form method="get" action="{{ route('insurers.show', $insurer) }}">
                        <div class="form-row m-2">
                            <div class="col-md-11 col-auto">
                                <input name="search" class="form-control" type="search"
                                    placeholder="Nombre, NSS, o ID de aseguranza..." value="{{ $search ?? '' }}">
                            </div>
                            {{-- refresh --}}
                            <div class="col-md-1 col-auto text-right">
                                <button type="submit" class="btn btn-primary btn-fab btn-icon">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive" id="patients-table">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">NSS</th>
                                    <th scope="col">Fecha Nacimiento</th>
                                    <th scope="col">ID de Aseguranza</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurees as $insuree)
                                    <tr>
                                        <td> <a
                                                href="{{ route('patients.show', $insuree->patient) }}">{{ $insuree->patient->full_name }}</a>
                                        </td>
                                        <td>{{ $insuree->nss }}</td>
                                        <td>{{ $insuree->patient->birth_date->format('d-m-Y') }}</td>
                                        <td>{{ $insuree->insurance_id }}</td>
                                        <td class="td-actions text-right">

                                            <a class="btn btn-success btn-sm btn-icon" rel="tooltip" type="button"
                                                href="{{ route('patients.show', $insuree->patient) }}">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                                                href="{{ route('patients.edit', $insuree->patient) }}">
                                                <i class="fas fa-pencil-alt fa-2"></i>
                                            </a>

                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $insurees->appends(['search' => $search])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>
                            {{ $insurer->name }}
                        </h3>
                        <div class="m-2">
                            <form method="post"
                                onsubmit="return confirm('Confirmar eliminación de la aseguranza. TODOS LOS PACIENTES, COBROS, PAGOS, LLAMADAS, DOCUMENTOS, Y CARTAS SERÁN ELIMINADOS.');"
                                action="{{ route('insurers.destroy', $insurer) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">ELIMINAR</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <h2>{{ $insurer->name }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="h4 font-weight-300">
                                <span> {{ $insurer->address }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insurer->addressDetails() }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insurer->phone_number }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <a href="mailto:{{ $insurer->email }}">{{ $insurer->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function RefreshInsurerStats() {
            $.ajax({
                url: "{{ route('charts.insurer') }}",
                dataType: 'json',
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'insurer_id': {{ $insurer->id }}

                },
                success: function(response) {
                    console.log(response);
                }
            });
            return false;
        }

    </script>
@endpush
