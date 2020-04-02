{{-- Table of discounts --}}
<div  class="table-responsive">
    <table id="discounts_person_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Percentage') }}</th>
                <th scope="col">{{ __('Discounted total') }}</th>
                <th scope="col">{{ __('Start') }}</th>
                <th scope="col">{{ __('End') }}</th>
                <th scope="col">{{ __('Active') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount->discount_percentage}}</td>
                    <td>{{ $discount->discounted_total}}</td>
                    <td>{{ $discount->start_date}}</td>
                    <td>{{ $discount->end_date}}</td>
                    <td>{{ ($discount->active) ? 'Active' : 'Not active'}}</td>
                    <td class="text-right">
                        <button class="btn btn-icon btn-info btn-sm"  type="button" onClick="showEditDiscountModal({{ $discount->id }})">
                            <span class="btn-inner--icon">
                                <i class="fas fa-pencil-alt fa-2 "></i>
                            </span>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteDiscount({{ $discount->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@push('js')
<script>
    function DisplayDiscounts(data){
        var discounts = data;
        var output = "";
        for(var i = 0; i < discounts.length; i++){
            output += "<tr value="+discounts[i].id+">"
                + "<td>" + discounts[i].discount_percentage + "</td>"
                + "<td>" + discounts[i].discounted_total + "</td>"
                + "<td>" + discounts[i].start_date + "</td>"
                + "<td>" + discounts[i].end_date + "</td>"
                + "<td>" + discounts[i].active + "</td>"
                +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="showEditDiscountModal(\'' + discounts[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteDiscount(\'' + discounts[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +  "</tr>";
        }
        $('#discounts_person_table tbody').html(output);
    }
    function DeleteDiscount(id){
        var r = confirm("Are you sure? Discount will be marked as inactive.");
        if(r){
            $.ajax({
                url: "{{route('discount_person.destroy')}}",
                dataType: 'json',
                type:"patch",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "discount_person_data_id" : id
                },
            success: function (response) {
                DisplayDiscounts(response.data);
                displayStats();
                }
            });
            return false;
        }

    }
</script>
@endpush
