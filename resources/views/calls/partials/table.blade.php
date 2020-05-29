<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Número') }}</th>
                <th scope="col">{{ __('Factura') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Claim') }}</th>
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
                    <td>{{ $call->date->format('d-M-Y')}}</td>
                    <td>
                        <a href="{{ route('invoices.show', $call->invoice) }}">
                            {{ $call->invoice->code}}
                        </a>
                    </td>
                    <td>{{ $call->status() }}</td>
                    <td>{{ $call->comments }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>