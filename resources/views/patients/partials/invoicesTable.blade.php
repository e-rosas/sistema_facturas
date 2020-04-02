<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Total') }}</th>
                <th scope="col">{{ __('Total with discounts') }}</th>
                <th scope="col">{{ __('Services') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                    <td>{{ $invoice->date->format('M-d-Y') }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm"  onclick="toggle_visibility({{ $invoice->id }});">Show</a>
                        <div id="invoice{{$invoice->id}}" style="display: none;">
                            @include('components.personServicesTable', ['services' => $invoice->services])
                        </div>

                    </td>
                </tr>
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
