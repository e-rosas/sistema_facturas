<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Num. de Cobro') }}</th>
                <th scope="col">CONTPAQ</th>
                <th scope="col">{{ __('Paciente') }}</th>
                <th scope="col">{{ __('Cargos') }}</th>
                <th scope="col">{{ __('Abonos') }}</th>
                <th scope="col">{{ __('Saldo') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr class="{{ ($invoice->status == 5) ? 'table-info' : '' }}">
                <td>{{ $invoice->date->format('d-M-Y') }}</td>
                <td>{{ $invoice->code }}</td>
                <td><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                <td>
                    <a href="{{ route('patients.show', $invoice->patient) }}">
                        {{ $invoice->patient->full_name}}
                    </a>
                </td>
                <td><span class="MXN"> {{ $invoice->totalF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->totalDiscounted() }} </span></td>
                <td><span class="MXN"> {{ $invoice->amountPaidMXN() }} </span><span class="USD" style="display: none">
                        {{ $invoice->amountPaid() }} </span></td>
                <td><span class="MXN"> {{ $invoice->debeF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->amountDue() }} </span></td>
                <td>{{ $invoice->status() }}</td>
            </tr>
            @foreach ($invoice->calls as $call)
            <tr class="{{ ($call->type != 3) ? 'table-warning' : 'table-success' }}">
                <td></td>
                <td>{{ $call->date->format('d-M-Y') }}</td>
                <td>{{ $call->status()}}</td>
                <td colspan="5">{{ $call->comments }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>

</div>
