<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Serie') }}</th>
                <th scope="col">{{ __('Folio') }}</th>
                <th scope="col">{{ __('Concepto') }}</th>
                <th scope="col">{{ __('Paciente') }}</th>
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
                <td>{{ $invoice->date->format('M-d-Y') }}</td>
                <td>{{ $invoice->series }}</td>
                <td><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                <td>{{ $invoice->concept }}</td>
                <td>
                    <a href="{{ route('patients.show', $invoice->patient) }}">
                        {{ $invoice->patient->full_name}}
                    </a>
                </td>
                <td><span class="MXN"> {{ $invoice->totalF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->totalDiscounted() }} </span></td>
                <td><span class="MXN"> {{ $invoice->amountPaidMXN() }} </span><span class="USD" style="display: none">
                        {{ $invoice->amountPaid() }} </span></td>
                @if (!is_null($invoice->credit))
                <td>0.0000</td>
                {{-- @elseif(!is_null($invoice->charge))
                        <td><span class="MXN"> {{ $invoice->charge->total() }} </span><span class="USD"
                    style="display: none">
                    {{ $invoice->charge->getAmountCharged() }} </span>
                </td> --}}
                @else
                <td><span class="MXN"> {{ $invoice->debeF() }} </span><span class="USD" style="display: none">
                        {{ $invoice->amountDue() }} </span></td>
                @endif

                <td>{{ $invoice->date->format('M-d-Y') }}</td>
                <td>{{ $invoice->exchangeRate() }}</td>
                <td>{{ $invoice->status() }}</td>
            </tr>
            @foreach ($invoice->payments as $payment)
            <tr class="{{ $payment->type == 1 ? 'table-info' : 'table-success' }}">
                <td>{{ $payment->date->format('M-d-Y') }}</td>
                <td>P</td>
                <td>{{ $payment->number }}</td>
                <td>{{ $payment->concept()}}</td>
                <td></td>
                <td></td>
                <td><span class="MXN"> {{ $payment->total() }} </span><span class="USD" style="display: none">
                        {{ $payment->amountPaid() }} </span></td>
                <td></td>
                <td></td>
                <td>{{ $payment->exchangeRate() }}</td>
                <td></td>
            </tr>
            @endforeach
            @if (!is_null($invoice->credit))
            <tr class="table-info">
                <td>{{ $invoice->credit->date->format('M-d-Y') }}</td>
                <td>{{ $invoice->credit->series }}</td>
                <td>{{ $invoice->credit->number}}</td>
                <td>{{ $invoice->credit->concept()}}</td>
                <td></td>
                <td></td>
                <td><span class="MXN"> {{ $invoice->credit->total() }} </span><span class="USD" style="display: none">
                        {{ $invoice->credit->amountDue() }} </span></td>
                <td></td>
                <td></td>
                <td>{{ $invoice->credit->exchangeRate() }}</td>
                <td></td>
            </tr>
            @endif
            {{-- @if (!is_null($invoice->charge))
            <tr class="table-warning">
                <td>{{ $invoice->charge->date->format('M-d-Y') }}</td>
            <td>C</td>
            <td>C-{{  $invoice->code }}</td>
            <td>{{ $invoice->charge->concept()}}</td>
            <td></td>
            <td><span class="MXN"> {{ $invoice->charge->total() }} </span><span class="USD" style="display: none">
                    {{ $invoice->charge->getAmountCharged() }} </span></td>
            <td><span class="MXN"> {{ $invoice->charge->total() }} </span><span class="USD" style="display: none">
                    {{ $invoice->charge->getAmountCharged() }} </span> </td>
            <td></td>
            <td></td>
            <td>{{ $invoice->charge->getExchangeRate() }}</td>
            <td></td>
            </tr>
            @endif--}}
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">Cargos: <span class="MXN"> {{ $invoices_totals->getTotalM() }}
                    </span> <span class="USD" style="display: none">
                        {{ $invoices_totals->getTotal_with_discounts() }}</span></td>
                <td>Abonos: <span class="MXN"> {{ $invoices_totals->amountPaidMXN() }} </span> <span class="USD"
                        style="display: none"> {{ $invoices_totals->getAmountPaid() }}</span></td>
                <td>Saldo: <span class="MXN"> {{ $invoices_totals->amountDueMXN() }} </span> <span class="USD"
                        style="display: none"> {{ $invoices_totals->getAmountDue() }}</span></td>
            </tr>
        </tfoot>
    </table>

</div>
