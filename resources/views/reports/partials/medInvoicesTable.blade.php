<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">Cargos</th>
                <th scope="col">Abonos</th>
                <th scope="col">Saldo</th>
                <th scope="col">Vence</th>
                <th scope="col">Cambio</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->series }}</td>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>        
                    <td>{{ $invoice->concept }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>    
                    <td></td>
                    @if (!is_null($invoice->credit))
                        <td>0.0000</td>
                    @else
                        <td>{{ $invoice->amount_due }}</td>
                    @endif
                    
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->exchange_rate }}</td>     
                    <td>{{ $invoice->status() }}</td>         
                </tr>
            @foreach ($invoice->payments as $payment)
                <tr class="table-success">
                    <td>{{ $payment->date->format('d-m-Y') }}</td>
                    <td>P</td>
                    <td>{{ $payment->number}}</td>
                    <td>{{ $payment->concept()}}</td>
                    <td></td>
                    <td>{{ $payment->amount_paid }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $payment->exchange_rate }}</td>
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
                    <td>{{ $invoice->credit->amount_due }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $invoice->credit->exchange_rate }}</td>
                    <td></td>
                </tr>
            @endif

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">Cargos: {{ $invoices_totals['charges'] }}</td>
                <td>Abonos:{{ $invoices_totals['payments'] }} </td>
                <td>Saldo: {{ $invoices_totals['due'] }}</td>
            </tr>
        </tfoot>
    </table>

</div>

