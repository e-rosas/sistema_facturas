{{-- Table of payments --}}
<div class="table-responsive">
    <table id="payments_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Cantidad') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr class="{{ $payment->type == 1 ? 'table-info' : '' }}">
                    <td>{{ $payment->date->format('M-d-Y')}}</td>
                    <td><span class="MXN" style="display: none"> {{ $payment->amountPaidMXN($invoice->exchange_rate) }} </span><span class="USD" > {{ $payment->amountPaid() }} </span> </td>
                    <td>{{ $payment->comments}}</td>
                    @if ($invoice->status != 1)
                        <td class="td-actions text-right">
                            <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                                onClick="showEditModal({{ $payment->id }})">
                                <i class="fas fa-pencil-alt fa-2 "></i>
                            </button>
                            <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                                onClick="Delete({{ $payment->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('payments.partials.editModal')
@push('js')
<script>
    function DisplayPayments(data){
        var payments = data;
        var output = "";
        var bg = "";
        for(var i = 0; i < payments.length; i++){
            bg = payments[i].type2 == 1 ? "table-info" : "";
            output += "<tr class="+bg+" value="+payments[i].id+">"
                + "<td>" + payments[i].date + "</td>"
                + '<td> <span class="MXN" style="display: none">' + payments[i].amount_paidMXN + '</span><span class="USD" > '+payments[i].amount_paid +'</span> </td>'
                + "<td>" + payments[i].comments + "</td>"
                +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="showEditModal(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +  "</tr>";
        }
        $('#payments_table tbody').html(output);
        var currency = document.getElementById("customRadioInlineUSD").checked;
        displayUSD(currency);
    }
    function Delete(id){
        var r = confirm("Eliminar el pago?");
        if(r){
            $.ajax({
                url: "{{route('payments.destroy')}}",
                dataType: 'json',
                type:"delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "payment_id" : id
                },
            success: function (response) {
                DisplayPayments(response.data);
                displayStats();
                }
            });
            return false;
        }

    }
</script>
@endpush

