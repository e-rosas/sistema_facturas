<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Folio CONTPAQ') }}</th>
                <th scope="col">Paciente{{ __('Nombre') }}</th>
                <th scope="col">Subtotalv</th>
                <th scope="col">IVA{{ __('Nombre') }}</th>
                <th scope="col">Total{{ __('Nombre') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>        
                    <td>
                        <a href="{{ route('patients.show', $invoice->patient) }}">
                            {{ $invoice->patient->full_name}}
                        </a>
                    </td>
                    <td>$ {{ $invoice->subtotal() }}</td>
                    <td>$ {{ $invoice->IVA() }}</td>
                    <td>$ {{ $invoice->total()}}</td>                  
                </tr>
            @foreach ($invoice->payments as $payment)
                <tr class="table-success">
                    <td>{{ $payment->date->format('d-m-Y') }}</td>
                    <td>{{ $payment->number}}</td>
                    <td>{{ $payment->concept()}}</td>
                    <td>$ {{ $payment->total()}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            @if (!is_null($invoice->credit))
                <tr class="table-info">
                    <td>{{ $invoice->credit->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->credit->number}}</td>
                    <td>{{ $invoice->credit->concept()}}</td>
                    <td>$ {{ $invoice->credit->total()}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endif

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Subtotal: {{ $invoices_totals->getSubtotalM() }}</td>
                <td>IVA:  {{ $invoices_totals->getIVA() }}</td>
                <td>Total:  {{ $invoices_totals->getTotalM() }}</td>
            </tr>
        </tfoot>
    </table>
</div>

