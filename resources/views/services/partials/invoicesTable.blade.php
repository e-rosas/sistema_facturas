<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Numero') }}</th>
                <th scope="col">{{ __('Paciente') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Total') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                    <td>{{ $invoice->patient->full_name }}</td>
                    <td>{{ $invoice->DOS->format('d-m-Y') }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    {{--  <form action="{{ route('invoice.destroy', $invoice) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                        <a class="dropdown-item" href="{{ route('invoice.edit', $invoice) }}">{{ __('Edit') }}</a>
                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this invoice?") }}') ? this.parentElement.submit() : ''">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>    --}}  
                                    <a class="dropdown-item" href="{{ route('invoices.show', $invoice) }}">{{ __('Ver') }}</a>
                                    <a class="dropdown-item" href="{{ route('invoices.edit', $invoice) }}">{{ __('Editar') }}</a>
                            </div>
                        </div>
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