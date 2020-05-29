<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Num. de Cobro') }}</th>
                <th scope="col">CONTPAQ</th>
                <th scope="col">{{ __('Paciente') }}</th>
                <th scope="col">{{ __('DOS') }}</th>
                <th scope="col">{{ __('Tipo') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
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
                    <td>{{ $invoice->DOS->format('d-M-Y') }}</td>
                    <td>{{ $invoice->type() }}</td>
                    <td>{{ $invoice->status() }}</td>
                    <td><span class="MXN" style="display: none"> {{ $invoice->subtotalF() }} </span><span class="USD" > {{ $invoice->subtotalDiscounted() }} </span> </td>
                    <td><span class="MXN" style="display: none"> {{ $invoice->IVAF() }} </span><span class="USD" > {{ $invoice->discountedTax() }} </span></td>
                    <td><span class="MXN" style="display: none"> {{ $invoice->totalF() }} </span><span class="USD"> {{ $invoice->totalDiscounted() }} </span></td>  
                    <td class="td-actions text-right">
                        <a class="btn btn-success btn-sm btn-icon" rel="tooltip"  type="button"  href="{{ route('invoices.show', $invoice) }}">
                            <i class="fas fa-eye "></i>
                        </a>
                        {{--  <a class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button"  href="{{ route('invoices.edit', $invoice) }}">
                            <i class="fas fa-pencil-alt fa-2"></i>
                        </a>  --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
