<form class="form-horizontal" method="POST" action="{{ route('import.process.invoices') }}">
    {{ csrf_field() }}
    <h1>Invoices {{ $count }}</h1>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Serie</th>
                <th scope="col">Paciente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Status</th>
                <th scope="col">concepto</th>
                <th scope="col">TC</th>
                <th scope="col">Total</th>
                <th scope="col">comentarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->number }} </td>
                    <td>{{ $invoice->series }}</td>
                    <td>{{ $invoice->person->full_name }}</td>
                    <td>{{ $invoice->date->format('d-m-Y') }}</td>
                    <td>{{ $invoice->type() }}</td>
                    <td>{{ $invoice->status() }}</td>
                    <td>{{ $invoice->concept }}</td>
                    <td>{{ $invoice->exchange_rate }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>
                    <td>{{ $invoice->comments }}</td>
                </tr>
                @foreach ($invoice->pagos as $pago)
                    <tr>
                        <td>{{ $pago->number }} </td>
                        <td>P</td>
                        <td></td>
                        <td>{{ $pago->date->format('d-m-Y') }}</td>
                        <td>{{ $pago->method() }}</td>
                        <td></td>
                        <td>{{ $pago->concept() }}</td>
                        <td>{{ $pago->exchange_rate }}</td>
                        <td>{{ $pago->amount_paid }}</td>
                        <td>{{ $pago->commens }}</td>
                    </tr>
                @endforeach
                @if (!is_null($invoice->nota))
                    <tr>
                        <td>{{ $invoice->nota->number }} </td>
                        <td>{{ $invoice->nota->series }}</td>
                        <td></td>
                        <td>{{ $invoice->nota->date->format('d-m-Y') }}</td>
                        <td></td>
                        <td></td>
                        <td>{{ $invoice->nota->concept() }}</td>
                        <td>{{ $invoice->nota->exchange_rate }}</td>
                        <td>{{ $invoice->nota->amount_due }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <h1>Credito, paciente inexistente o repetido, cantidad: {{ $count2 }}</h1>
     <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">paciente</th>
                <th scope="col">Cargos</th>
                <th scope="col">abonos</th>
                <th scope="col">Saldo</th>
                <th scope="col">Vence</th>
                <th scope="col">Cambio</th>
                <th scope="col">Estado</th>
                <th scope="col">Referencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_found_credito as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        
    </table> 
    <h1>Contado, paciente inexistente o repetido, cantidad: {{ count($not_found_contado) }}</h1>
     <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">paciente</th>
                <th scope="col">Cargos</th>
                <th scope="col">abonos</th>
                <th scope="col">Saldo</th>
                <th scope="col">Vence</th>
                <th scope="col">Cambio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_found_contado as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table> 
    <h1>Contado ENERO, paciente inexistente o repetido, cantidad: {{ count($not_found_contado_e) }}</h1>
     <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Serie</th>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">paciente</th>
                <th scope="col">Cargos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_found_contado_e as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table> 
    <h1>Contado FEBRERO, paciente inexistente o repetido, cantidad: {{ count($not_found_contado_f) }}</h1>
     <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">paciente</th>
                <th scope="col">Cargos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_found_contado_f as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Contado MARZO, paciente inexistente o repetido, cantidad: {{ count($not_found_contado_m) }}</h1>
     <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Folio</th>
                <th scope="col">Concepto</th>
                <th scope="col">paciente</th>
                <th scope="col">Cargos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_found_contado_m as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    {{--  <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">NSS</th>
                <th scope="col">Calle</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Genero</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->last_name }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->nss }}</td>
                    <td>{{ $patient->street }}</td>
                    <td>{{ $patient->phone_number }}</td>
                    <td>{{ $patient->gender() }}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>  --}}
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>
</form>