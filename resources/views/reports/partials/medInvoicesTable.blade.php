<div class="table-responsive">
    <table class="table align-items-center table-flush table-sm">
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
    </table>
</div>
@push('js')
<script>
    function toggle_visibility(id) {
        var e = document.getElementById("invoice"+id);
        e.style.display = ((e.style.display=='none') ? 'block' : 'none');
        }
</script>
@endpush
