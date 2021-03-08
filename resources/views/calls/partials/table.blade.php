
<div class="row m-1">
    <div class="col-md-4">
        <select class="custom-select" id="call-status" onchange="filterCalls()">

            <option value="-1" selected>{{ __('Todas') }}</option>
            <option value="0">{{ __('En proceso') }}</option>
            <option value="1">{{ __('Deducibles') }}</option>
            <option value="2">{{ __('Negada por cargos no cubiertos') }}</option>
            <option value="3">{{ __('Pago') }}</option>
            <option value="4">{{ __('Negada por fuera de tiempo') }}</option>
            <option value="5">{{ __('Otro') }}</option>
            <option value="6">{{ __('Pago pendiente') }}</option>
            <option value="7">{{ __('Información pendiente') }}</option>
            <option value="8">{{ __('Cobro no encontrado') }}</option>
            <option value="9">{{ __('Medicamente innecesaria') }}</option>
            <option value="10">{{ __('En apelación') }}</option>
        </select>
    </div>
</div>
<div class="table-responsive">
    <table id="patient-calls" class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr class="header">
                <th scope="col">{{ __('Número') }}</th>
                <th scope="col">{{ __('Factura') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Cobro') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calls as $call)
            <tr>
                <td>{{ $call->number}}</td>
                <td>
                    <a href="{{ route('invoices.show', $call->invoice) }}">
                        {{ $call->invoice->number}}
                    </a>
                </td>
                <td>{{ $call->date->format('M-d-Y')}}</td>
                <td>
                    <a href="{{ route('invoices.show', $call->invoice) }}">
                        {{ $call->invoice->code}}
                    </a>
                </td>
                <td data-status="{{ $call->status }}">{{ $call->status() }}</td>
                <td>{{ $call->comments }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('js')
    <script> 
        function filterCalls() {
            const filter = document.querySelector('#call-status').value.toUpperCase();
            const trs = document.querySelectorAll('#patient-calls tr:not(.header)');
            if(filter != "-1") {
                trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.getAttribute("data-status") == (filter)) ? '' : 'none');
            }
            else {
                trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.getAttribute("data-status") != (filter)) ? '' : 'none');
            }
            
        }
    </script>
@endpush