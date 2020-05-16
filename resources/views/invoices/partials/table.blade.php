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
                    <td><a  href="{{ route('patients.show', $invoice->patient) }}">{{  $invoice->patient->full_name  }}</a></td>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->type() }}</td>
                    <td>{{ $invoice->status() }}</td>
                    <td>{{ $invoice->sub_total_discounted }}</td>
                    <td>{{ $invoice->dtax }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>
                    <td class="td-actions text-right">
                        <a class="btn btn-success btn-sm btn-icon" rel="tooltip"  type="button"  href="{{ route('invoices.show', $invoice) }}">
                            <i class="fas fa-eye "></i>
                        </a>
                        {{-- <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button"  href="{{ route('invoices.edit', $invoice) }}">
                            <i class="fas fa-pencil-alt fa-2"></i>
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">
        {{ $invoices->appends(['search'=>$search, 'perPage'=>$perPage, 'type'=>$type,'status'=>$status ])->links() }}
    </nav>
</div>