<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Num. de Cobro') }}</th>
                <th scope="col">CONTPAQ</th>
                <th scope="col">{{ __('Paciente') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
                <th scope="col">{{ __('Cargos') }}</th>
                <th scope="col">{{ __('Abonos') }}</th>
                <th scope="col">{{ __('Saldo') }}</th>
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
                <td>{{ $invoice->status() }}</td>
                <td>
                    {{ $invoice->totalDiscounted() }}</td>
                <td>
                    {{ $invoice->amountPaid() }}</td>
                <td>
                    {{ $invoice->amountDue() }}</td>

            </tr>
            @foreach ($invoice->calls as $call)
            <tr class="{{ ($call->status != 3) ? 'table-warning' : 'table-success' }}">
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
