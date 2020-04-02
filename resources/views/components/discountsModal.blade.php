<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Select discounts') }}</h5>
                        {{--  discount --}}
                        <div class="form-row">
                            <div class=" col-md-4 form-group {{ $errors->has('discount_percentage') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input required type="number" step="0.1" min="0.1" max="100" name="new_percentage" id="input-new_discount_percentage" class="form-control form-control-alternative"
                                    value=10>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <button id="add-percentage" type="button" class="btn btn-outline-primary">{{ __('Add') }}</button>
                            </div>
                        </div>
                        <div id="list-percentages" class="form-row">
                            <h3>Percentages:        </h3>
                            <ul class="list-inline">

                            </ul>
                        </div>

                        {{--  start_date  --}}
                        <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="start_date" id="input-start_date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                value="{{ old('start_date') }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--  end_date  --}}
                        <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="end_date" id="input-end_date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--  Generate  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="generate" type="button" class="btn btn-outline-primary btn-sm btn-block">{{ __('Preview discounts') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">

                        {{--  Applied Discounts  --}}
                        <h6 class="heading-small text-muted mb-4">{{ __('Applied discounts') }}</h6>
                        <div class="table-responsive">
                            <table id="applied_discounts_table" class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Select') }}</th>
                                        <th scope="col">{{ __('Discount %') }}</th>
                                        <th scope="col">{{ __('Total with new discount') }}</th>
                                        <th scope="col">{{ __('Amount due') }}</th>
                                        <th scope="col">{{ __('Difference') }}</th>
                                        <th scope="col">{{ __('Difference %') }}</th>
                                        <th scope="col">{{ __('End date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        {{--  Select discount  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="select" type="button" class="btn btn-success btn-sm btn-block">{{ __('Apply Discount') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal" id="edit-discount-modal" tabindex="-1" role="dialog" aria-labelledby="edit-discount-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Edit discount') }}</h5>

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{--  discount --}}
                        <input type="hidden" id="update-discount-id">
                        {{--  start_date  --}}
                        <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="start_date" id="update-start-date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                value="{{ old('start_date') }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--  end_date  --}}
                        <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="end_date" id="update-end-date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="update-discount" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var appliedDiscounts = [];
    var percentages = [];

    class AppliedDiscount {
        active = 0;
        status = 'ACTIVE';
        discounted_total = 0;
        difference = 0;
        constructor(person_data_id, discount_percentage,
                    amount_due_without_discounts, amount_due, start_date, end_date, id){
            this.person_data_id = person_data_id;
            this.discount_percentage = discount_percentage;
            this.amount_due_without_discounts = amount_due_without_discounts;
            this.discounted_total = discount_percentage * amount_due_without_discounts / 100;
            this.amount_due = amount_due;
            this.difference = this.discounted_total - this.amount_due;
            this.percentage_difference = this.difference / this.amount_due * 100;
            this.start_date = start_date.toISOString().split('T')[0]+' '+start_date.toTimeString().split(' ')[0];
            this.end_date = end_date.toISOString().split('T')[0]+' '+end_date.toTimeString().split(' ')[0];
            this.id = id;
        }

        get startDate(){
            return this.start_date.toLocaleString();
        }


        get endDate(){
            return this.end_date.toLocaleString();
        }

        get discountedTotal(){
            return this.discounted_total.toFixed(2);
        }

        get Difference(){
            return this.difference.toFixed(2);
        }

        get DifferencePercentage(){
            return this.percentage_difference.toFixed(2) + "%";
        }

    }

    function sendAppliedDiscount(appliedDiscount){
        $.ajax({
            url: "{{route('discount_person.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id" : appliedDiscount.person_data_id,
                "discount_percentage" : appliedDiscount.discount_percentage,
                "start_date" : appliedDiscount.start_date,
                "end_date" : appliedDiscount.end_date,
                "discounted_total" : appliedDiscount.discounted_total,
                "active" : appliedDiscount.active,
            },
        success: function (response) {

            var discounts_person = response.data;
            DisplayDiscounts(discounts_person);

            appliedDiscounts = [];
            displayGeneratedDiscounts();

            displayStats();

            $('#modal-form').modal('hide')



            }
        });
            return false;
    }

    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;

    function displayPercentages(){
        var output = "";

        for(var i = 0; i < percentages.length; i++){

            output += "<li class='list-inline-item'>"
                + percentages[i] + "</li>"
        }

        $('#list-percentages ul').html(output);
    }

    function displayGeneratedDiscounts(){
        var output = "";

        for(var i = 0; i < appliedDiscounts.length; i++){
            var color = "";
            if(appliedDiscounts[i].difference < 0){
                color = "table-danger";
            }
            else if(appliedDiscounts[i].percentage_difference < 5){
                color = "table-warning";
            }
            output += "<tr value="+appliedDiscounts[i].id+" class="+color+">"
                + "<td>  <input type='radio'  name='active' checked></td>"
                + "<td id=percentage"+appliedDiscounts[i].id+">" + appliedDiscounts[i].discount_percentage + "</td>"
                + "<td>" + appliedDiscounts[i].discountedTotal + "</td>"
                + "<td>" + appliedDiscounts[i].amount_due + "</td>"
                + "<td>" + appliedDiscounts[i].Difference + "</td>"
                + "<td>" + appliedDiscounts[i].DifferencePercentage + "</td>"
                + "<td>" + appliedDiscounts[i].endDate + "</td>"
                +  "</tr>";
        }

        $('#applied_discounts_table tbody').html(output);
    }

    function addPossibleDiscount(possibleDiscount){
        appliedDiscounts.push(possibleDiscount);
    }

    function generateDiscounts(){
        appliedDiscounts = [];
        displayStats();
        const person_data_id = {{ $person_data_id }}
        var amount_due_without_discounts = document.getElementById("total-total").innerHTML;
        var amount_due = document.getElementById("total").innerHTML;

        amount_due_without_discounts = parseFloat(amount_due_without_discounts.replace(/,/g,''));
        amount_due = parseFloat(amount_due.replace(/,/g,''));

        var today2 = new Date();
        var time = today2.toTimeString().split(' ')[0];

        var date = document.getElementById("input-start_date").value;
        var dateTime = date+' '+time;
        var start_date = new Date(dateTime);
        var enddate = document.getElementById("input-end_date").value;
        var end_date = new Date(enddate+' '+time);

        if(start_date.getTime() < end_date.getTime() ){

            for(var i = 0; i < percentages.length; i++){
                var possibleDiscount = new AppliedDiscount(person_data_id,
                percentages[i], amount_due_without_discounts, amount_due, start_date, end_date, percentages.length);
                addPossibleDiscount(possibleDiscount);
            }
        }
        else {

        }


    }

    function validateDates(start_date, end_date){
        var d1 = new Date(start_date);
        var d2 = new Date(end_date);

        if(d1.getTime() >= d2.getTime()){
            return false;
        }
        else {
            return true;
        }
    }


    $(document).ready(function(){
        percentages = [20, 25, 30];
        displayPercentages();
        $('#modal-form').on('shown.bs.modal', function (e) {
        })
        document.getElementById("input-start_date").value = today;
        document.getElementById("input-date").value = today;
        document.getElementById("payment-date").value = today;


        $("#select").click(function(){

            var i = 0;
            $("#applied_discounts_table tbody").find('input[name="active"]').each(function(){
                if($(this).is(":checked")){
                    index = i;
                    return false;
                }
                i++;

            });
            appliedDiscounts[i]['active'] = 1;
            var appliedDiscount = appliedDiscounts[i];
            sendAppliedDiscount(appliedDiscount);

        });

        $("#add-percentage").click(function(){
            var percentage = document.getElementById("input-new_discount_percentage").value;

            if(percentage > 0){
                percentages.push(percentage);
                displayPercentages();
            }



        });



        $("#generate").click(function(){


            generateDiscounts();
            displayGeneratedDiscounts();

        });

        $("#update-discount").click(function(){
            var discount_id = document.getElementById("update-discount-id").value;
            var start_date = document.getElementById("update-start-date").value;

            var end_date = document.getElementById("update-end-date").value;

            if(validateDates(start_date, end_date)){
                updateDiscount(discount_id, start_date, end_date);
            }

        });
    });

    function showEditDiscountModal(id){
        getDiscount(id);
        $('#edit-discount-modal').modal('show')
    }
    function getDiscount(id){
        $.ajax({
            url: "{{route('discount_person.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "discount_id" : id
            },
        success: function (response) {
                displayDiscountModal(response.data.id,
                    response.data.start_date, response.data.end_date)
            }
        });
        return false;
    }

    function displayDiscountModal(discount_person_data_id, start_date, end_date){
        document.getElementById("update-discount-id").value = discount_person_data_id;
        document.getElementById("update-start-date").value = start_date;
        document.getElementById("update-end-date").value = end_date;

      }
    function updateDiscount(id, start_date, end_date){
        $.ajax({
            url: "{{route('discount_person.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id": {{ $person_data_id }},
                "discount_person_data_id": id,
                "start_date": start_date,
                "end_date": end_date
            },
        success: function (response) {
            DisplayDiscounts(response.data);
            displayStats();
            $('#edit-discount-modal').modal('hide')

            }
        });
            return false;
    }
</script>
@endpush
