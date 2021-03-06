<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Cobro') }}</th>
                <th scope="col">{{ __('Tipo') }}</th>
                <th scope="col">{{ __('Facturación') }}</th>
                <th scope="col">{{ __('CONTPAQ') }}</th>
                <th scope="col">{{ __('Fecha de servicio') }}</th>
                {{-- <th scope="col">{{ __('Paciente') }}</th> --}}
                <th scope="col">Subtotal</th>
                <th scope="col">{{ __('IVA') }}</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->code }}</a></td>
                <td>{{ $invoice->type()}}</td>
                <td>{{ $invoice->date->format('M-d-Y') }}</td>
                <td><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                <td>{{ $invoice->DOS->format('M-d-Y')}}</td>
                {{-- <td>
                    <a href="{{ route('patients.show', $invoice->patient) }}">
                {{ $invoice->patient->full_name}}
                </a>
                </td> --}}
                <td><span class="MXN"> {{ $invoice->subtotalF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->subtotalDiscounted() }} </span> </td>
                <td><span class="MXN"> {{ $invoice->IVAF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->discountedTax() }} </span></td>
                <td><span class="MXN"> {{ $invoice->totalF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->totalDiscounted() }} </span></td>
            </tr>
            @foreach ($invoice->payments as $payment)
            <tr class="table-success">
                <td>{{ $payment->date->format('M-d-Y') }}</td>
                <td>{{ $payment->number}}</td>
                <td>{{ $payment->concept()}}</td>
                <td><span class="MXN"> {{ $payment->total() }} </span><span class="USD" style="display: none">
                        {{ $payment->amountPaid() }} </span></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            @if (!is_null($invoice->credit))
            <tr class="table-info">
                <td>{{ $invoice->credit->date->format('M-d-Y') }}</td>
                <td>{{ $invoice->credit->number}}</td>
                <td>{{ $invoice->credit->concept()}}</td>
                <td><span class="MXN"> {{ $invoice->credit->total() }}</span> <span class="USD" style="display: none">
                        {{ $invoice->credit->amountDue() }} </span></td>
                <td></td>
                <td></td>
            </tr>
            @endif

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Subtotal: <span class="MXN"> {{ $invoices_totals->getSubtotalM() }}
                    </span> <span class="USD" style="display: none"> {{ $invoices_totals->getSubtotal() }}</span></td>
                <td>IVA: <span class="MXN"> {{ $invoices_totals->getIVA() }} </span> <span class="USD"
                        style="display: none"> {{ $invoices_totals->getDTax() }}</span></td>
                <td>Total: <span class="MXN"> {{ $invoices_totals->getTotalM() }} </span> <span class="USD"
                        style="display: none"> {{ $invoices_totals->getTotal_with_discounts() }}</span></td>
            </tr>
        </tfoot>
    </table>
</div>
