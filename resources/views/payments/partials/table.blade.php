{{-- Table of payments --}}
<div class="table-responsive">
    <table id="payments_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Amount') }}</th>
                <th scope="col">{{ __('Comments') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->number}}</td>
                    <td>{{ $payment->date->format('M-d-Y')}}</td>
                    <td>{{ $payment->amount}}</td>
                    <td>{{ $payment->comments}}</td>
                     <td class="td-actions text-right">
                        <button class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" onClick="showEditModal({{ $payment->id }})">
                                <i class="fas fa-pencil-alt fa-2 "></i>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete({{ $payment->id }})">
                                <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('payments.partials.editModal', ['patient_id'=>$patient_id])
@push('js')
<script>
    function DisplayPayments(data){
        var payments = data;
        var output = "";
        for(var i = 0; i < payments.length; i++){
            output += "<tr value="+payments[i].id+">"
                + "<td>" + payments[i].number + "</td>"
                + "<td>" + payments[i].date + "</td>"
                + "<td>" + payments[i].amount + "</td>"
                + "<td>" + payments[i].comments + "</td>"
                +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="showEditModal(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +  "</tr>";
        }
        $('#payments_table tbody').html(output);
        setPaymentCount();
    }
    function Delete(id){
        var r = confirm("Are you sure?");
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

