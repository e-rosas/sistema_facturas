{{-- Table of calls --}}
<div class="table-responsive">
    <table id="calls_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Número') }}</th>
                <th scope="col">{{ __('Factura') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calls as $call)
            <tr>
                <td>{{ $call->number}}</td>
                <td>
                    <a href="{{ route('invoices.show', $call->invoice) }}">
                        {{ $call->invoice->number}}
                    </a>
                </td>
                <td>{{ $call->date->format('d-M-Y')}}</td>
                <td>{{ $call->status() }}</td>
                <td>{{ $call->comments }}</td>
                <td class="text-right">
                    <button class="btn btn-icon btn-info btn-sm" type="button"
                        onClick="showEditCallModal({{ $call->id }})">
                        <span class="btn-inner--icon">
                            <i class="fas fa-pencil-alt fa-2 "></i>
                        </span>
                    </button>
                    <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                        onClick="DeleteCall({{ $call->id }})">
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

    </nav>
</div>
