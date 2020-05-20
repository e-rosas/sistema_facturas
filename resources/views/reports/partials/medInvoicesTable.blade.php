<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Serie') }}</th>
                <th scope="col">{{ __('Folio') }}</th>
                <th scope="col">{{ __('Concepto') }}</th>
                <th scope="col">{{ __('Cargos') }}</th>
                <th scope="col">{{ __('Abonos') }}</th>
                <th scope="col">{{ __('Saldo') }}</th>
                <th scope="col">{{ __('Vence') }}</th>
                <th scope="col">{{ __('Cambio') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->series }}</td>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>        
                    <td>{{ $invoice->concept }}</td>
                    <td>{{ $invoice->totalDiscounted()}}</td>    
                    <td></td>
                    @if (!is_null($invoice->credit))
                        <td>0.0000</td>
                    @else
                        <td>{{ $invoice->amountDue() }}</td>
                    @endif
                    
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->exchangeRate() }}</td>     
                    <td>{{ $invoice->status() }}</td>         
                </tr>
            @foreach ($invoice->payments as $payment)
                <tr class="table-success">
                    <td>{{ $payment->date->format('d-m-Y') }}</td>
                    <td>P</td>
                    <td>{{ $payment->number}}</td>
                    <td>{{ $payment->concept()}}</td>
                    <td></td>
                    <td>{{ $payment->amountPaid() }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $payment->exchangeRate() }}</td>
                    <td></td>
                </tr>
            @endforeach
            @if (!is_null($invoice->credit))
                <tr class="table-info">
                    <td>{{ $invoice->credit->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->credit->series }}</td>
                    <td>{{ $invoice->credit->number}}</td>
                    <td>{{ $invoice->credit->concept()}}</td>
                    <td></td>
                    <td>{{ $invoice->credit->amountDue() }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $invoice->credit->exchangeRate() }}</td>
                    <td></td>
                </tr>
            @endif

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">Cargos: {{ $invoices_totals->getTotal_with_discounts()}}</td>
                <td>Abonos:{{ $invoices_totals->getAmountPaid()}} </td>
                <td>Saldo: {{ $invoices_totals->getAmountDue() }}</td>
            </tr>
        </tfoot>
    </table>

</div>

