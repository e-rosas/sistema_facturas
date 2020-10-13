@extends('layouts.app', ['title' => __('Cartas')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8 col-auto">
                            <h3 class="mb-0">{{ __('Cartas') }}</h3>
                        </div>

                    </div>
                </div>
                <form method="get" action="{{ route('letters.index') }}">
                    <div class="form-row">
                        <div class="col-lg-2 col-auto">
                            <label for="perPage">{{ __('Cantidad') }}</label>
                            <select class="custom-select" name="perPage">
                                <option value='15' {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                                <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                                <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>{{ __('Todas') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-auto">
                            <label for="status">{{ __('Estado') }}</label>
                            <select id='status' class="custom-select" name="status">
                                <option value='2' {{ $status == 2 ? 'selected' : '' }}>Todas</option>
                                <option value='0' {{ $status == 0 ? 'selected' : '' }}>Enviado
                                </option>
                                <option value='1' {{ $status == 1 ? 'selected' : '' }}>Aseguranza contestó.</option>
                            </select>
                        </div>
                        {{--  start_date  --}}
                        <div class="col-lg-3 col-auto">
                            <label for="start">{{ __('Fecha de') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="start" id="input-start" class="form-control"
                                    value="{{ $start->format('Y-m-d') }}">
                            </div>
                        </div>
                        {{--  end_date  --}}
                        <div class="col-lg-3 col-auto">
                            <label for="end">{{ __('hasta') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="end" id="input-end" class="form-control"
                                    value="{{ $end->format('Y-m-d')  }}">
                            </div>
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="form-group col-lg-11 col-auto">
                            <input name="search" class="form-control" type="search"
                                placeholder="{{ __('Apellido de paciente...') }}" value="{{ $search ?? '' }}">
                        </div>
                        <div class="col-lg-1 col-auto text-right">
                            <button type="submit" class="btn btn-primary btn-fab btn-icon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                </form>
                <div class="table-responsive">
                    <table class="table table-flush" style="table-layout: fixed" id="letters_table_index">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 10%;" scope="col">{{ __('Paciente') }}</th>
                                <th style="width: 10%;" scope="col">{{ __('Fecha') }}</th>
                                <th style="width: 15%;" scope="col">{{ __('Cobros') }}</th>
                                <th style="width: 10%;" scope="col">{{ __('Estado') }}</th>
                                <th style="width: 15%;" scope="col">{{ __('Comentarios') }}</th>
                                <th style="width: 30%;" scope="col">{{ __('Contestó') }}</th>
                                <th style="width: 10%;" scope="col">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($letters as $letter)
                            <tr>
                                <td>
                                    <a href="{{ route('patients.show', $letter->patient) }}">
                                        {{ $letter->patient->full_name}}
                                    </a>
                                </td>
                                <td>{{ $letter->date->format('M-d-Y')}}</td>
                                <td>
                                    <span
                                        style="overflow: hidden; text-overflow: ellipsis; display:block">{{ $letter->content }}</span>
                                </td>
                                <td>{{ $letter->status() }}</td>
                                <td><span
                                        style="overflow: hidden; text-overflow: ellipsis; display:block">{{ $letter->comments }}</span>
                                </td>
                                <td><span
                                        style="overflow: hidden; text-overflow: ellipsis; display:block">{{ $letter->reply }}</span>
                                </td>
                                <td class="td-actions text-right">
                                    <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                                        onClick="showEditLetterModal({{ $letter->id }})">
                                        <i class="fas fa-pencil-alt fa-2"></i>
                                    </button>
                                    <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                                        onClick="DeleteLetter({{ $letter->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $letters->appends(['start' =>$start->format('Y-m-d'), 'end' => $end->format('Y-m-d'),'search'=>$search, 'perPage'=>$perPage, 'status'=>$status ])->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('emails.partials.editModal')
    @include('layouts.footers.auth')
</div>
@endsection
