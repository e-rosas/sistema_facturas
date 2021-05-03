<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Cobro') }}</th>
                <th scope="col">CONTPAQ</th>
                <th scope="col">{{ __('DOS') }}</th>
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
                <td>{{ $invoice->DOS->format('M-d-Y') }}</td>
                <td><span class="MXN" style="display: none"> {{ $invoice->totalF() }} </span><span class="USD">
                        {{ $invoice->totalDiscounted() }} </span></td>
                <td class="td-actions text-right">
                    <a class="btn btn-success btn-sm btn-icon" rel="tooltip" type="button"
                        href="{{ route('invoices.show', $invoice) }}">
                        <i class="fas fa-eye "></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
