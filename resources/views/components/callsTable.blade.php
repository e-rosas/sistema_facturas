{{-- Table of calls --}}
<div class="table-responsive">
    <table id="calls_table" class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Número') }}</th>
                <th scope="col">{{ __('Factura') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
           {{--  @foreach ($calls as $call)
            <tr>
                <td>{{ $call->number}}</td>
                <td>
                    <a href="{{ route('invoices.show', $call->invoice) }}">
                        {{ $call->invoice->number}}
                    </a>
                </td>
                <td>{{ $call->date->format('M-d-Y')}}</td>
                <td>{{ $call->status() }}</td>
                <td>{{ $call->comments }}</td>
                <td class="text-right">
                    <button class="btn btn-icon btn-info btn-sm" type="button"
                        onClick="showEditCallModal({{ $call->id }})">
                        <span class="btn-inner--icon">
                            <i class="fas fa-pencil-alt fa-2 "></i>
                        </span>
                    </button>
                    <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                        onClick="DeleteCall({{ $call->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">
        <h5>Cantidad de llamadas:  </h5>
        <h5 id="callsCount">0</h5>
    </nav>
</div>
@push('js')
    <script>
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         var calls = [];

         function getCalls() {
            $.ajax({
            url: "{{route('invoice.calls')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                'invoice_id': {{ $invoice->id }},
            },
            success: function (response) {
                calls = response.data;
                displayCalls(response.data);
                //displayStats();

                }
            });
            return false;
         }

         function filterCalls(state){
            filteredCalls = [];
             if(state < 11){
                filteredCalls = calls.filter((call) => {
                    return call.status_n == state;
                });
             } else {
                 filteredCalls = calls;
             }
             displayCalls(filteredCalls);
             
         }
         getCalls();
    </script>
@endpush
