<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Folio CONTPAQ</th>
                <th scope="col">Paciente</th>
                <th scope="col">Subtotal</th>
                <th scope="col">IVA</th>
                <th scope="col">Total</th>
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
                    <td>{{ $invoice->subtotal() }}</td>
                    <td>{{ $invoice->IVA() }}</td>
                    <td>{{ $invoice->total()}}</td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm"  onclick="toggle_visibility({{ $invoice->id }});">Show</a>
                        <div id="invoice{{$invoice->id}}" style="display: none;">
                            @include('components.personServicesTable', ['services' => $invoice->services])
                        </div>

                    </td>
                </tr>
                <a class="btn btn-outline-primary btn-sm" onclick="toggle_visibility({{ $invoice->id }});">Pagos</a>
                    @foreach ($invoice->payments as $payment)
                        <tr>
                            <td>{{ $payment->date->format('d-m-Y') }}</td>
                            <td>{{ $payment->number}}</td>
                            <td>{{ $payment->concept()}}</td>
                            <td>{{ $payment->total()}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                
                
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
