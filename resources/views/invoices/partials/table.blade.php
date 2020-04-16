<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Num. de Cobro</th>
                <th scope="col">Folio CONTPAQ</th>
                <th scope="col">Paciente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Status</th>
                <th scope="col">Subtotal</th>
                <th scope="col">IVA</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>
                        <a href="{{ route('invoices.show', $invoice) }}">
                            {{ $invoice->code}}
                        </a>
                    </td>
                    <td>{{ $invoice->code() }}</td>
                    <td>{{ $invoice->patient->full_name }}</td>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->type() }}</td>
                    <td>{{ $invoice->status() }}</td>
                    <td>{{ $invoice->sub_total_discounted }}</td>
                    <td>{{ $invoice->dtax }}</td>
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
                                    <a class="dropdown-item" href="{{ route('invoices.show', $invoice) }}">Ver</a>
                                    <a class="dropdown-item" href="{{ route('invoices.edit', $invoice) }}">Editar</a>
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
        {{ $invoices->links() }}
    </nav>
</div>